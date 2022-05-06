<?php

namespace Macareux\Boilerplate\File\ExternalFileProvider\Configuration;

use Concrete\Core\Error\ErrorList\ErrorList;
use Concrete\Core\File\ExternalFileProvider\Configuration\Configuration;
use Concrete\Core\File\ExternalFileProvider\Configuration\ConfigurationInterface;
use Concrete\Core\File\ExternalFileProvider\ExternalFileEntry;
use Concrete\Core\File\ExternalFileProvider\ExternalFileList;
use Concrete\Core\File\FolderItemList;
use Concrete\Core\File\Type\Type;
use Concrete\Core\Http\Request;
use Concrete\Core\Support\Facade\Application;
use Concrete\Core\Tree\Node\Node;
use Concrete\Core\Tree\Node\Type\File;
use Concrete\Core\Tree\Node\Type\FileFolder;

/**
 * This is a mock configuration file for Concrete's external file provider system.
 * This provider class searches files in the file manager and does not import any external files.
 * Please implement searchFiles() and importFile() properly when you implement a new provider.
 */
class MockConfiguration extends Configuration implements ConfigurationInterface
{
    /**
     * This is a dummy option value. You can add any properties you need for this configuration to store.
     *
     * @var string
     */
    protected $apiKey;

    /**
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * @param string $apiKey
     */
    public function setApiKey(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * You need to add elements/external_file_provider_types/{efpTypeHandle}.php
     *
     * {@inheritdoc}
     */
    public function loadFromRequest(Request $req)
    {
        if ($req->request->has('apiKey')) {
            $this->setApiKey($req->request->get('apiKey'));
        }
    }

    /**
     * {@inheritdoc}
     */
    public function validateRequest(Request $req)
    {
        $app = Application::getFacadeApplication();
        /** @var ErrorList $error */
        $error = $app->make('helper/validation/error');
        if (!$req->request->has('apiKey') || empty($req->request->get('apiKey'))) {
            $error->addError(t('Please input api key.'));
        }

        return $error;
    }

    /**
     * {@inheritdoc}
     */
    public function searchFiles($externalSearchRequest)
    {
        // Get search parameters
        $searchTerm = $externalSearchRequest->getSearchTerm();
        $fileType = $externalSearchRequest->getFileType();
        $currentPage = $externalSearchRequest->getCurrentPage();
        $itemsPerPage = $externalSearchRequest->getItemsPerPage();
        $orderBy = $externalSearchRequest->getOrderBy();
        $orderByDirection = $externalSearchRequest->getOrderByDirection();

        $app = Application::getFacadeApplication();
        $config = $app->make('config');

        $fileList = new FolderItemList();
        $fileList->ignorePermissions();
        $fileList->enableSubFolderSearch();
        $fileList->filterByKeywords($searchTerm);
        if ($fileType) {
            $fileList->filterByType($fileType);
        }
        $fileList->setItemsPerPage($itemsPerPage);
        switch ($orderBy) {
            case 'fv.fvTitle':
                $fileList->sortBy('name', $orderByDirection);
                break;
            case 'dateModified':
                $fileList->sortBy('dateModified', $orderByDirection);
                break;
        }

        $externalFileList = new ExternalFileList();
        $externalFileList->setTotalFiles($fileList->getTotalResults());
        $pagination = $fileList->getPagination();
        if ($currentPage) {
            $pagination->setCurrentPage($currentPage);
        }
        $results = $pagination->getCurrentPageResults();
        /** @var Node $result */
        foreach ($results as $result) {
            $externalFile = new ExternalFileEntry();
            $externalFile->setTitle($result->getTreeNodeDisplayName());
            if ($result instanceof FileFolder) {
                $externalFile->setIsFolder(true);
            } elseif ($result instanceof File) {
                $file = $result->getTreeNodeFileObject();
                $externalFile->setFID($file->getFileID());
                if ($file->getVersion()->getTypeObject()->getGenericType() === Type::T_IMAGE) {
                    $externalFile->setThumbnailUrl($file->getVersion()->getThumbnailURL($config->get('concrete.icons.file_manager_detail.handle')));
                } else {
                    $externalFile->setThumbnailUrl($file->getVersion()->getTypeObject()->getThumbnail(false));
                }
                $externalFile->setFvDateAdded($file->getDateAdded());
                // @see https://github.com/concrete5/concrete5/pull/10606
                if (method_exists($externalFile, 'setSize')) {
                    $externalFile->setSize($file->getVersion()->getSize());
                }
                if ($file->getAttribute('width') && method_exists($externalFile, 'setWidth')) {
                    $externalFile->setWidth($file->getAttribute('width'));
                }
                if ($file->getAttribute('height') && method_exists($externalFile, 'setHeight')) {
                    $externalFile->setHeight($file->getAttribute('height'));
                }
            }
            $externalFileList->addFile($externalFile);
        }

        return $externalFileList;
    }

    /**
     * {@inheritdoc}
     */
    public function supportFileTypes()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function getFileTypes()
    {
        $types = ['' => t('** All')];
        foreach (Type::getUsedTypeList() as $id) {
            $types[$id] = Type::getGenericTypeText($id);
        }

        return $types;
    }

    /**
     * {@inheritdoc}
     */
    public function hasCustomImportHandler()
    {
        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function importFile($fileId, $uploadDirectoryId)
    {
        $file = \Concrete\Core\File\File::getByID($fileId);

        return $file->getApprovedVersion();
    }
}

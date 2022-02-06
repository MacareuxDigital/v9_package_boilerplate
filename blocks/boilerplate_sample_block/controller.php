<?php

namespace Concrete\Package\V9PackageBoilerplate\Block\BoilerplateSampleBlock;

use Concrete\Core\Application\Service\FileManager;
use Concrete\Core\Block\BlockController;
use Concrete\Core\Editor\CkeditorEditor;
use Concrete\Core\Editor\LinkAbstractor;
use Concrete\Core\Error\ErrorList\ErrorList;
use Concrete\Core\File\File;
use Concrete\Core\File\Type\Type;
use Concrete\Core\Utility\Service\Text;
use Concrete\Core\Utility\Service\Validation\Numbers;
use Concrete\Core\Utility\Service\Validation\Strings;
use Illuminate\Contracts\Container\BindingResolutionException;

/**
 * controller.php contains information about our block, as well as methods that automatically get run
 * when different things happen to our block.
 *
 * @see https://documentation.concretecms.org/developers/working-with-blocks/creating-a-new-block-type/getting-started/php-controller
 */
class Controller extends BlockController
{
    /**
     * @var string Defaults to null. If a valid Block Type Set handle is passed,
     *             the block type will be installed in this set automatically,
     *             and will show up there in the Add block interface.
     */
    protected $btDefaultSet = 'basic';

    /**
     * @var string The block's primary database table. If specified, and if the block
     *             only uses this one database table, then the block will be able to
     *             automatically save its information to this table, provided the
     *             block's form fields map directly to the columns in the database.
     *             This value will also be set in db.xml.
     */
    protected $btTable = 'btBoilerplateSampleBlock';

    /**
     * @var int The width in pixels of the modal popup dialog box that holds this block
     *          when it is added or edited. Does nothing if hte block supports inline adding/editing.
     */
    protected $btInterfaceWidth = 640;

    /**
     * @var int The height of the modal popup dialog box in pixels that holds this block
     *          when it is added or edited. Does nothing if hte block supports inline adding/editing.
     */
    protected $btInterfaceHeight = 480;

    /**
     * @var bool Defaults to true. When block caching is enabled, this means that the block's database
     *           record data will also be cached. This can almost always be set to true.
     */
    protected $btCacheBlockRecord = true;

    /**
     * @var bool Defaults to false. When block caching is enabled, enabling this boolean means that
     *           the output of the block will be saved and delivered without rendering the view() function
     *           or hitting the database at all.
     */
    protected $btCacheBlockOutput = true;

    /**
     * @var int Defaults to no time limit (0). When block caching is enabled and output caching is enabled
     *          for a block, this is the value in seconds that the cache will last before being refreshed.
     */
    protected $btCacheBlockOutputLifetime = 0;

    /**
     * @var bool Defaults to false. This determines whether a block will cache its output on POST.
     *           Some blocks can cache their output but must serve uncached output on POST in order to
     *           show error messages, etc…
     */
    protected $btCacheBlockOutputOnPost = true;

    /**
     * @var bool Defaults to false. Determines whether a block that can cache its output will continue to
     *           cache its output even if the current user viewing it is logged in.
     */
    protected $btCacheBlockOutputForRegisteredUsers = true;

    /**
     * @var string[] Defaults to an empty array. When this block is exported, any database columns found
     *               in this array will automatically be swapped for links to specific files, by file name.
     *               Upon import they will map to the specific file with that filename, regardless of its file ID.
     */
    protected $btExportFileColumns = ['fileField'];

    /**
     * @var string All database columns for this block from the db.xml are automatically injected as properties
     */
    protected $textField;

    /**
     * @var string All database columns for this block from the db.xml are automatically injected as properties
     */
    protected $textareaField;

    /**
     * @var int All database columns for this block from the db.xml are automatically injected as properties
     */
    protected $fileField;

    /**
     * @var string All database columns for this block from the db.xml are automatically injected as properties
     */
    protected $urlField;

    /**
     * Returns the description of the block type.
     *
     * @return string
     */
    public function getBlockTypeDescription()
    {
        return t('A boilerplate block.');
    }

    /**
     * Returns the name of the block type.
     *
     * @return string $btName
     */
    public function getBlockTypeName()
    {
        return t('Sample Block');
    }

    /**
     * The method called when admin user trying to add a block instance.
     */
    public function add()
    {
        $this->edit();
    }

    /**
     * The method called when admin user trying to edit a block instance.
     */
    public function edit()
    {
        /**
         * Load Rich Text Editor.
         *
         * @see https://documentation.concretecms.org/developers/interface-customization/rich-text-editor/embedding-rich-text-editor
         *
         * @var CkeditorEditor $editor
         */
        $editor = $this->app->make('editor');
        $this->set('editor', $editor);
        $this->set('textareaContent', LinkAbstractor::translateFromEditMode($this->textareaField));

        /**
         * Load File Manager Selector.
         *
         * @see https://documentation.concretecms.org/developers/appendix/form-widget-reference
         * @see https://documentation.concretecms.org/developers/working-with-files-and-the-file-manager/working-with-existing-files/add-file-manager-support-to-your-blocks-and-single-pages
         *
         * @var FileManager
         */
        $fileSelector = $this->app->make('helper/concrete/file_manager');
        $this->set('fileSelector', $fileSelector);
    }

    /**
     * The method called when admin user trying to edit a block instance through composer interface.
     */
    public function composer()
    {
        $this->edit();
    }

    /**
     * Used to validate a block's data before saving to the database
     * Generally should return an empty ErrorList if valid
     * Custom Packages may return a boolean value.
     *
     * @param $args array|string|null
     *
     * @throws BindingResolutionException
     *
     * @return ErrorList
     */
    public function validate($args)
    {
        /** @var ErrorList $e */
        $e = parent::validate($args);

        /** @var Strings $strings */
        $strings = $this->app->make(Strings::class);

        if (!$strings->notempty($args['textField'])) {
            $e->add(t('Please provide a title.'));
        } elseif (!$strings->max($args['textField'], 12)) {
            $e->add(t('Title must be at least 12 characters long.'));
        }

        if (!filter_var($args['urlField'], FILTER_VALIDATE_URL)) {
            $e->add(t('Please input valid url.'));
        }

        /** @var Numbers $numbers */
        $numbers = $this->app->make(Numbers::class);

        if (!$numbers->integer($args['fileField'])) {
            $e->add(t('Please select thumbnail.'));
        } else {
            $f = File::getByID($args['fileField']);
            if (!$f || $f->getVersion()->getTypeObject()->getGenericType() !== Type::T_IMAGE) {
                $e->add(t('Please valid image.'));
            }
        }

        return $e;
    }

    /**
     * Run when a block is added or edited. Automatically saves block data against the block's database table.
     * If a block needs to do more than this (save to multiple tables, upload files, etc...) it should override this.
     *
     * @param array $args
     *
     * @throws BindingResolutionException
     */
    public function save($args)
    {
        if ($args['textField']) {
            /** @var Text $text */
            $text = $this->app->make(Text::class);
            $args['textField'] = $text->shorten($args['textField'], 12, '');
        }
        $args['fileField'] = (int) $args['fileField'];
        if ($args['textareaField']) {
            $args['textareaField'] = LinkAbstractor::translateTo($args['textareaField']);
        }

        parent::save($args);
    }

    /**
     * The method called when a user viewing this block instance.
     */
    public function view()
    {
        $this->set('textareaContent', LinkAbstractor::translateFrom($this->textareaField));
        $this->set('file', File::getByID($this->fileField));
    }

    /**
     * If present, this method provides text for the page search indexing routine.
     * This method should return simple, unformatted plain text, not HTML.
     *
     * @return string
     */
    public function getSearchableContent(): string
    {
        return $this->textField . PHP_EOL . strip_tags($this->textareaField);
    }
}

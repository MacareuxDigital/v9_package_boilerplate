<?php

namespace Concrete\Package\V9PackageBoilerplate\Block\BoilerplateProductList;

use Concrete\Core\Block\BlockController;
use Concrete\Core\Http\Request;
use Concrete\Core\Search\Pagination\PaginationFactory;
use Doctrine\ORM\EntityManagerInterface;
use Macareux\Boilerplate\Entity\Product;
use Macareux\Boilerplate\Entity\ProductRepository;
use Macareux\Boilerplate\Search\ProductList;

class Controller extends BlockController
{
    /**
     * @var string Defaults to null. If a valid Block Type Set handle is passed,
     *             the block type will be installed in this set automatically,
     *             and will show up there in the Add block interface.
     */
    protected $btDefaultSet = 'multimedia';

    /**
     * {@inheritdoc}
     */
    public function getBlockTypeDescription()
    {
        return t('A boilerplate block.');
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockTypeName()
    {
        return t('Product List');
    }

    public function view()
    {
        /** @var ProductList $list */
        $list = $this->app->make(ProductList::class);
        $list->sortBy('p.id', 'desc');
        $keywords = $this->get('keywords');
        if ($keywords) {
            $list->filterByKeywords($keywords);
        }
        $factory = new PaginationFactory(Request::getInstance());
        $pagination = $factory->createPaginationObject($list, PaginationFactory::PERMISSIONED_PAGINATION_STYLE_PAGER);
        $this->set('list', $list);
        $this->set('pagination', $pagination);
    }

    public function action_view_detail($id, $bID)
    {
        /** @var EntityManagerInterface $entityManager */
        $entityManager = $this->app->make(EntityManagerInterface::class);
        /** @var ProductRepository $repository */
        $repository = $entityManager->getRepository(Product::class);
        $product = $repository->find($id);
        $this->set('product', $product);
    }
}

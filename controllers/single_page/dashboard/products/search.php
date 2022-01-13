<?php

namespace Concrete\Package\V9PackageBoilerplate\Controller\SinglePage\Dashboard\Products;

use Concrete\Core\Filesystem\ElementManager;
use Concrete\Core\Http\Request;
use Concrete\Core\Page\Controller\DashboardPageController;
use Concrete\Core\Search\Pagination\PaginationFactory;
use Macareux\Boilerplate\Search\ProductList;

class Search extends DashboardPageController
{
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
        $this->set('headerMenu', $this->app->make(ElementManager::class)->get('products/search/menu', 'v9_package_boilerplate'));
        $this->set('headerSearch', $this->app->make(ElementManager::class)->get('products/search/form', 'v9_package_boilerplate'));
        $this->setThemeViewTemplate('full.php');
    }
}

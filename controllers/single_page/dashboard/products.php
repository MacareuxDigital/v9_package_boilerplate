<?php

namespace Concrete\Package\V9PackageBoilerplate\Controller\SinglePage\Dashboard;

use Concrete\Core\Page\Controller\DashboardPageController;
use Concrete\Core\Url\Resolver\Manager\ResolverManagerInterface;

class Products extends DashboardPageController
{
    public function view()
    {
        /** @var ResolverManagerInterface $resolver */
        $resolver = $this->app->make(ResolverManagerInterface::class);

        return $this->buildRedirect($resolver->resolve(['/dashboard/products/search']));
    }
}

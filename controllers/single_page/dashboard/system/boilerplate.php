<?php

namespace Concrete\Package\V9PackageBoilerplate\Controller\SinglePage\Dashboard\System;

use Concrete\Core\Page\Controller\DashboardPageController;
use Concrete\Core\Url\Resolver\Manager\ResolverManagerInterface;

class Boilerplate extends DashboardPageController
{
    public function view()
    {
        /** @var ResolverManagerInterface $resolver */
        $resolver = $this->app->make(ResolverManagerInterface::class);

        return $this->buildRedirect($resolver->resolve(['/dashboard/system/boilerplate/config']));
    }
}

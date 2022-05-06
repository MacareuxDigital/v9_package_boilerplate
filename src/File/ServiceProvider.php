<?php

namespace Macareux\Boilerplate\File;

use Concrete\Core\Foundation\Service\Provider;
use Macareux\Boilerplate\File\ExternalFileProvider\Configuration\MockConfiguration;

class ServiceProvider extends Provider
{
    /**
     * @inheritDoc
     */
    public function register()
    {
        $this->app->bind('\Concrete\Package\V9PackageBoilerplate\File\ExternalFileProvider\Configuration\MockConfiguration', MockConfiguration::class);
    }
}
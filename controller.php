<?php

namespace Concrete\Package\V9PackageBoilerplate;

use Concrete\Core\Block\BlockType\BlockType;
use Concrete\Core\File\ExternalFileProvider\Type\Type;
use Concrete\Core\Package\Package;
use Concrete\Core\Page\Page;
use Concrete\Core\Page\Theme\Theme;
use Macareux\Boilerplate\File\ServiceProvider;

/**
 * Package Controller.
 *
 * @see https://documentation.concretecms.org/developers/packages/directory-icon-controller
 */
class Controller extends Package
{
    /**
     * The minimum Concrete version compatible with this package.
     *
     * @var string
     */
    protected $appVersionRequired = '9.0.0';

    /**
     * The handle of this package.
     *
     * @var string
     */
    protected $pkgHandle = 'v9_package_boilerplate';

    /**
     * The version number of this package.
     *
     * @var string
     */
    protected $pkgVersion = '0.0.5';

    /**
     * @see https://documentation.concretecms.org/developers/packages/adding-custom-code-to-packages
     *
     * @var string[]
     */
    protected $pkgAutoloaderRegistries = [
        'src' => '\Macareux\Boilerplate',
    ];

    /**
     * Get the translated name of the package.
     *
     * @return string
     */
    public function getPackageName()
    {
        return t('V9 Package Boilerplate');
    }

    /**
     * Get the translated package description.
     *
     * @return string
     */
    public function getPackageDescription()
    {
        return t('A template package of package development for Concrete CMS Version 9.');
    }

    /**
     * Install this package.
     *
     * @see https://documentation.concretecms.org/developers/packages/installation/overview
     *
     * @return \Concrete\Core\Entity\Package
     */
    public function install()
    {
        $package = parent::install();

        /**
         * Install components using the CIF format files.
         *
         * @see https://documentation.concretecms.org/developers/packages/install-content-using-content-interchange-format-cif
         */
        $this->installContentFile('install/blocktypes.xml');
        $this->installContentFile('install/singlepages.xml');
        /**
         * @see https://documentation.concretecms.org/building-website-concretecms/4-create-your-package-and-theme/4-install-the-package-and-theme
         */
        $this->installContentFile('install/theme.xml');

        $this->installExternalFileProvider($package);

        return $package;
    }

    /**
     * Handling package upgrades.
     *
     * @see https://documentation.concretecms.org/developers/packages/handling-package-upgrades
     *
     * @return void
     */
    public function upgrade()
    {
        parent::upgrade();

        $blockType = BlockType::getByHandle('boilerplate_sample_block');
        if (!$blockType) {
            $this->installContentFile('install/blocktypes.xml');
        }

        $page = Page::getByPath('/dashboard/products');
        if (!$page || $page->isError()) {
            $this->installContentFile('install/singlepages.xml');
        }

        $theme = Theme::getByHandle('theme_boilerplate');
        if (!$theme) {
            $this->installContentFile('install/theme.xml');
        }

        $externalFileProvider = Type::getByHandle('mock');
        if (!$externalFileProvider) {
            $this->installExternalFileProvider($this->getPackageEntity());
        }
    }

    /**
     * This method called on every page load
     *
     * @see \Concrete\Core\Application\Application::setupPackages
     *
     * @return void
     */
    public function on_start()
    {
        $this->app->make(ServiceProvider::class)->register();
    }

    private function installExternalFileProvider(\Concrete\Core\Entity\Package $pkg)
    {
        Type::add('mock', t('Mock'), $pkg);
    }
}

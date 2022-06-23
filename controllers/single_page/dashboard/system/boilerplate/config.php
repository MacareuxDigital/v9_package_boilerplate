<?php

namespace Concrete\Package\V9PackageBoilerplate\Controller\SinglePage\Dashboard\System\Boilerplate;

use Concrete\Core\Config\Repository\Liaison;
use Concrete\Core\Package\PackageService;
use Concrete\Core\Page\Controller\DashboardPageController;
use Symfony\Component\HttpFoundation\RedirectResponse;

class Config extends DashboardPageController
{
    public function view()
    {
        $config = $this->getConfig();
        if ($config) {
            $example_value = $config->get('app.example');
            $this->set('example_value', $example_value);
        }
    }

    public function submit(): ?RedirectResponse
    {
        if (!$this->token->validate('update_config')) {
            $this->error->add($this->token->getErrorMessage());
        }

        $example_value = trim($this->post('example_key'));
        if (empty($example_value)) {
            $this->error->add(t('The key is required.'));
        }

        if (!$this->error->has()) {
            $config = $this->getConfig();
            if ($config) {
                $config->save('app.example', $example_value);
                $this->flash('success', t('The settings has been successfully updated.'));
            }

            return $this->buildRedirect([$this->getPageObject()]);
        }

        return null;
    }

    protected function getConfig(): ?Liaison
    {
        /** @var PackageService $packageService */
        $packageService = $this->app->make(PackageService::class);
        $package = $packageService->getClass('v9_package_boilerplate');
        if ($package) {
            return $package->getFileConfig();
        }

        return null;
    }
}

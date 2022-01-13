<?php

namespace Concrete\Package\V9PackageBoilerplate\Controller\Element\Products\Search;

use Concrete\Core\Controller\ElementController;

class Form extends ElementController
{
    /**
     * {@inheritdoc}
     */
    public function getElement()
    {
        return 'products/search/form';
    }

    public function view()
    {
        $this->set('form', $this->app->make('helper/form'));
    }
}

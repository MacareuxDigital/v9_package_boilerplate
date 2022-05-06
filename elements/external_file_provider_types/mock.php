<?php

use Concrete\Core\Support\Facade\Application;
use Macareux\Boilerplate\File\ExternalFileProvider\Configuration\MockConfiguration;

defined('C5_EXECUTE') or die('Access Denied');

/** @var MockConfiguration $configuration */

$app = Application::getFacadeApplication();
/** @var \Concrete\Core\Form\Service\Form $form */
$form = $app->make('helper/form');

if (isset($configuration) && is_object($configuration)) { ?>
    <div class="form-group">
        <?= $form->label('apiKey', t('API Key')) ?>
        <?= $form->text('apiKey', $configuration->getApiKey(), ['placeholder' => t('This is a dummy option, please input any string here')]) ?>
    </div>
    <?php
}
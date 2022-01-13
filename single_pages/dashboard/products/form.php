<?php

use Concrete\Core\Support\Facade\Url as UrlFacade;

defined('C5_EXECUTE') or die('Access Denied.');

/** @var \Concrete\Core\View\View $view */
/** @var \Concrete\Core\Validation\CSRF\Token $token */
/** @var \Concrete\Core\Form\Service\Form $form */

$id = $id ?? null;
$name = $name ?? null;
$price = $price ?? null;
?>
<form method="post" action="<?= $view->action('submit', $id); ?>">
    <?php $token->output('save_product'); ?>
    <fieldset>
        <div class="form-group">
            <?= $form->label('name', t('Name')) ?>
            <?= $form->text('name', $name, ['placeholder' => t('John Doe'), 'autofocus' => true]) ?>
        </div>
        <div class="form-group">
            <?= $form->label('price', t('Price')) ?>
            <div class="input-group">
                <span class="input-group-text">¥</span>
                <?= $form->number('price', $price) ?>
            </div>
        </div>
    </fieldset>
    <div class="ccm-dashboard-form-actions-wrapper">
        <div class="ccm-dashboard-form-actions">
            <a href="<?= UrlFacade::to('/dashboard/products/search'); ?>" class="btn btn-secondary float-start"><?=  t('Cancel'); ?></a>
            <?= $form->submit('save', t('Save'), ['class' => 'btn btn-primary float-end']); ?>
        </div>
    </div>
</form>

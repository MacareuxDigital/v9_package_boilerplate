<?php
defined('C5_EXECUTE') or die('Access Denied.');

/** @var \Concrete\Core\Page\View\PageView $view */
/** @var \Concrete\Core\Form\Service\Form $form */
/** @var \Concrete\Core\Validation\CSRF\Token $token */

$example_value = $example_value ?? null;
?>
<form action="<?= $view->action('submit') ?>" method="post">
    <?php $token->output('update_config'); ?>

    <div class="form-group">
        <?= $form->label('example_key', t('Example Config Value')) ?>
        <?= $form->text('example_key', $example_value) ?>
        <p class="help-block"><?= t('This is an example config value and not used in anywhere.') ?></p>
    </div>

    <div class="ccm-dashboard-form-actions-wrapper">
        <div class="ccm-dashboard-form-actions">
            <button type="submit" class="btn btn-primary float-end">
                <?php echo t('Save') ?>
            </button>
        </div>
    </div>
</form>
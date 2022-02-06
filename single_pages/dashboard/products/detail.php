<?php

defined('C5_EXECUTE') or die('Access Denied.');

/** @var \Concrete\Core\View\View $view */
/** @var \Concrete\Core\Validation\CSRF\Token $token */
/** @var \Concrete\Core\Form\Service\Form $form */

$id = $id ?? null;
$name = $name ?? null;
$price = $price ?? null;
?>
<section>
    <div class="btn-group btn-section">
        <a href="<?= $view->action('form', $id) ?>" class="btn btn-secondary">
            <?= t('Edit') ?></a>
        <a href="#" class="btn btn-danger"
           data-bs-toggle="modal" data-bs-target="#delete-product">
            <?= t('Delete') ?></a>
    </div>
    <h3><?= t('Name') ?></h3>
    <p><?= h($name) ?></p>
    <h3><?= t('Price') ?></h3>
    <p><?= h($price) ?></p>
</section>

<div class="modal fade" id="delete-product" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form method="post" action="<?=$view->action('delete', $id)?>">
            <?=$token->output('delete_product')?>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?=t('Delete Product')?></h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="<?= t('Close') ?>"></button>
                </div>
                <div class="modal-body">
                    <?=t('Are you sure you want to delete this product?')?>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger float-start"><?=t('Delete Product')?></button>
                </div>
            </div>
        </form>
    </div>
</div>
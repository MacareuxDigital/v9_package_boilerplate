<?php

defined('C5_EXECUTE') or die('Access Denied.');

/** @var \Concrete\Core\View\View $view */
/** @var \Concrete\Core\Form\Service\Form $form */
?>
<div class="ccm-header-search-form ccm-ui">
    <form method="get" class="form-inline" action="<?= $view->action('view') ?>">

        <div class="ccm-header-search-form-input input-group">
            <?php
            echo $form->search('keywords', [
                'placeholder' => t('Search'),
                'class' => 'form-control border-end-0',
                'autocomplete' => 'off',
            ]);
            ?>
            <button type="submit" class="input-group-icon">
                <svg width="16" height="16">
                    <use xlink:href="#icon-search"/>
                </svg>
            </button>
        </div>
    </form>
</div>

<?php

defined('C5_EXECUTE') or die('Access Denied.');

/** @var int $apiLimit */
/** @var string $listTitle */
/** @var \Concrete\Core\Form\Service\Form $form */

?>
<div class="form-group">
    <?= $form->label('apiLimit', t('Items per page')) ?>
    <?= $form->number('apiLimit', $apiLimit) ?>
</div>
<div class="form-group">
    <?= $form->label('listTitle', t('Title')) ?>
    <?= $form->text('listTitle', $listTitle) ?>
</div>

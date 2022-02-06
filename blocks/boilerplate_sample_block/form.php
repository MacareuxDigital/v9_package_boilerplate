<?php

defined('C5_EXECUTE') or die('Access Denied.');

/** @var string $textField */
/** @var string $textareaContent */
/** @var int $fileField */
/** @var string $urlField */
/** @var \Concrete\Core\Form\Service\Form $form */
/** @var \Concrete\Core\Editor\CkeditorEditor $editor */
/** @var \Concrete\Core\Application\Service\FileManager $fileSelector */
?>
<div class="form-group">
    <?= $form->label('textField', t('Title')) ?>
    <?= $form->text('textField', $textField) ?>
</div>
<div class="form-group">
    <?= $form->label('textareaField', t('Description')) ?>
    <?= $editor->outputBlockEditModeEditor('textareaField', $textareaContent) ?>
</div>
<div class="form-group">
    <?= $form->label('fileField', t('Thumbnail')) ?>
    <?= $fileSelector->image('fileField', 'fileField', t('Choose Thumbnail Image'), $fileField) ?>
</div>
<div class="form-group">
    <?= $form->label('urlField', t('Link')) ?>
    <?= $form->url('urlField', $urlField) ?>
</div>

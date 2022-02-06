<?php

defined('C5_EXECUTE') or die('Access Denied.');

/** @var string $textField */
/** @var string $textareaContent */
/** @var int $fileField */
/** @var string $urlField */
/** @var \Concrete\Core\Form\Service\Form $form */
/** @var \Concrete\Core\Editor\CkeditorEditor $editor */
/** @var \Concrete\Core\Application\Service\FileManager $fileSelector */
/** @var \Concrete\Core\Page\Type\Composer\Control\BlockControl $view */
?>
<div class="form-group">
    <?= $form->label($view->field('textField'), t('Title')) ?>
    <?= $form->text($view->field('textField'), $textField) ?>
</div>
<div class="form-group">
    <?= $form->label($view->field('textareaField'), t('Description')) ?>
    <?= $editor->outputPageComposerEditor($view->field('textareaField'), $textareaContent) ?>
</div>
<div class="form-group">
    <?= $form->label($view->field('fileField'), t('Thumbnail')) ?>
    <?= $fileSelector->image('fileField', $view->field('fileField'), t('Choose Thumbnail Image'), $fileField) ?>
</div>
<div class="form-group">
    <?= $form->label($view->field('urlField'), t('Link')) ?>
    <?= $form->url($view->field('urlField'), $urlField) ?>
</div>

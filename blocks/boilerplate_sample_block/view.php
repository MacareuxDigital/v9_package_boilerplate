<?php

defined('C5_EXECUTE') or die('Access Denied.');

/** @var string $textField */
/** @var string $textareaContent */
/** @var \Concrete\Core\Entity\File\File|null $file */
/** @var string $urlField */
?>
<h3><?= h($textField) ?></h3>
<?= $textareaContent ?>
<?php
if ($file) {
    $image = new \Concrete\Core\Html\Image($file);
    echo $image->getTag();
}
if ($urlField) {
    ?>
    <p class="my-2"><a href="<?= h($urlField) ?>" class="btn btn-primary"><?= t('Link') ?></a></p>
<?php
}

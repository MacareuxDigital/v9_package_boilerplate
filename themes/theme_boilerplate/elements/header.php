<?php defined('C5_EXECUTE') or die('Access Denied.'); ?>
<!doctype html>
<html lang="<?php echo Localization::activeLanguage() ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
    View::element('header_required', [
        'pageTitle' => $pageTitle ?? '',
        'pageDescription' => $pageDescription ?? '',
        'pageMetaKeywords' => $pageMetaKeywords ?? '',
    ]);
    ?>
    <link href="<?= $view->getThemePath() ?>/assets/css/main.css" rel="stylesheet">
</head>
<body>
<div class="<?= $c->getPageWrapperClass() ?>">
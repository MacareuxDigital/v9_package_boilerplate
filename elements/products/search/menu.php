<?php

use Concrete\Core\Support\Facade\Url as UrlFacade;

defined('C5_EXECUTE') or die('Access Denied.');

?>
<a class="btn btn-primary"
   href="<?php echo (string) UrlFacade::to('/dashboard/products/detail/form'); ?>">
    <?= t('Add Product') ?>
</a>

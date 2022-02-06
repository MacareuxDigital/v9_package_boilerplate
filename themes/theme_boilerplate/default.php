<?php
defined('C5_EXECUTE') or die('Access Denied.');

$view->inc('elements/header.php');
?>

<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <?php
            $a = new Area('Main');
            $a->display($c);
            ?>
        </div>
    </div>
</div>

<?php
$view->inc('elements/footer.php');

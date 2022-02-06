<?php
defined('C5_EXECUTE') or die('Access Denied.');

$view->inc('elements/header.php');
?>

    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <?php
                View::element('system_errors', [
                    'format' => 'block',
                    'error' => $error ?? null,
                    'success' => $success ?? null,
                    'message' => $message ?? null,
                ]);

                echo $innerContent;
                ?>
            </div>
        </div>
    </div>

<?php
$view->inc('elements/footer.php');

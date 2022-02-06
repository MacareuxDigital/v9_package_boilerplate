<?php

defined('C5_EXECUTE') or die('Access Denied.');

/** @var \Concrete\Core\View\View $view */
/** @var \Concrete\Core\Search\Pagination\Pagination $pagination */
/** @var \Macareux\Boilerplate\Entity\Product $product */
if ($pagination) {
    ?>
    <table class="table">
        <thead>
        <tr>
            <th><?= t('Name') ?></th>
            <th><?= t('Price') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php
        /** @var \Macareux\Boilerplate\Entity\Product $product */
        foreach ($pagination->getCurrentPageResults() as $product) {
            ?>
            <tr>
                <td>
                    <a href="<?= $view->action('view_detail', $product->getId()) ?>">
                        <?= h($product->getName()) ?>
                    </a>
                </td>
                <td><?= h(Punic\Number::formatCurrency($product->getPrice(), 'JPY')) ?></td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
    <?php
    echo $pagination->renderView();
}

if ($product) {
    ?>
    <table class="table">
        <tbody>
        <tr>
            <th><?= t('Name') ?></th>
            <td><?= h($product->getName()) ?></td>
        </tr>
        <tr>
            <th><?= t('Price') ?></th>
            <td><?= h(Punic\Number::formatCurrency($product->getPrice(), 'JPY')) ?></td>
        </tr>
        </tbody>
    </table>
<?php
}

<?php

use Concrete\Core\Support\Facade\Url as UrlFacade;

defined('C5_EXECUTE') or die('Access Denied.');

/** @var \Concrete\Core\Search\Pagination\Pagination $pagination */
if ($pagination) {
    ?>
    <div id="ccm-search-results-table">
        <table class="ccm-search-results-table">
            <thead>
            <tr>
                <th><?= t('ID') ?></th>
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
                    <td><?= h($product->getId()) ?></td>
                    <td>
                        <a href="<?= UrlFacade::to('/dashboard/products/detail', $product->getId()) ?>">
                            <?= h($product->getName()) ?>
                        </a>
                    </td>
                    <td><?= h($product->getPrice()) ?></td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>
    <?php
    echo $pagination->renderView('dashboard');
}

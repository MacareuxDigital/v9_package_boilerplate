<?php

defined('C5_EXECUTE') or die('Access Denied.');

/** @var \Concrete\Package\V9PackageBoilerplate\Block\BoilerplatePokeApi\Controller $controller */
/** @var \Macareux\Boilerplate\Poke\Result\Pokemon|null $item */
/** @var \Concrete\Core\Block\View\BlockView $view */

$title = $title ?? '';
$results = $results ?? [];
$pagination = $pagination ?? '';
$identifier = $controller->getIdentifier();

if (isset($item)) {
    // Detail View
    $c = \Concrete\Core\Page\Page::getCurrentPage();
    ?>
    <h3 id="<?= $identifier ?>"><?= h($item->getName()) ?></h3>
    <table class="table">
        <tr>
            <th><?= t('Height') ?></th>
            <td><?= Punic\Number::format($item->getHeight() / 10) ?>m</td>
        </tr>
        <tr>
            <th><?= t('Weight') ?></th>
            <td><?= Punic\Number::format($item->getWeight() / 10) ?>kg</td>
        </tr>
    </table>
    <a href="<?= $c->getCollectionLink() ?>"
       class="btn btn-primary"><?= t('Back') ?></a>
    <?php
} else {
    // List View
    ?>
    <div id="<?= $identifier ?>">
        <?php
        if ($title) {
            ?>
            <h3><?= h($title) ?></h3>
            <?php
        }
        ?>
        <ul>
            <?php
            /** @var \Macareux\Boilerplate\Poke\Result\ResourceListItem $result */
            foreach ($results as $result) {
                ?>
                <li>
                    <a href="<?= h($view->action('view_detail', $result->getName())) ?>">
                        <?= h($result->getName()) ?>
                    </a>
                </li>
                <?php
            }
            ?>
        </ul>
        <?= $pagination ?>
    </div>
    <?php
}

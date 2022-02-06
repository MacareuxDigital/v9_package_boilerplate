<?php

namespace Concrete\Package\V9PackageBoilerplate\Block\BoilerplatePokeApi;

use Concrete\Core\Block\BlockController;
use Concrete\Core\Error\ErrorList\ErrorList;
use Concrete\Core\Utility\Service\Validation\Numbers;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Contracts\Container\BindingResolutionException;
use Macareux\Boilerplate\Poke\ApiException;
use Macareux\Boilerplate\Poke\Pokemon;
use Psr\Log\LoggerInterface;

class Controller extends BlockController
{
    /**
     * @var string Defaults to null. If a valid Block Type Set handle is passed,
     *             the block type will be installed in this set automatically,
     *             and will show up there in the Add block interface.
     */
    protected $btDefaultSet = 'multimedia';

    /**
     * @var string The block's primary database table. If specified, and if the block
     *             only uses this one database table, then the block will be able to
     *             automatically save its information to this table, provided the
     *             block's form fields map directly to the columns in the database.
     *             This value will also be set in db.xml.
     */
    protected $btTable = 'btBoilerplatePokeApi';

    /**
     * @var int The number of items per a page
     */
    protected $apiLimit;

    /**
     * @var string The title of the list
     */
    protected $listTitle;

    /**
     * {@inheritdoc}
     */
    public function getBlockTypeDescription()
    {
        return t('A boilerplate block.');
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockTypeName()
    {
        return t('PokeAPI');
    }

    /**
     * The method called when admin user trying to add a block instance.
     */
    public function add()
    {
        $this->set('apiLimit', 10);
        $this->set('listTitle', t('Find Pokemon'));
    }

    /**
     * The method called when admin user trying to edit a block instance.
     */
    public function edit()
    {
    }

    /**
     * {@inheritdoc}
     */
    public function validate($args)
    {
        /** @var ErrorList $e */
        $e = parent::validate($args);

        /** @var Numbers $numbers */
        $numbers = $this->app->make(Numbers::class);

        if (!$numbers->integer($args['apiLimit'], 1)) {
            $e->add(t('Please input valid number.'));
        }

        return $e;
    }

    /**
     * {@inheritdoc}
     */
    public function save($args)
    {
        $args['apiLimit'] = (int) $args['apiLimit'];

        parent::save($args);
    }

    /**
     * The method called when a user viewing this block instance.
     */
    public function view()
    {
        $page = (int) $this->get('page');
        $page = $page ?: 1;
        /** @var Pokemon $pokemon */
        $pokemon = $this->app->make(Pokemon::class);
        try {
            $list = $pokemon->getList($this->apiLimit, $page);
            $this->set('pagination', $list->getPagination());
            $this->set('results', $list->getResults());
        } catch (GuzzleException|BindingResolutionException|ApiException $e) {
            /** @var LoggerInterface $logger */
            $logger = $this->app->make(LoggerInterface::class);
            $logger->notice(sprintf('Failed to get list from PokeAPI: %s', $e->getMessage()));
        }
        $this->set('title', $this->listTitle);
    }

    /**
     * Methods starts with action_ can create a custom route.
     *
     * /index.php/current-page-path/view_detail/{resource_id}/{block_id}
     *
     * @param mixed $resource_id
     * @param mixed $block_id
     */
    public function action_view_detail($resource_id, $block_id)
    {
        if ((int) $block_id === $this->bID) {
            /** @var Pokemon $pokemon */
            $pokemon = $this->app->make(Pokemon::class);
            try {
                $item = $pokemon->getItem($resource_id);
                $this->set('item', $item);
            } catch (GuzzleException|BindingResolutionException|ApiException $e) {
                /** @var LoggerInterface $logger */
                $logger = $this->app->make(LoggerInterface::class);
                $logger->notice(sprintf('Failed to get Pokemon from PokeAPI: %s', $e->getMessage()));
            }
        }
    }
}

<?php

namespace Macareux\Boilerplate\Poke;

use Concrete\Core\Application\ApplicationAwareInterface;
use Concrete\Core\Application\ApplicationAwareTrait;
use Concrete\Core\Cache\Level\ExpensiveCache;
use Concrete\Core\Http\Client\Client;
use League\Url\Url;
use Macareux\Boilerplate\Poke\Result\ResourceItemInterface;
use Macareux\Boilerplate\Poke\Result\ResourceList;
use Macareux\Boilerplate\Poke\Result\ResourceListInterface;

abstract class AbstractApi implements ApiInterface, ApplicationAwareInterface
{
    use ApplicationAwareTrait;

    protected $endpoint;

    /**
     * @see https://pokeapi.co/docs/v2#resource-listspagination-section
     *
     * @param int $limit
     * @param int $offset
     *
     * @throws ApiException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     *
     * @return ResourceListInterface
     */
    public function getList(int $limit = 10, int $page = 1): ResourceListInterface
    {
        $url = Url::createFromUrl($this->endpoint);
        $url->setQuery([
            'limit' => $limit,
            'offset' => $limit * ($page - 1),
        ]);
        /** @var Client $client */
        $client = $this->app->make('http/client');
        $response = $client->request('GET', (string) $url);

        if ($response->getStatusCode() === 200) {
            $json = json_decode($response->getBody()->getContents());

            return new ResourceList($json, $page);
        }
        throw new ApiException($response->getReasonPhrase());
    }

    /**
     * @param string $name
     *
     * @throws ApiException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     *
     * @return ResourceItemInterface
     */
    public function getItem(string $name): ResourceItemInterface
    {
        /**
         * @see https://www.stashphp.com/
         *
         * @var ExpensiveCache $expensiveCache
         */
        $expensiveCache = $this->app->make('cache/expensive');
        if ($expensiveCache->isEnabled()) {
            $item = $expensiveCache->getItem($this->getCacheKey($name));
            if ($item->isHit()) {
                return $item->get();
            }
                $item->lock();
                $result = $this->getApiResource($name);
                $expensiveCache->save($item->set($result));

                return $result;
        }

            return $this->getApiResource($name);
    }

    /**
     * @param string $name
     *
     * @throws ApiException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     *
     * @return ResourceItemInterface
     */
    protected function getApiResource(string $name): ResourceItemInterface
    {
        /** @var Client $client */
        $client = $this->app->make('http/client');
        $response = $client->request('GET', $this->endpoint . DIRECTORY_SEPARATOR . $name);

        if ($response->getStatusCode() === 200) {
            $json = json_decode($response->getBody()->getContents());

            return $this->getResult($json);
        }

        throw new ApiException($response->getReasonPhrase());
    }

    abstract protected function getResult($result): ResourceItemInterface;

    abstract protected function getCacheKey(string $name): string;
}

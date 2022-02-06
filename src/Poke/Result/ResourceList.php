<?php

namespace Macareux\Boilerplate\Poke\Result;

use Concrete\Core\Http\Request;
use Concrete\Core\Url\Url;
use Pagerfanta\Adapter\FixedAdapter;
use Pagerfanta\Pagerfanta;
use Pagerfanta\View\TwitterBootstrap5View;

class ResourceList implements ResourceListInterface
{
    /**
     * @var int
     */
    protected $count;

    /**
     * @var string
     */
    protected $next;

    /**
     * @var string
     */
    protected $previous;

    /**
     * @var ResourceListItem[]
     */
    protected $results = [];

    /**
     * @var int
     */
    protected $page;

    public function __construct($json, int $page = 1)
    {
        $this->count = $json->count;
        $this->next = $json->next;
        $this->previous = $json->previous;
        foreach ($json->results as $result) {
            $this->results[] = new ResourceListItem($result->name, $result->url);
        }
        $this->page = $page;
    }

    public function getTotalCount(): int
    {
        return $this->count;
    }

    public function getNextURL(): string
    {
        return $this->next;
    }

    public function getPreviousURL(): string
    {
        return $this->previous;
    }

    public function getResults(): array
    {
        return $this->results;
    }

    public function getCount(): int
    {
        return count($this->results);
    }

    public function getPagination(): string
    {
        $adapter = new FixedAdapter($this->getTotalCount(), $this->getResults());
        $pagerfanta = new Pagerfanta($adapter);
        $pagerfanta->setCurrentPage($this->page);
        $view = new TwitterBootstrap5View();
        $routeGenerator = function (int $page): string {
            $request = Request::getInstance();
            $uri = Url::createFromUrl($request->getRequestUri());
            $uri->getQuery()->modify(['page' => $page]);

            return (string) $uri;
        };

        return $view->render($pagerfanta, $routeGenerator);
    }
}

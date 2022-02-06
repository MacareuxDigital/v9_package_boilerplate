<?php

namespace Macareux\Boilerplate\Poke;

use Macareux\Boilerplate\Poke\Result\ResourceItemInterface;

class Pokemon extends AbstractApi
{
    protected $endpoint = 'https://pokeapi.co/api/v2/pokemon/';

    protected function getResult($result): ResourceItemInterface
    {
        return new Result\Pokemon($result->id, $result->name, $result->height, $result->weight);
    }

    protected function getCacheKey(string $name): string
    {
        return 'pokeapi/pokemon/' . $name;
    }
}

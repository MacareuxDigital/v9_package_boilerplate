<?php

namespace Macareux\Boilerplate\Poke;

use Macareux\Boilerplate\Poke\Result\ResourceItemInterface;
use Macareux\Boilerplate\Poke\Result\ResourceListInterface;

interface ApiInterface
{
    public function getList(int $limit = 10, int $page = 1): ResourceListInterface;

    public function getItem(string $name): ResourceItemInterface;
}

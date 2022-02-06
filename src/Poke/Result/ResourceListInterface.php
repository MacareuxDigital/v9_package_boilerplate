<?php

namespace Macareux\Boilerplate\Poke\Result;

interface ResourceListInterface
{
    public function getTotalCount(): int;

    public function getNextURL(): string;

    public function getPreviousURL(): string;

    public function getResults(): array;

    public function getCount(): int;

    public function getPagination(): string;
}

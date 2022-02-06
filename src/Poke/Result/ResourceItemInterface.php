<?php

namespace Macareux\Boilerplate\Poke\Result;

interface ResourceItemInterface
{
    public function getId(): int;

    public function getName(): string;
}

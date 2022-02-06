<?php

namespace Macareux\Boilerplate\Poke\Result;

class Pokemon implements ResourceItemInterface
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var int
     */
    protected $height;

    /**
     * @var int
     */
    protected $weight;

    /**
     * @param int $id
     * @param string $name
     * @param int $height
     * @param int $weight
     */
    public function __construct(int $id, string $name, int $height, int $weight)
    {
        $this->id = $id;
        $this->name = $name;
        $this->height = $height;
        $this->weight = $weight;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getHeight(): int
    {
        return $this->height;
    }

    /**
     * @return int
     */
    public function getWeight(): int
    {
        return $this->weight;
    }
}

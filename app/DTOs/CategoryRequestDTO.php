<?php

namespace App\DTOs;

class CategoryRequestDTO
{
    /**
     * @var string
     */
    private $name;

    public function getName(): string
    {
        return $this->name;
    }

    public function __construct(string $name)
    {
        $this->name = $name;
    }
}

<?php

namespace App\DTOs\Category;

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

<?php

namespace App\DTOs;

class CategoryResponseDTO
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $name;

    public function __construct (int $id, string $name) {
        $this->id = $id;
        $this->name = $name;
    }
}

<?php

namespace App\DTOs\Task;

use App\DTOs\Category\CategoryResponseDTO;
use DateTimeImmutable;

class TaskResponseDTO
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string|null
     */
    public $description;

    /**
     * @var string
     */
    public $status;

    /**
     * @var DateTimeImmutable|null
     */
    public $time;

    /**
     * @var CategoryResponseDTO|null
     */
    public $category;

    /**
     * @var DateTimeImmutable
     */
    public $createdAt;

    /**
     * @var DateTimeImmutable
     */
    public $updatedAt;

    public function __construct(
        int $id,
        string $name,
        ?string $description,
        string $status,
        ?DateTimeImmutable $time,
        ?CategoryResponseDTO $category,
        DateTimeImmutable $createdAt,
        DateTimeImmutable $updatedAt
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->status = $status;
        $this->time = $time;
        $this->category = $category;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }
}

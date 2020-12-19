<?php

namespace App\DTOs;

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

    // @TODO add category DTO
    /**
     * @var int|null
     */
    public $categoryId;

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
        ?int $categoryId,
        DateTimeImmutable $createdAt,
        DateTimeImmutable $updatedAt
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->status = $status;
        $this->time = $time;
        $this->categoryId = $categoryId;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }
}

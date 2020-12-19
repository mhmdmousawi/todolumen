<?php

namespace App\DTOs;

use DateTimeImmutable;

class TaskRequestDTO
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string|null
     */
    private $description;

    /**
     * @var DateTimeImmutable|null
     */
    private $time;

    /**
     * @var int|null
     */
    private $categoryId;

    public function __construct(
        string $name,
        ?string $description,
        ?DateTimeImmutable $time,
        ?int $categoryId
    ) {
        $this->name = $name;
        $this->description = $description;
        $this->time = $time;
        $this->categoryId = $categoryId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getTime(): ?DateTimeImmutable
    {
        return $this->time;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getCategoryId(): ?int
    {
        return $this->categoryId;
    }
}

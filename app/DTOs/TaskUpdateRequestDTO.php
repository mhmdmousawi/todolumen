<?php

namespace App\DTOs;

use DateTimeImmutable;

class TaskUpdateRequestDTO extends TaskRequestDTO
{
    /**
     * @var string
     */
    private $status;

    public function __construct(
        string $name,
        ?string $description,
        ?DateTimeImmutable $time,
        ?CategoryRequestDTO $category,
        string $status
    ) {
        parent::__construct(
            $name,
            $description,
            $time,
            $category
        );

        $this->status = $status;
    }

    public function getStatus(): string
    {
        return $this->status;
    }
}

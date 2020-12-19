<?php

namespace App\DTOFactories;

use App\DTOs\TaskResponseDTO;
use App\Models\Task;
use DateTimeImmutable;

class TaskResponseDTOFactory
{
    public function create(Task $task): TaskResponseDTO
    {
        return new TaskResponseDTO(
            $task->id,
            $task->name,
            $task->description,
            $task->status,
            $task->time ? new DateTimeImmutable($task->time): null,
            $task->category_id,
            new DateTimeImmutable($task->created_at),
            new DateTimeImmutable($task->updated_at)
        );
    }

    /**
     * @param Task[] $tasks
     *
     * @return TaskResponseDTO[]
     */
    public function createDTOs(array $tasks): array
    {
        return array_map(function (Task $task) {
            return $this->create($task);
            }, $tasks
        );
    }
}

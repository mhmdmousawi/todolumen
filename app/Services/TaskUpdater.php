<?php

namespace App\Services;

use App\DTOs\TaskUpdateRequestDTO;
use App\Models\Task;

class TaskUpdater
{
    public function update(Task $task, TaskUpdateRequestDTO $taskUpdateRequestDTO): Task
    {
        $task->name = $taskUpdateRequestDTO->getName();
        $task->description = $taskUpdateRequestDTO->getDescription();
        $task->time = $taskUpdateRequestDTO->getTime();
        $task->status = $taskUpdateRequestDTO->getStatus();
        $task->category_id = $taskUpdateRequestDTO->getCategoryId();
        $task->save();

        return $task;
    }
}

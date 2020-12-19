<?php

namespace App\Services;

use App\Dictionaries\TaskStatusDictionary;
use App\DTOs\Task\TaskRequestDTO;
use App\Models\Task;
use App\Models\User;

class TaskCreator
{
    public function create(User $user, TaskRequestDTO $taskRequestDTO): Task
    {
        $task = new Task();
        $task->name = $taskRequestDTO->getName();
        $task->description = $taskRequestDTO->getDescription();
        $task->time = $taskRequestDTO->getTime();
        $task->status = TaskStatusDictionary::TODO;
        $task->category_id = $taskRequestDTO->getCategoryId();
        $task->user_id = $user->id;
        $task->save();

        return $task;
    }
}

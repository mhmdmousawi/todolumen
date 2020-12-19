<?php

namespace App\Providers;

use App\Models\Task;

class TaskProvider
{
    /**
     * @return Task[]
     */
    public function provideFromArray(array $tasks): array
    {
        return array_map(function($task) {
            $taskObject = new Task();
            $taskObject->id = $task['id'];
            $taskObject->name = $task['name'];
            $taskObject->description = $task['description'];
            $taskObject->time = $task['time'];
            $taskObject->status = $task['status'];
            $taskObject->category_id = $task['category_id'];
            $taskObject->user_id = $task['user_id'];
            $taskObject->created_at = $task['created_at'];
            $taskObject->updated_at = $task['updated_at'];

            return $taskObject;
        }, $tasks);
    }
}

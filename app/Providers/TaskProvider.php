<?php


namespace App\Providers;

use App\Http\Filters\Filter;
use App\Models\Task;
use App\Models\User;

class TaskProvider
{
    /**
     * @return Task[]
     */
    public function provideByUserAndFilter(User $user, Filter $filter): array
    {
        return Task::filter($filter)
            ->where('user_id', $user->id)
            ->get()
            ->all();
    }
}

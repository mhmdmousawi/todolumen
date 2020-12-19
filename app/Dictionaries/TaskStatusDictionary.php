<?php

namespace App\Dictionaries;

final class TaskStatusDictionary
{
    const TODO = 'Todo';
    const COMPLETED = 'Completed';
    const SNOOZED = 'Snoozed';
    const OVERDUE = 'Overdue';

    public static function getAll(): array
    {
        return [
            self::TODO,
            self::COMPLETED,
            self::OVERDUE,
            self::SNOOZED
        ];
    }
}

<?php

namespace Providers;

use App\Models\Task;
use App\Providers\TaskProvider;
use PHPUnit\Framework\TestCase;

class TaskProviderTest extends TestCase
{
    public function testProvideTasksFromArray(): void
    {
        $taskProvider = new TaskProvider();
        $time = time();

        $tasks = [
            [
                'id' => 1,
                'name' => 'name',
                'description' => 'description',
                'time' => $time,
                'status' => 'Todo',
                'category_id' => 1,
                'user_id' => 1
            ], [
                  'id' => 2,
                  'name' => 'name1',
                  'description' => 'description1',
                  'time' => $time,
                  'status' => 'Completed',
                  'category_id' => 2,
                  'user_id' => 2
            ],
        ];

        $tasksObjects = $taskProvider->provideFromArray($tasks);

        $this->assertIsArray($tasksObjects);
        $this->assertInstanceOf(Task::class, $tasksObjects[0]);
        $this->assertEquals(1, $tasksObjects[0]['id']);
        $this->assertEquals(2, $tasksObjects[1]['id']);
        $this->assertEquals('name', $tasksObjects[0]['name']);
        $this->assertEquals('name1', $tasksObjects[1]['name']);
        $this->assertEquals('description', $tasksObjects[0]['description']);
        $this->assertEquals('description1', $tasksObjects[1]['description']);
        $this->assertEquals($time, $tasksObjects[0]['time']);
        $this->assertEquals($time, $tasksObjects[1]['time']);
        $this->assertEquals("Todo", $tasksObjects[0]['status']);
        $this->assertEquals('Completed', $tasksObjects[1]['status']);
        $this->assertEquals(1, $tasksObjects[0]['category_id']);
        $this->assertEquals(2, $tasksObjects[1]['category_id']);
        $this->assertEquals(1, $tasksObjects[0]['user_id']);
        $this->assertEquals(2, $tasksObjects[1]['user_id']);
    }
}

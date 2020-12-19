<?php

namespace App\DTOFactories\Task;

use App\DTOFactories\Category\CategoryResponseDTOFactory;
use App\DTOs\Task\TaskResponseDTO;
use App\Models\Category;
use App\Models\Task;
use DateTimeImmutable;

class TaskResponseDTOFactory
{
    /**
     * @var CategoryResponseDTOFactory
     */
    private $categoryResponseDTOFactory;

    public function __construct(CategoryResponseDTOFactory $categoryResponseDTOFactory)
    {
        $this->categoryResponseDTOFactory = $categoryResponseDTOFactory;
    }

    public function create(Task $task): TaskResponseDTO
    {
        /** @var Category $category */
        $category = $task->category_id ? Category::find($task->category_id) : null;

        return new TaskResponseDTO(
            $task->id,
            $task->name,
            $task->description,
            $task->status,
            new DateTimeImmutable($task->time),
            $category ? $this->categoryResponseDTOFactory->create($category): null,
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

<?php

namespace App\DTOFactories\Task;

use App\DTOs\Task\TaskUpdateRequestDTO;
use DateTimeImmutable;
use Illuminate\Http\Request;

class TaskUpdateRequestDTOFactory
{
    public function create(Request $request): TaskUpdateRequestDTO
    {
        return new TaskUpdateRequestDTO(
            $request->input('name'),
            $request->input('description'),
            $request->input('time')
                ? DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $request->input('time'))
                : null,
            $request->input('category_id'),
            $request->input('status')
        );
    }
}

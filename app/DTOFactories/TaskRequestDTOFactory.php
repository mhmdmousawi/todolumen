<?php

namespace App\DTOFactories;

use App\DTOs\TaskRequestDTO;
use DateTimeImmutable;
use Illuminate\Http\Request;

class TaskRequestDTOFactory
{
    public function create(Request $request): TaskRequestDTO
    {
        return new TaskRequestDTO(
            $request->input('name'),
            $request->input('description'),
            $request->input('time')
                ? DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $request->input('time'))
                : null,
            $request->input('category_id')
        );
    }
}

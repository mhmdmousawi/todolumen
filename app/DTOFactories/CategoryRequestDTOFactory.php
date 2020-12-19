<?php

namespace App\DTOFactories;

use App\DTOs\CategoryRequestDTO;
use Illuminate\Http\Request;

class CategoryRequestDTOFactory
{
    public function create(Request $request): CategoryRequestDTO
    {
        return new CategoryRequestDTO($request->input('name'),);
    }
}

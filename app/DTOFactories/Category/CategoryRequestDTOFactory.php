<?php

namespace App\DTOFactories\Category;

use App\DTOs\Category\CategoryRequestDTO;
use Illuminate\Http\Request;

class CategoryRequestDTOFactory
{
    public function create(Request $request): CategoryRequestDTO
    {
        return new CategoryRequestDTO($request->input('name'),);
    }
}

<?php

namespace App\DTOFactories;

use App\DTOs\CategoryResponseDTO;
use App\Models\Category;

class CategoryResponseDTOFactory
{
    public function create(Category $category): CategoryResponseDTO
    {
        return new CategoryResponseDTO($category->id, $category->name);
    }

    /**
     * @param Category[] $category
     *
     * @return CategoryResponseDTO[]
     */
    public function createDTOs(array $categories): array
    {
        return array_map(function (Category $category) {
            return $this->create($category);
            }, $categories
        );
    }
}

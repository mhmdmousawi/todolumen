<?php

namespace App\Services;

use App\DTOs\CategoryRequestDTO;
use App\Models\Category;

class CategoryUpdater
{
    public function update(Category $category, CategoryRequestDTO $categoryRequestDTO): Category
    {
        $category->name = $categoryRequestDTO->getName();
        $category->save();

        return $category;
    }
}

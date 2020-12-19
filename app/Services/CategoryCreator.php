<?php

namespace App\Services;

use App\DTOs\CategoryRequestDTO;
use App\Models\Category;
use App\Models\User;

class CategoryCreator
{
    public function create(User $user, CategoryRequestDTO $categoryRequestDTO): Category
    {
        $category = new Category();
        $category->name = $categoryRequestDTO->getName();
        $category->user_id = $user->id;
        $category->save();

        return $category;
    }
}

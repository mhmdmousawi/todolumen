<?php

namespace App\Services;

use App\Exceptions\UnableToRemoveCategoryException;
use App\Models\Category;

class CategoryRemoveService
{
    public function remove(Category $category): void
    {
        if (count($category->tasks)) {
            throw new UnableToRemoveCategoryException();
        }

        $category->delete();
    }
}

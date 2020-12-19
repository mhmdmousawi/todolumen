<?php

namespace App\Models;

use App\Concerns\Filterable;
use App\Dictionaries\TaskStatusDictionary;
use ElemenX\ApiPagination\Paginatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Task extends Model
{
    use Paginatable;
    use Filterable;

    public static function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:65535',
            'time' => 'nullable|date',
            'status' => [Rule::in(TaskStatusDictionary::getAll())],
            'category_id' => 'nullable|int|exists:categories,id'
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}

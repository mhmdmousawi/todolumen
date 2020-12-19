<?php

namespace App\Http\Filters;

use DateTimeImmutable;
use Illuminate\Database\Eloquent\Builder;

class TasksFilter extends Filter
{
    public function status(string $value = null): Builder
    {
        return $this->builder->where('status', $value);
    }

    public function categoryId(string $value = null): Builder
    {
        if ($value == 'null') {
            return $this->builder->where('category_id', null);
        }

        return $this->builder->where('category_id', $value);
    }

    public function day(string $value = null): Builder
    {
        return $this->builder->where('time', '=', $value);
    }

    public function month(string $value = null): Builder
    {
        $date = DateTimeImmutable::createFromFormat("Y-m", $value);
        $year =  $date->format("Y");
        $month =  $date->format("m");

        return $this->builder
            ->whereYear('time', '=', $year)
            ->whereMonth('time', '=', $month);
    }

    public function sort(array $value = []): Builder
    {
        // Add whatever sorts you want
        if ($value['by'] == 'time') {
            return $this->builder->orderBy('time', $value['order'] ?? 'asc');
        }

        return $this->builder->orderBy('created_at', 'desc');
    }
}

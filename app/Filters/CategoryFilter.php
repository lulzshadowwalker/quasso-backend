<?php

namespace App\Filters;

class CategoryFilter extends QueryFilter
{
    protected $sortable = [
        'name',
        'description',
        'updatedAt' => 'updated_at',
        'createdAt' => 'created_at',
    ];

    public function include($relationships)
    {
        $allowedRelationships = ['items', 'restaurant'];

        $relationships = explode(',', $relationships);
        $relationships = array_intersect($relationships, $allowedRelationships);

        return $this->builder->with($relationships);
    }

    public function createdAt($value)
    {
        $dates = explode(',', $value);

        if (count($dates) > 1) {
            return $this->builder->whereBetween('created_at', $dates);
        }

        return $this->builder->whereDate('created_at', $value);
    }

    public function updatedAt($value)
    {
        $dates = explode(',', $value);

        if (count($dates) > 1) {
            return $this->builder->whereBetween('updated_at', $dates);
        }

        return $this->builder->whereDate('updated_at', $value);
    }

    public function name($value)
    {
        $likeStr = str_replace('*', '%', $value);
        return $this->builder->where('name', 'like', $likeStr);
    }

    public function description($value)
    {
        $likeStr = str_replace('*', '%', $value);
        return $this->builder->where('description', 'like', $likeStr);
    }
}

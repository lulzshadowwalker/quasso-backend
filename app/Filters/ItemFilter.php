<?php

namespace App\Filters;

class ItemFilter extends QueryFilter
{
    protected $sortable = [
        'name',
        'description',
        'updatedAt' => 'updated_at',
        'createdAt' => 'created_at',
    ];

    public function include(string $relationships)
    {
        $allowedRelationships = ['categories', 'restaurant', 'optionGroups'];

        $relationships = explode(',', $relationships);
        $relationships = array_intersect($relationships, $allowedRelationships);

        return $this->builder->with($relationships);
    }

    public function createdAt(string $value)
    {
        $dates = explode(',', $value);

        if (count($dates) > 1) {
            return $this->builder->whereBetween('created_at', $dates);
        }

        return $this->builder->whereDate('created_at', $value);
    }

    public function updatedAt(string $value)
    {
        $dates = explode(',', $value);

        if (count($dates) > 1) {
            return $this->builder->whereBetween('updated_at', $dates);
        }

        return $this->builder->whereDate('updated_at', $value);
    }

    public function name(string $value)
    {
        $likeStr = str_replace('*', '%', $value);
        return $this->builder->where('name', 'like', $likeStr);
    }

    public function description(string $value)
    {
        $likeStr = str_replace('*', '%', $value);
        return $this->builder->where('description', 'like', $likeStr);
    }

    public function category(string $value)
    {
        $categories = explode(',', $value);

        return $this->builder->whereHas('categories', function ($query) use ($categories) {
            $query->whereIn('categories.id', $categories);
        });
    }

    public function search(string $value)
    {
        $likeStr = str_replace('*', '%', $value);
        if (strpos($likeStr, '%') === false) {
            $likeStr = '%' . $likeStr . '%';
        }

        return $this->builder->whereRaw('LOWER(name) LIKE LOWER(?)', [$likeStr])
            ->orWhereRaw('LOWER(description) LIKE LOWER(?)', [$likeStr])
            ->orWhereHas('categories', function ($query) use ($likeStr) {
                $query->whereRaw('LOWER(name) LIKE LOWER(?)', [$likeStr]);
            });
    }
}

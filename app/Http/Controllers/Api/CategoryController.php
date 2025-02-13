<?php

namespace App\Http\Controllers\Api;

use App\Filters\CategoryFilter;
use App\Http\Resources\CategoryResource;
use App\Models\Category;

class CategoryController extends ApiController
{
    public function index(CategoryFilter $filters)
    {
        return CategoryResource::collection(Category::filter($filters)->get());
    }

    public function show(string $restaurant, string $language, Category $category)
    {
        $includes = ['items', 'restaurant'];
        foreach ($includes as $include) {
            if ($this->includes($include)) {
                $category->load($include);
            }
        }

        return CategoryResource::make($category);
    }
}

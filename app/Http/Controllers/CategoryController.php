<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function findAllCategories()
    {
        $categories = Categories::query()->select(['id', 'name', 'slug'])->get();

        return $this->responseServer(200, [
            "statusCode" => 200,
            "data" => $categories
        ]);
    }

    public function findCategoryWithPosts($slug)
    {
        $categories = Categories::query()->select(['id', 'name', 'slug'])->with(['posts' => function ($query) {
                $query->select(['id', 'title', 'slug', 'excerpt', 'content', 'category_id', 'user_id']);
            }])
            ->where('slug', $slug)
            ->first();

        if (!$categories) {
            return $this->responseServer(404, ['message' => 'Category not found']);
        }

        return $this->responseServer(200, [
            "statusCode" => 200,
            "data" => $categories
        ]);
    }
}

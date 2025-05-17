<?php

namespace App\Http\Controllers;

use App\Models\Post;

class PostController extends Controller
{
    public function findAllPosts()
    {
        $posts = Post::query()->select(['id', 'slug', 'excerpt', 'content', 'created_at'])->with(['user', 'category'])->get();

        return $this->responseServer(200, [
            "statusCode" => 200,
            "data" => $posts
        ]);
    }

    public function findPostBySlug($slug)
    {
        $post = Post::query()->select(['id', 'title', 'slug', 'excerpt', 'content', 'created_at'])->with(['user', 'category'])->where('slug', $slug)->first();

        if (!$post) {
            return $this->responseServer(404, ['message' => 'Post not found']);
        }

        return $this->responseServer(200, [
            "statusCode" => 200,
            "data" => $post
        ]);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function getPosts(Request $request)
    {
        $data = $request->all();
        $query = Post::with('categories');

        if (array_key_exists('title', $data)) {
            $phrase = substr($data['title'], 1, -1);
            $query->whereRaw('title like ?', ["$phrase%"]);
        }

        if (array_key_exists('category', $data)) {
            $query->whereHas('categories', function ($query) use ($data) {
                $categoryName = substr($data['category'], 1, -1);
                $query->where('name', $categoryName);
            });
        }

        $posts = $query->get()->toArray();

        return response()->json($posts);
    }
}
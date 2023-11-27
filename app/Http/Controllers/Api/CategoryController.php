<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    function index(Request $request): JsonResponse
    {
        $categories = Category::orderBy('order')->paginate();
        if ($request->boolean('with_posts')) {
            $postLimit = $request->get('post_limit') ?? 15;
            $categories->getCollection()->transform(function ($category) use ($postLimit) {
                $category->setRelation('posts', $category->posts->take($postLimit));
                $category->posts->load('author');
                return $category;
            });
        }
        return response()->json($categories);
    }

    function show($slug): JsonResponse
    {
        $category = Category::whereSlug($slug)->firstOrFail();
        return response()->json($category);
    }
}

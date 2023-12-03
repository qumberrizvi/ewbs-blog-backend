<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    function index(Request $request): JsonResponse
    {
        $limit = $request->get('limit') ?? 15;
        $orderBy = ($request->boolean('popular')) ? 'read_count' : 'created_at';
        $posts = Post::published()->with(['author', 'category'])
            ->orderBy($orderBy, 'desc');
        if ($request->boolean('featured')) {
            $posts = $posts->where('featured', 1);
        }
        $posts = $posts->paginate($limit);
        return response()->json($posts);
    }

    function show($slug): JsonResponse
    {
        $post = Post::published()->with(['author', 'category'])
            ->where('slug', $slug)
            ->firstOrFail();
        $post->increment('read_count');
        return response()->json($post);
    }

    function indexByCategory(Request $request, string $slug): JsonResponse
    {
        $limit = $request->get('limit') ?? 15;
        $posts = Post::published()->whereRelation('category', 'slug', $slug)
            ->with(['author', 'category'])
            ->latest()
            ->paginate($limit);
        return response()->json($posts);
    }
}

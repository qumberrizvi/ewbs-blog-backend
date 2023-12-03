<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace' => 'App\Http\Controllers\Api'], function () {
    Route::get('posts/search', [PostController::class, 'search']);
    Route::apiResource('posts', PostController::class, [
        'only' => ['index', 'show']
    ]);

    Route::get('categories/{slug}/posts', [PostController::class, 'indexByCategory']);
    Route::apiResource('categories', CategoryController::class, [
        'only' => ['index', 'show']
    ]);
});

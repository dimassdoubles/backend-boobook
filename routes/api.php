<?php

use App\Http\Controllers\Api\BookCategoryController;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\BookGalleryController;
use App\Http\Controllers\Api\TransactionController;
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

// Route::apiResource('/posts', \App\Http\Controllers\Api\PostController::class);

// Route::apiResource('/books', BookController::class);

// dengan apiresource, akan otomatis dibuatkan method route (index, store, show, update, destroy)
Route::apiResources([
    '/posts' => PostController::class,
    '/books' => BookController::class,
    '/bookcategories' => BookCategoryController::class,
    '/bookgalleries' => BookGalleryController::class,
    '/transactions' => TransactionController::class,
]);

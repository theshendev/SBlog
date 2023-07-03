<?php

use App\Http\Controllers\API\PostCommentController;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\PostLikeController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\VideoCommentController;
use App\Http\Controllers\API\VideoController;
use App\Http\Controllers\API\VideoLikeController;
use App\Http\Controllers\FavoriteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::middleware('auth.userId')->group(function () {
    Route::post('post/{id}/comment', [PostCommentController::class, 'store']);
    Route::post('video/{id}/comment', [VideoCommentController::class, 'store']);

    Route::post('video/{id}/like', [VideoLikeController::class, 'like']);
    Route::post('video/{id}/dislike', [VideoLikeController::class, 'dislike']);
    Route::delete('video/{id}/remove-like', [VideoLikeController::class, 'destroy']);

    Route::post('post/{id}/like', [PostLikeController::class, 'like']);
    Route::post('post/{id}/dislike', [PostLikeController::class, 'dislike']);
    Route::delete('post/{id}/remove-like', [PostLikeController::class, 'destroy']);

    // Mark a post as favorite
    Route::post('post/{post}/favorite', [FavoriteController::class, 'store']);

    // Remove a post from favorites
    Route::delete('post/{post}/favorite', [FavoriteController::class, 'destroy']);

    // Get all of the user's favorite posts
    Route::get('user/favorites', [FavoriteController::class, 'index']);
});

Route::resource('user', UserController::class)->parameter('user', 'id')->only(['show', 'store']);
Route::resource('post', PostController::class)->parameter('post', 'id')->only(['show', 'store']);
Route::resource('video', VideoController::class)->parameter('video', 'id')->only(['show', 'store']);
Route::post('video/upload', [VideoController::class, 'upload']);

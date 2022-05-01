<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AdminPostController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\AdminContactController;
use App\Http\Controllers\Admin\AdminSubscribeController;
use App\Http\Controllers\Admin\AdminCommentController;
use App\Http\Controllers\Admin\AdminAuth;
use App\Http\Controllers\Frontend\PostController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\SubscribeController;
use App\Http\Controllers\Frontend\CommentController;

Route::post('/login', [AdminAuth::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('/admin')->group(function(){
        //Auth
        Route::get('/admin', [AdminAuth::class, 'admin']);
        Route::post('/logout', [AdminAuth::class, 'logout']);

        Route::get('/categories', [CategoryController::class, 'index']);
        Route::post('/category', [CategoryController::class, 'store']);
        Route::patch('/category/{id}', [CategoryController::class, 'edit']);
        Route::post('/category/{id}', [CategoryController::class, 'update']);
        Route::delete('/category/{id}', [CategoryController::class, 'delete']);
        Route::get('/category/{search}', [CategoryController::class, 'search']);

        //api for post
        Route::get('/posts', [AdminPostController::class, 'index']);
        Route::post('/posts', [AdminPostController::class, 'store']);
        Route::put('/posts/{id}', [AdminPostController::class, 'edit']);
        Route::post('/posts/{id}', [AdminPostController::class, 'update']);
        Route::delete('/posts/{id}', [AdminPostController::class, 'delete']);
        Route::get('/posts/{search}', [AdminPostController::class, 'search']);

        // Setting routes
        Route::get('/setting', [SettingController::class, 'index']);
        Route::post('/setting/{id}', [SettingController::class, 'update']);

        //Contact routes
        Route::get('/contact', [AdminContactController::class, 'getContact']);
        Route::delete('/contact/{id}', [AdminContactController::class, 'delete']);

        //Subscribe routes
        Route::get('/subscribe', [AdminSubscribeController::class, 'index']);
        Route::delete('/subscribe/{id}', [AdminSubscribeController::class, 'delete']);

        //Comment routes
        Route::get('/comment', [AdminCommentController::class, 'index']);
        Route::delete('/comment/{id}', [AdminCommentController::class, 'delete']);
    });
});

Route::prefix('/front')->group(function() {
    Route::get('/all-post', [PostController::class, 'index']);
    Route::get('/view-post', [PostController::class, 'viewPost']);
    Route::get('/single-post/{id}', [PostController::class, 'getPostById']);
    Route::get('/category-post/{id}', [PostController::class, 'getPostByCategory']);
    Route::get('/search-post/{search}', [PostController::class, 'searchPost']);
    Route::post('/contact', [ContactController::class, 'store']);
    Route::post('/subscribe', [SubscribeController::class, 'store']);
    Route::post('/comment/{id}', [CommentController::class, 'store']);
    Route::get('/comment', [CommentController::class, 'getComment']);
});

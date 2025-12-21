<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::apiResource('/posts', PostController::class);
Route::apiResource('/categories', CategoryController::class);
Route::apiResource('/authors', AuthorController::class);
Route::apiResource('/comments', CommentController::class);


<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::post('/auth', [PostController::class, 'authenticate']);
Route::post('/posts', [PostController::class, 'create']);
Route::get('/posts', [PostController::class, 'index']);
Route::patch('/posts/{id}', [PostController::class, 'update']);
Route::delete('/posts/{id}', [PostController::class, 'destroy']);
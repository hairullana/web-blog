<?php

use App\Http\Controllers\AdminCategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardPostController;
use App\Http\Controllers\PostController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Posts API
Route::get('/posts', [PostController::class, 'index']);
Route::get('/post/{id}', [PostController::class, 'show']);
Route::post('/post/store', [DashboardPostController::class, 'store']);
Route::post('/post/update/{id}', [DashboardPostController::class, 'update']);
Route::delete('/post/{id}', [DashboardPostController::class, 'destroy']);

// Categories API
Route::get('/categories', [AdminCategoryController::class, 'index']);
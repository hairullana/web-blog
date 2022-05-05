<?php

use App\Http\Controllers\DashboardCategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardPostController;

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
Route::get('/posts', [DashboardPostController::class, 'index']);
Route::get('/post/{id}', [DashboardPostController::class, 'show']);
Route::post('/post/store', [DashboardPostController::class, 'store']);
Route::post('/post/update/{id}', [DashboardPostController::class, 'update']);
Route::delete('/post/{id}', [DashboardPostController::class, 'destroy']);

// Categories API
Route::get('/categories', [DashboardCategoryController::class, 'index']);
Route::get('/category/{category:id}', [DashboardCategoryController::class, 'show']);
Route::post('/category/update/{category:id}', [DashboardCategoryController::class, 'update']);
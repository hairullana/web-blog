<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardPostController;
use App\Http\Controllers\DashboardCategoryController;
use App\Http\Controllers\UserController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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
Route::middleware('auth:sanctum')->get('/auth', function () {
  return true;
});
Route::middleware('auth:sanctum')->get('/is-admin', function () {
  return response()->json(Auth::user()->is_admin == 1 ? true : false);
});

// Auth API
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

// Posts API
Route::get('/posts/{user:id}', [DashboardPostController::class, 'index']);
Route::get('/post/{id}', [DashboardPostController::class, 'show']);
Route::post('/post/store', [DashboardPostController::class, 'store']);
Route::post('/post/update/{id}', [DashboardPostController::class, 'update']);
Route::delete('/post/{id}', [DashboardPostController::class, 'destroy']);

// Categories API
Route::get('/categories', [DashboardCategoryController::class, 'index'])->name('categories');
Route::get('/category/percentage/{user:id}', [DashboardCategoryController::class, 'categoryPercentage'])->name('category.percentage');
Route::get('/category/{category:id}', [DashboardCategoryController::class, 'show']);
Route::post('/category/update/{category:id}', [DashboardCategoryController::class, 'update']);
Route::post('/category/store', [DashboardCategoryController::class, 'store']);
Route::delete('/category/{category:id}', [DashboardCategoryController::class, 'destroy']);

// User API
Route::get('/users', [UserController::class, 'index'])->name('users');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.delete');

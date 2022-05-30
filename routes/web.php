<?php

use App\Models\Post;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Posts
Route::controller(PostController::class)->group(function () {
  Route::get('/', 'index')->name('index');
  Route::get('/post/{post:slug}', 'show');
  Route::get('/category/{category:slug}', 'showCategory');
});

// Dashboard with SPA (VueJS)
Route::get('/dashboard/{any}', [DashboardController::class, 'index'])->where('any', '.*');

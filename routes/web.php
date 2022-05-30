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
Route::get('/', [PostController::class, 'index'])->name('index');
Route::get('/post/{post:slug}', [PostController::class, 'show']);

// Dashboard with SPA (VueJS)
Route::get('/{any}', [DashboardController::class, 'index'])->where('any', '.*');

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

// Index
Route::get('/', function() {
  return view('home', [
    "title" => "Home",
    "active" => 'home',
    "posts" => Post::latest()->paginate(6)
  ]);
});

// Posts
Route::get('/posts/{post:slug}', [PostController::class, 'show']);

// Dashboard with SPA (VueJS)
Route::get('/{any}', [DashboardController::class, 'index'])->where('any', '.*');
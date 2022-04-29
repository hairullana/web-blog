<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;

class PostController extends Controller{
  public function index() {
    $title = '';

    if(request('category')) {
      $category = Category::firstWhere('slug', request('category'));
      $title = ' in ' . $category->name;
    }

    if(request('author')) {
      $author = User::firstWhere('username', request('author'));
      $title = ' by ' . $author->name;
    }

    // return json for API
    return response()->json([
      'success' => true,
      'message' => 'List Data Post',
      'data'    => Post::latest()->get()
    ], 200);
  }

  public function show($id) {
    // find post with id
    $post = Post::find($id);

    //make response JSON
    return response()->json([
        'success' => true,
        'message' => 'Detail Data Post',
        'data'    => $post 
    ], 200);
  }
}
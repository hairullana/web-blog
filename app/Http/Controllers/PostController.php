<?php

namespace App\Http\Controllers;

use App\Models\Post;

class PostController extends Controller{
  public function show(Post $post){
    return view('post.show', [
      'title' => $post->title,
      'post' => $post,
      'active' => false
    ]);
  }
}
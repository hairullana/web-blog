<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Routing\Controller;

class PostController extends Controller
{
  public function index()
  {
    return view('index', [
      "title" => "Home",
      "posts" => Post::latest()->paginate(4),
      "categories" => Category::latest()->get(),
      "popularPost" => Post::all()->random(6)
    ]);
  }

  public function show(Post $post)
  {
    return view('post.show', [
      'title' => $post->title,
      'post' => $post,
      "categories" => Category::latest()->get(),
      "popularPost" => Post::all()->random(6)
    ]);
  }

  public function showCategory($category)
  {
    $category = Category::where('slug', $category)->first();
    $posts = Post::where('category_id', $category->id)->paginate(4);

    return view('post.post-by-category', [
      'title' => 'Categories',
      'posts' => $posts,
      "categories" => Category::latest()->get(),
      "popularPost" => Post::all()->random(6)
    ]);
  }
}

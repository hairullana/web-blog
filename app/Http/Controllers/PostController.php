<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PostController extends Controller
{
  public function index(Request $request)
  {
    $posts = Post::latest();

    if ($request) {
      $posts = Post::latest();
      if ($request->category) $posts = $posts->where('category_id', Category::where('slug', $request->category)->first()->id);
      if ($request->search) $posts = $posts->where(function ($query) use ($request) {
        $query->where('title', 'like', '%' . $request->search . '%')
          ->orWhere('body', 'like', '%' . $request->search . '%')
          ->orWhere('slug', 'like', '%' . $request->search . '%');
      });
    }

    return view('index', [
      "title" => "Home",
      "posts" => $posts->paginate(4),
      "categories" => Category::latest()->get(),
      "popularPost" => Post::all()->random(Post::all()->count() == 6 ? 6 : Post::all()->count())
    ]);
  }

  public function show(Post $post)
  {
    return view('post.show', [
      'title' => $post->title,
      'post' => $post,
      "categories" => Category::latest()->get(),
      "popularPost" => Post::all()->random(Post::all()->count() == 6 ? 6 : Post::all()->count())
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
      "popularPost" => Post::all()->random(Post::all()->count() == 6 ? 6 : Post::all()->count())
    ]);
  }
}

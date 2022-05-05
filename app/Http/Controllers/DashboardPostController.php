<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class DashboardPostController extends Controller
{
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
  
  public function store(Request $request){
    //set validation
    $this->validate($request, [
      'category_id' => 'required',
      'user_id' => 'required',
      'title'   => 'required|min:3',
      'slug' => 'required',
      'excerpt' => 'required',
      'body' => 'required'
    ]);

    //save to database
    $post = Post::create([
      'category_id' => $request->category_id,
      'user_id' => $request->user_id,
      'title'   => $request->title,
      'slug' => $request->slug,
      'excerpt' => $request->excerpt,
      'body' => $request->body
    ]);

    //success save to database
    if($post) {
      return response()->json([
        'success' => true,
        'message' => 'Post Created',
        'data'    => $post  
      ], 200);
    } 

    //failed save to database
    return response()->json([
      'success' => false,
      'message' => 'Post Failed to Save',
    ], 409);
  }

  public function update(Request $request, $id){
    //set validation
    $this->validate($request, [
      'category_id' => 'required',
      'title'   => 'required|min:3',
      'slug' => 'required',
      'excerpt' => 'required',
      'body' => 'required'
    ]);

    //find post by ID
    $post = Post::findOrFail($id);

    if($post) {
      //update post
      $post->update([
        'category_id' => $request->category_id,
        'title'   => $request->title,
        'slug' => $request->slug,
        'excerpt' => $request->excerpt,
        'body' => $request->body
      ]);

      return response()->json([
        'success' => true,
        'message' => 'Post Updated',
        'data'    => $post  
      ], 200);
    }

    //data post not found
    return response()->json([
      'success' => false,
      'message' => 'Post Not Found',
    ], 404);

  }

  public function destroy($id){
    //find post by ID
    $post = Post::findOrfail($id);

    if($post) {
      //delete post
      $post->delete();

      return response()->json([
        'success' => true,
        'message' => 'Post Deleted',
      ], 200);

    }

    //data post not found
    return response()->json([
      'success' => false,
      'message' => 'Post Not Found',
    ], 404);
  }

  public function checkSlug(Request $request){
    $slug = SlugService::createSlug(Post::class, 'slug', $request->title);
    return response()->json(['slug' => $slug]);
  }
}

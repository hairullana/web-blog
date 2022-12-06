<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Storage;

class DashboardPostController extends Controller
{
  public function index($userId)
  {
    $user = User::find($userId);

    if($user->is_admin) $posts = Post::latest()->get();
    else $posts = Post::where('user_id', $userId)->latest()->get();
    // return json for API
    return response()->json([
      'success' => true,
      'message' => 'List Data Post',
      'data'    => $posts
    ], 200);
  }

  public function show($id)
  {
    // find post with id
    $post = Post::find($id);

    //make response JSON
    return response()->json([
      'success' => true,
      'message' => 'Detail Data Post',
      'data'    => $post
    ], 200);
  }

  public function store(Request $request)
  {
    // dd($request);
    //set validation
    $this->validate($request, [
      'image' => 'nullable|mimes:jpg,jpeg,png|max:2048',
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

    if ($request->image != null) $request->file('image')->move(public_path('storage\images\posts'), $post->id . '.jpg');

    //success save to database
    if ($post) {
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

  public function update(Request $request, $id)
  {
    //set validation
    $this->validate($request, [
      'image' => 'nullable|mimes:jpg,jpeg,png|max:2048',
      'category_id' => 'required',
      'title'   => 'required|min:3',
      'slug' => 'required',
      'excerpt' => 'required',
      'body' => 'required'
    ]);

    //find post by ID
    $post = Post::findOrFail($id);

    if ($post) {
      // upload image
      if ($request->image != null) $request->file('image')->move(public_path('storage\images\posts'), $post->id . '.jpg');
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

  public function destroy($id)
  {
    //find post by ID
    $post = Post::findOrfail($id);

    if ($post) {
      if (file_exists(public_path('storage/images/posts/' . $id . '.jpg'))) unlink(public_path('storage/images/posts/' . $id . '.jpg'));
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
}

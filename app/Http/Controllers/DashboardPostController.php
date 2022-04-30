<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Validator;

class DashboardPostController extends Controller
{
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
    $validator = Validator::make($request->all(), [
      'category_id' => 'required',
      'title'   => 'required|min:3',
      'slug' => 'required',
      'excerpt' => 'required',
      'body' => 'required'
    ]);
    
    //response error validation
    if ($validator->fails()) {
      return response()->json($validator->errors(), 400);
    }

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

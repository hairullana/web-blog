<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();
        return response()->json($users);
    }

    public function destroy($id)
    {
        $user = User::find($id);

        // if user not found
        if(!$user) return response()->json([
            'status' => false,
            'message' => 'User not found on database'
        ]);

        // if user found
        $user->delete();
        // also delete her/his posts
        Post::where('user_id', $id)->delete();

        return response()->json([
            'status' => true,
            'message' => "Success delete user with username '$user->username'"
        ]);
    }
}

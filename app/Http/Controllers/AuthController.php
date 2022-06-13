<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'min:4', 'max:32'],
            'username' => ['required', 'min:4', 'max:16', 'regex:/\w*$/', 'unique:users,username'],
            'email' => ['required', 'email:rfc,dns'],
            'password' => ['min:8', 'confirmed']
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return response()->json([
            'message' => 'Register successfully'
        ], 200);
    }
}

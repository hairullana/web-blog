<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'user' => ['required'],
            'password' => ['required']
        ]);

        if (Auth::attempt([
            'email' => $request->user,
            'password' => $request->password
        ])) {
            return response()->json(Auth::user(), 200);
        }

        if (Auth::attempt([
            'username' => $request->user,
            'password' => $request->password
        ])) {
            return response()->json(Auth::user(), 200);
        }

        throw ValidationException::withMessages(['Login failed! User or password is wrong!']);
    }

    public function logout()
    {
        Auth::logout();
    }

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

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request) {
      
        $request->validate([
            "name" => "required|string|max:200|min:3",
            "email" => "required|string|email|unique:users",
            "password" => "required|string|min:6|confirmed", 
        ]);

       
        $user = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password), 
            "role" => "user", 
        ]);

      
        $token = $user->createToken("auth_token")->plainTextToken;

        return response()->json([
            "message" => "Successful registration",
            "token" => $token,
            "user" => $user
        ], 201);
    }

    public function login(Request $request) {
     
        $request->validate([
            "email" => "required|string|email",
            "password" => "required|string",
        ]);

       
        $user = User::where("email", $request->email)->first();

  
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                "message" => "Invalid login details"
            ], 401);
        }

       
        $user->tokens()->delete();
        $token = $user->createToken("auth_token")->plainTextToken;

        return response()->json([
            "message" => "Successful login",
            "token" => $token,
            "user" => $user
        ], 200);
    }

  
    public function logout(Request $request) {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            "message" => "Logged out successfully"
        ], 200);
    }
}

    


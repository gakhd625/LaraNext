<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    //
    public function register(request $request){
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create the user
        User::create($data);

        // Return a response
        return response()->json(["message" => "User registered successfully", "status" => true]);


    }

    public function login(){
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (!auth()->attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Unauthorized', 'status' => false]);
        } 

        $user = Auth()->user();

        $user->createToken("myToken")->plainTextToken;

        return response()->json(["message" => "Login successful", "status" => true, 'token' => $token]);
    }

    public function logout(){
        auth()->logout();

        return response()->json([
            'message' => 'User logged out successfully',
            'status' => true
        ]);

    }

    public function profile(){

        return response()->json([
            'user' => auth()->user(),
            'message' => 'User profile retrieved successfully',
            'status' => true
        ]);

    }
}

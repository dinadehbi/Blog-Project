<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest; // RegisterRequest
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    public function register(RegisterRequest $request): JsonResponse
    {
        // Validate the request
        $validated = $request->validated();

        // Create a new user in the database
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']), // Hash the password
        ]);

        // Return a response with the new user
        return response()->json([
            'message' => 'User created successfully',
            'user' => $user
        ], 201); // HTTP status 201 indicates successful creation
    }
}

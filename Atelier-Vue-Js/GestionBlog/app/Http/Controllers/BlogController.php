<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\User;  // Make sure you import the User model
use Illuminate\Http\Request;
use Illuminate\Support\Str; 

class BlogController extends Controller
{
    /**
     * Display all blog posts.
     */
    public function index()
    {
        $blogs = Blog::all();
        return response()->json($blogs);
    }

    /**
     * Store a new blog post.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|string',
            'user_name' => 'required|string|exists:users,name', // Ensure the user exists by name
        ]);
    
        // Find user by name
        $user = User::where('name', $validatedData['user_name'])->first();
    
        // If user doesn't exist, return error
        if (!$user) {
            return response()->json(['error' => 'User not found.'], 404);
        }
    
        // Generate slug from title
        $validatedData['slug'] = Str::slug($validatedData['title']);
        $validatedData['user_id'] = $user->id; 
    
        // Create the blog post
        $blog = Blog::create($validatedData);
    
        return response()->json($blog, 201);
    }
}

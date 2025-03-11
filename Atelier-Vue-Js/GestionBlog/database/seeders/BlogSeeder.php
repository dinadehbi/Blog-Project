<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Blog;
use App\Models\User;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        // Ensure there is at least one user
        $user = User::first();

        if (!$user) {
            $user = User::create([
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => bcrypt('password'), // Change this if needed
            ]);
        }

        // Insert multiple blog posts
        $blogs = [
            [
                'title' => 'Laravel Blog System',
                'content' => 'This is a demo blog post about Laravel and how to build a blog system with it.',
                'image' => 'blog1.jpg',
                'slug' => 'laravel-blog-system',
                'user_name' => $user->name, // Store username instead of user_id
            ],
            [
                'title' => 'Introduction to Vue.js',
                'content' => 'Vue.js is a powerful JavaScript framework for building SPAs and interactive UIs.',
                'image' => 'blog2.jpg',
                'slug' => 'introduction-to-vuejs',
                'user_name' => $user->name, // Store username instead of user_id
            ],
            [
                'title' => 'Mastering Laravel Eloquent',
                'content' => 'Eloquent is Laravel’s ORM that simplifies database interactions in an elegant way.',
                'image' => 'blog3.jpg',
                'slug' => 'mastering-laravel-eloquent',
                'user_name' => $user->name, // Store username instead of user_id
            ],
            [
                'title' => 'Building REST APIs with Laravel',
                'content' => 'Laravel provides robust tools for building modern RESTful APIs with ease.',
                'image' => 'blog4.jpg',
                'slug' => 'building-rest-apis-with-laravel',
                'user_name' => $user->name, // Store username instead of user_id
            ],
            [
                'title' => 'Best Practices for Laravel Development',
                'content' => 'Learn the best coding practices to write clean, maintainable, and efficient Laravel code.',
                'image' => 'blog5.jpg',
                'slug' => 'best-practices-laravel-development',
                'user_name' => $user->name, // Store username instead of user_id
            ],
        ];

        // Insert all blog posts
        foreach ($blogs as $blog) {
            Blog::create($blog);
        }
    }
}

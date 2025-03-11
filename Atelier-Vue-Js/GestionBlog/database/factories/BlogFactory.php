<?php

namespace Database\Factories;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BlogFactory extends Factory
{
    protected $model = Blog::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraph,
            'image' => 'default.jpg',
            'slug' => Str::slug($this->faker->sentence),
            'user_id' => User::inRandomOrder()->first()->id ?? 1,
        ];
    }
}

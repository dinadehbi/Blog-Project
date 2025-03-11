<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    // Specify the columns that are mass assignable
    protected $fillable = [
        'title', 'content', 'category_id', 'image'
    ];

    // Define the relationship with categories
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Define the relationship with tags
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    // // Define the relationship with comments
    // public function comments()
    // {
    //     return $this->hasMany(Comment::class);
    // }
}

<?php

// app/Repositories/ArticleRepository.php
namespace App\Repositories;

use App\Models\Article;

class ArticleRepository
{
    public function getAll()
    {
        return Article::with(['category', 'tags'])->get(); 
    }

    public function create(array $data)
    {
        return Article::create($data); 
    }

    public function findById($id)
    {
        return Article::findOrFail($id); 
    }

    public function update(Article $article, array $data)
    {
        $article->update($data); 
        return $article;
    }

    public function delete(Article $article)
    {
        $article->delete(); 
        return true;
    }
}

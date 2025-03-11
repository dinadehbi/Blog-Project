<?php

// app/Services/ArticleService.php
namespace App\Services;

use App\Repositories\ArticleRepository;

class ArticleService
{
    protected $articleRepository;

    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    public function getAllArticles()
    {
        return $this->articleRepository->getAll(); 
    }

    public function createArticle(array $data)
    {
        return $this->articleRepository->create($data); 
    }

    public function getArticleById($id)
    {
        return $this->articleRepository->findById($id); 
    }

    public function updateArticle($id, array $data)
    {
        $article = $this->articleRepository->findById($id); 
        return $this->articleRepository->update($article, $data); 
    }

    public function deleteArticle($id)
    {
        $article = $this->articleRepository->findById($id); 
        return $this->articleRepository->delete($article); 
    }
}

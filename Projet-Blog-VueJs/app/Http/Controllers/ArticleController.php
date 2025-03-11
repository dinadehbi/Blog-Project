<?php

// app/Http/Controllers/ArticleController.php
namespace App\Http\Controllers;

use App\Services\ArticleService;
use App\Http\Requests\StoreArticleRequest; 
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    protected $articleService;

    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }

    public function index()
    {
        $articles = $this->articleService->getAllArticles(); 
        return response()->json($articles);
    }

    public function store(StoreArticleRequest $request)
    {
        $data = $request->validated(); 
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('articles', 'public');
            $data['image'] = $path; 
        }

        $article = $this->articleService->createArticle($data); 
        return response()->json($article, 201);
    }

    // Show single article by ID
    public function show($id)
    {
        $article = $this->articleService->getArticleById($id); 
        return response()->json($article);
    }

    // Update an article
    public function update(StoreArticleRequest $request, $id)
    {
        $data = $request->validated(); 
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('articles', 'public');
            $data['image'] = $path;
        }

        $article = $this->articleService->updateArticle($id, $data); 
        return response()->json($article);
    }

    public function destroy($id)
    {
        $this->articleService->deleteArticle($id); 
        return response()->json(['message' => 'Article deleted successfully']);
    }
}

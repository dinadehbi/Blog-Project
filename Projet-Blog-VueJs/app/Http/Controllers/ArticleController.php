<?php

// app/Http/Controllers/ArticleController.php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Services\ArticleService;
use App\Http\Requests\StoreArticleRequest;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ArticleController extends Controller
{
    use AuthorizesRequests; // Add this trait

    protected $articleService;

    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
        $this->authorizeResource(Article::class, 'article'); // Authorization check
    }

    // Show all articles
    public function index()
    {
        $articles = $this->articleService->getAllArticles(); 
        return response()->json($articles);
    }

    // Store new article
    public function store(StoreArticleRequest $request)
    {
        $this->authorize('create', Article::class); // Authorization check

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
        $this->authorize('update', Article::class); // Authorization check

        $data = $request->validated(); 
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('articles', 'public');
            $data['image'] = $path;
        }

        $article = $this->articleService->updateArticle($id, $data); 
        return response()->json($article);
    }

    // Delete article
    public function destroy($id)
    {
        $this->authorize('delete', Article::class); // Authorization check

        $this->articleService->deleteArticle($id); 
        return response()->json(['message' => 'Article deleted successfully']);
    }
}

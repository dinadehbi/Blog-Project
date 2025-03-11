<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        $categories = $this->categoryService->getAllCategories();
        return response()->json($categories);
    }

    public function store(CategoryRequest $request)
    {
        $category = $this->categoryService->storeCategory($request->validated()); 
        return response()->json($category, 201);
    }

    public function show($id)
    {
        $category = $this->categoryService->getCategoryById($id);
        return response()->json($category);
    }

    public function update(CategoryRequest $request, $id)
    {
        $category = $this->categoryService->updateCategory($id, $request->validated());
    }

    public function destroy($id)
    {
        $this->categoryService->deleteCategory($id);
        return response()->json(['message' => 'Category deleted successfully']);
    }
}

<?php

use Illuminate\Support\Facades\Route;



use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\ArticleController;



Route::get('/tags', [TagController::class, 'index']);
Route::post('/tags', [TagController::class, 'store']);
Route::get('/tags/{id}', [TagController::class, 'show']);
Route::put('/tags/{id}', [TagController::class, 'update']);
Route::delete('/tags/{id}', [TagController::class, 'destroy']);






Route::get('/categories', [CategoryController::class, 'index']);
Route::post('/categories', [CategoryController::class, 'store']);
Route::get('/categories/{id}', [CategoryController::class, 'show']); 
Route::put('/categories/{id}', [CategoryController::class, 'update']); 
Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);





 // Routes pour les articles
 Route::get('/articles', [ArticleController::class, 'index']);  // Récupérer tous les articles
 Route::post('/articles', [ArticleController::class, 'store']); // Créer un nouvel article
 Route::get('/articles/{article}', [ArticleController::class, 'show']); // Afficher un article spécifique
 Route::put('/articles/{article}', [ArticleController::class, 'update']); // Mettre à jour un article
 Route::delete('/articles/{article}', [ArticleController::class, 'destroy']);
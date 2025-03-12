<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;







Route::get('api/tags', [TagController::class, 'index']);
Route::post('api/tags', [TagController::class, 'store']);
Route::get('api/tags/{id}', [TagController::class, 'show']);
Route::put('api/tags/{id}', [TagController::class, 'update']);
Route::delete('api/tags/{id}', [TagController::class, 'destroy']);





Route::get('/', function () {
    return view('index'); 
});






Route::get('api/articles', [ArticleController::class, 'index']);  
Route::post('api/articles', [ArticleController::class, 'store']); 
Route::get('api/articles/{article}', [ArticleController::class, 'show']); 
Route::put('api/articles/{article}', [ArticleController::class, 'update']); 
Route::delete('api/articles/{article}', [ArticleController::class, 'destroy']);




Route::get('api/categories', [CategoryController::class, 'index']);
Route::post('api/categories', [CategoryController::class, 'store']);
Route::get('api/categories/{id}', [CategoryController::class, 'show']);
Route::put('api/categories/{id}', [CategoryController::class, 'update']);
Route::delete('api/categories/{id}', [CategoryController::class, 'destroy']);


Route::post('api/register', [AuthController::class, 'register']);
Route::post('api/login', [AuthController::class, 'login']);

Route::middleware('auth.api')->get('api/user', function (Request $request) {
    return $request->user();
});
Route::middleware(['admin'])->group(function () {
    Route::get('api/dashboard', function () {
        return view('admin.dashboard'); // View dyal dashboard
    })->name('dashboard');
});
















Route::get('/{any}', function () {
    return view('index'); 
})->where('any', '.*');

<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\BlogController;

Route::get('/blogs', [BlogController::class, 'index']);
Route::post('/blogs', [BlogController::class, 'store']);


Route::get('/', function () {
    return view('index'); 
});

Route::get('/{any}', function () {
    return view('index'); 
})->where('any', '.*');
<?php

// app/Http/Controllers/ProductController.php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Laravel\Prompts\Prompt;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return response()->json($products);
    }
    
public function store(Request $request)
{
    // Validate the request data
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'image' => 'required|string',
        'categorie' => 'required|string',
        'quantity' => 'required|integer',
        'price' => 'required|integer',
    ]);

    $product = Product::create($validatedData);

    return response()->json($product, 201);  
}    
}
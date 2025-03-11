<?php

// app/Repositories/CategoryRepository.php
namespace App\Repositories;

use App\Models\Category;

class CategoryRepository
{
    public function getAll()
    {
        return Category::all(); // Kayjib jami3 categories
    }

    public function findById($id)
    {
        return Category::findOrFail($id); // Kayjib category b id
    }

    public function create($data)
    {
        return Category::create($data); // Kaykhl9 category
    }

    public function update($id, $data)
    {
        $category = Category::findOrFail($id); // Kayl9a category li b id
        $category->update($data); // Kayhdem update 3la category
        return $category;
    }

    public function delete($id)
    {
        $category = Category::findOrFail($id); // Kayl9a category b id
        $category->delete(); // Kaymchi yms7 category
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
    public function show(Category $category)
    {
        $products = $category->products()->where('active', true)->paginate(12);

        return view('products.index', [
            'products' => $products,
            'categories' => Category::withCount('products')->orderBy('name')->get(),
            'activeCategory' => $category,
            'recentlyViewed' => collect(),
        ]);
    }
}

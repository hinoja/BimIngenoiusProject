<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::query()
                        ->latest()
                        ->paginate(8);

        return view('front.categories.index', [
            'categories' => $categories,
        ]);
    }

    public function show(Category $category)
    {
        $other_categories = Category::query()
                                ->withExists('projects')
                                ->where('id', '!=', $category->id)
                                ->take(5)
                                ->get();

        return view('front.categories.show', [
            'category' => $category,
            'other_categories' => $other_categories
        ]);
    }
}

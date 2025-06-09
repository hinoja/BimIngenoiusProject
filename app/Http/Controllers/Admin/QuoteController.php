<?php

namespace App\Http\Controllers\Admin;

use App\Models\Quote;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class QuoteController extends Controller
{
    /**
     * Afficher un devis spécifique.
     */
    public function show(Quote $quote)
    {
        return view('admin.quotes.show', compact('quote'));
    }

    /**
     * Afficher le formulaire d'édition d'un devis.
     */
    public function edit(Quote $quote)
    {
        return view('admin.quotes.edit', compact('quote'));
    }

    /**
     * Afficher la page de gestion des catégories de devis.
     */
    public function categories()
    {
        return view('admin.quotes.categories');
    }

    /**
     * Enregistrer une nouvelle catégorie.
     */
    public function storeCategory(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'description' => 'nullable|string',
        ]);

        Category::create($validated);

        return redirect()->route('admin.quotes.categories')
            ->with('success', __('Category created successfully!'));
    }

    /**
     * Supprimer une catégorie.
     */
    public function destroyCategory(Category $category)
    {
        // Vérifier si la catégorie est utilisée par des devis
        if ($category->quotes()->count() > 0) {
            return redirect()->route('admin.quotes.categories')
                ->with('error', __('Cannot delete category: it is used by one or more quotes.'));
        }

        $category->delete();

        return redirect()->route('admin.quotes.categories')
            ->with('success', __('Category deleted successfully!'));
    }
}
<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;

use App\Models\Categorie;
use App\Http\Requests\StoreCategorieRequest;
use App\Http\Requests\UpdateCategorieRequest;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategorieRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($uuid)
    {
        $categorie = Categorie::with('sousCategories')->find($uuid);
      
        $breadcrumbsItems = [
            [
                'name' => 'Recettes',
                'url' => route('recettes.index'),
                'active' => false
            ],
            [
                'name' => 'Catégories',
                'url' => route('recettes.categories'),
                'active' => false
            ],
            [
                'name' => $categorie->nom,
                'url' => route('recettes.categories'),
                'active' => false
            ],
            
        ];
        $pageTitle = 'Catégories ' . $categorie->nom;
        $subcategories = $categorie->sousCategories;
        return view('pages.backend.comptabilite.categories.show', compact('categorie', 'subcategories',
                            'breadcrumbsItems', 'pageTitle'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categorie $categorie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategorieRequest $request, Categorie $categorie)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categorie $categorie)
    {
        $categorie->delete();

        return redirect()->route('categories.index')->with('success', 'Categorie supprimée avec succès.');
    }
    
}

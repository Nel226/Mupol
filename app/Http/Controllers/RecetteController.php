<?php

namespace App\Http\Controllers;

use App\Models\Recette;
use App\Http\Requests\StoreRecetteRequest;
use App\Http\Requests\UpdateRecetteRequest;
use App\Models\Categorie;

class RecetteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $breadcrumbsItems = [
            [
                'name' => 'Recettes',
                'url' => route('recettes.index'),
                'active' => true
            ],
            
        ];
        $pageTitle = 'Liste des recettes';
        $all = Categorie::all();

        $recettes = [
            'all' => Recette::all(),
            'prets' => Recette::whereHas('categorie', function ($query) {
                $query->where('sous_type', 'prets');
            })->get(),
            'recettes_propres' => Recette::whereHas('categorie', function ($query) {
                $query->where('sous_type', 'recettes_propres');
            })->get(),
            'produits' => Recette::whereHas('categorie', function ($query) {
                $query->where('sous_type', 'produits');
            })->get(),
            'autres' => Recette::whereHas('categorie', function ($query) {
                $query->where('sous_type', 'autres');
            })->get(),
        ];
    

        return view('pages.backend.comptabilite.recettes.index',
                    compact('pageTitle', 'breadcrumbsItems', 'all', 'recettes')
        );

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $breadcrumbsItems = [
            [
                'name' => 'Recettes',
                'url' => route('recettes.index'),
                'active' => false
            ],
            [
                'name' => 'Ajouter',
                'url' => route('recettes.create'),
                'active' => true
            ],
        ];
        $pageTitle = 'Nouvelle recette';
        return view('pages.backend.comptabilite.recettes.create',
                    compact('breadcrumbsItems', 'pageTitle')
        );
    }

    public function categories()
    {
        $breadcrumbsItems = [
            [
                'name' => 'Recettes',
                'url' => route('recettes.index'),
                'active' => false
            ],
            [
                'name' => 'Catégories',
                'url' => route('recettes.categories'),
                'active' => true
            ],
            
        ];
        $pageTitle = 'Catégories recettes';
        $categories = Categorie::withCount('sousCategories')
            ->where('type', 'recette') 
            ->whereNull('parent_id')   
            ->get();

      


        return view('pages.backend.comptabilite.recettes.categories',
                    compact('pageTitle', 'breadcrumbsItems', 
                     'categories')
        );

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRecetteRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Recette $recette)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Recette $recette)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRecetteRequest $request, Recette $recette)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Recette $recette)
    {
        //
    }
}
<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;

use App\Models\Depense;
use App\Http\Requests\StoreDepenseRequest;
use App\Http\Requests\UpdateDepenseRequest;
use App\Models\Categorie;

class DepenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $breadcrumbsItems = [
            [
                'name' => 'Dépenses',
                'url' => route('depenses.index'),
                'active' => true
            ],
        ];
        $pageTitle = 'Liste des dépenses';

        $categoriesPrincipales = Categorie::whereNull('parent_id')
                                        ->where('type', 'depense') 
                                        ->get();

        $depenses = Depense::with('categorie')
                        ->whereIn('categorie_id', $categoriesPrincipales->pluck('uuid'))
                        ->get();

        // Grouper les dépenses par catégorie
        $depensesParCategorie = $depenses->groupBy(function($depense) {
            return $depense->categorie->nom; 
        });

        return view('pages.backend.comptabilite.depenses.index',
                    compact('pageTitle', 'breadcrumbsItems', 'depensesParCategorie', 'categoriesPrincipales', 'depenses')
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
        $sousTypes = Depense::with('categorie')
                            ->select('categorie_id') 
                            ->distinct() 
                            ->get()
                            ->map(function ($depense) {

        return $depense->categorie->sous_type; 
        })
        ->unique(); 
        
        $pageTitle = 'Nouvelle dépense';
        $categories = Categorie::where('type', 'depense')
                                ->whereNull('parent_id')
                                ->with('sousCategories')
                                ->get();

        return view('pages.backend.comptabilite.depenses.create',
                    compact('breadcrumbsItems', 'pageTitle', 'categories')
        );
    }

    public function categories()
    {
        $breadcrumbsItems = [
            [
                'name' => 'Catégories',
                'url' => route('depenses.categories'),
                'active' => true
            ],
            
        ];
        $pageTitle = 'Catégories dépenses';
        $categories = Categorie::withCount('sousCategories')
                ->where('type', 'depense') 
                ->whereNull('parent_id')   
                ->get();
        return view('pages.backend.comptabilite.depenses.categories',
        compact('pageTitle', 'breadcrumbsItems', 
                                'categories')
        );
        

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDepenseRequest $request)
    {
        // Création d'une nouvelle depense avec les données validées
        $depense = Depense::create([
            'montant' => $request->input('montant'),
            'description' => $request->input('description'),
            'categorie_id' => $request->input('categorie_id'),
            'sous_categorie_id' => $request->input('sous_categorie_id'),
            'date' => $request->input('date'),
        ]);

        return redirect()->route('depenses.index')->with('success', 'Dépense ajoutée avec succès !');
    }

    /**
     * Display the specified resource.
     */
    public function show(Depense $depense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Depense $depense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDepenseRequest $request, Depense $depense)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Depense $depense)
    {
        //
    }
}

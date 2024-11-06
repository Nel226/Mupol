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
        $sousTypes = Recette::with('categorie')
        ->select('categorie_id') // Sélectionner uniquement l'id de la catégorie
        ->distinct() // Pour obtenir des valeurs uniques
        ->get()
        ->map(function ($recette) {
            return $recette->categorie->sous_type; // Retourne le sous_type de la catégorie associée
        })
        ->unique(); // Pour s'assurer qu'il n'y a pas de doublons
        
        $pageTitle = 'Nouvelle recette';
        $categories = Categorie::where('type', 'recette')
                                ->whereNull('parent_id')
                                ->with('sousCategories')
                                ->get();

        return view('pages.backend.comptabilite.recettes.create',
                    compact('breadcrumbsItems', 'pageTitle', 'categories')
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
        // Création d'une nouvelle recette avec les données validées
        $recette = Recette::create([
            // 'uuid' => \Illuminate\Support\Str::uuid(), // Génération d'un UUID pour la recette
            'montant' => $request->input('montant'),
            'description' => $request->input('description'),
            'categorie_id' => $request->input('categorie_id'),
            'sous_categorie_id' => $request->input('sous_categorie_id'),
            'date' => $request->input('date'),
        ]);

        // Redirection vers la liste des recettes avec un message de succès
        return redirect()->route('recettes.index')->with('success', 'Recette ajoutée avec succès !');
    }

    /**
     * Display the specified resource.
     */
    public function show(Recette $recette)
    {
        $recette->load('categorie');
        return response()->json($recette);
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

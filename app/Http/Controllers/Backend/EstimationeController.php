<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;

use App\Models\Estimatione;
use App\Http\Requests\StoreEstimationeRequest;
use App\Http\Requests\UpdateEstimationeRequest;
use App\Models\Categorie;

class EstimationeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $breadcrumbsItems = [
            [
                'name' => 'Estimations',
                'url' => route('estimations.index'),
                'active' => true
            ],
        ];
        $pageTitle = 'Liste des estimations';

        $categoriesPrincipales = Categorie::whereNull('parent_id')
                                        // ->where('type', 'depense') 
                                        ->get();

        $estimations = Estimatione::with('categorie')
                        ->whereIn('categorie_id', $categoriesPrincipales->pluck('uuid'))
                        ->get();

        // Grouper les estimations par catégorie
        $estimationsParCategorie = $estimations->groupBy(function($estimatione) {
            return $estimatione->categorie->nom; 
        });

        return view('pages.backend.comptabilite.estimations.index',
                    compact('pageTitle', 'breadcrumbsItems', 'estimationsParCategorie', 'categoriesPrincipales', 'estimations')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $breadcrumbsItems = [
            [
                'name' => 'Estimations',
                'url' => route('estimations.index'),
                'active' => false
            ],
            [
                'name' => 'Ajouter',
                'url' => route('estimations.create'),
                'active' => true
            ],
        ];
        $sousTypes = Estimatione::with('categorie')
                            ->select('categorie_id') 
                            ->distinct() 
                            ->get()
                            ->map(function ($estimatione) {

        return $estimatione->categorie->sous_type; 
        })
        ->unique(); 
        
        $pageTitle = 'Nouvelle estimation';
        $categories = Categorie::whereNull('parent_id')
                                ->with('sousCategories')
                                ->get();

        return view('pages.backend.comptabilite.estimations.create',
                    compact('breadcrumbsItems', 'pageTitle', 'categories')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEstimationeRequest $request)
    {
        $estimation = Estimatione::create([
            'montant' => $request->input('montant'),
            'description' => $request->input('description'),
            'categorie_id' => $request->input('categorie_id'),
            'sous_categorie_id' => $request->input('sous_categorie_id'),
            'periode' => $request->input('periode'),
            'annee' => $request->input(key: 'annee'),

        ]);

        return redirect()->route('estimations.index')->with('success', 'Estimation ajoutée avec succès !');
    }

    /**
     * Display the specified resource.
     */
    public function show(Estimatione $estimatione)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Estimatione $estimatione)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEstimationeRequest $request, Estimatione $estimatione)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Estimatione $estimatione)
    {
        //
    }
}

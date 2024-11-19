<?php

namespace App\Http\Controllers;

use App\Models\CentreSante;
use App\Http\Requests\StoreCentreSanteRequest;
use App\Http\Requests\UpdateCentreSanteRequest;

class CentreSanteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $breadcrumbsItems = [
            [
                'name' => 'Centres de santé',
                'url' => route('centres-sante.index'),
                'active' => true
            ],
           
        ];
        $pageTitle = 'Centres de santé';

        $centres = CentreSante::all();

        $hopitaux = $centres->where('type', 'hopital');
        $cliniques = $centres->where('type', 'clinique');
    
        return view('pages.backend.centres_sante.index', [
            'centres' => $centres,
            'hopitaux' => $hopitaux,
            'cliniques' => $cliniques,
            'breadcrumbsItems' => $breadcrumbsItems,
            'pageTitle' => $pageTitle,

        ]);
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $breadcrumbsItems = [
            [
                'name' => 'Recettes',
                'url' => route('centres-sante.index'),
                'active' => false
            ],
            [
                'name' => 'Ajouter',
                'url' => route('centres-sante.create'),
                'active' => true
            ],
        ];
        $pageTitle = 'Ajouter un centre';

        return view('pages.backend.centres_sante.create', compact('breadcrumbsItems', 'pageTitle'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCentreSanteRequest $request)
    {
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos/centres-sante', 'public');
        } else {
            $photoPath = null;  
        }
        CentreSante::create($request->validated());
        return redirect()->route('centres-sante.index')->with('success', 'Centre de santé ajouté avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $centre = CentreSante::findOrFail($id);

        $breadcrumbsItems = [
            [
                'name' => 'Centres de santé',
                'url' => route('centres-sante.index'),
                'active' => false
            ],
            [
                'name' => $centre->nom, 
                'url' => route('centres-sante.show', $centre->id),
                'active' => true
            ],
        ];
    
        $pageTitle = 'Détails de ' . $centre->nom;
        return view('pages.backend.centres_sante.show', compact('centre', 'breadcrumbsItems', 'pageTitle'));
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CentreSante $centreSante)
    {
        return view('pages.backend.centres_sante.edit', compact('centreSante'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCentreSanteRequest $request, CentreSante $centreSante)
    {
        $centreSante->update($request->validated());
        return redirect()->route('centres_sante.index')->with('success', 'Centre de santé mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CentreSante $centreSante)
    {
        $centreSante->delete();
        return redirect()->route('centres_sante.index')->with('success', 'Centre de santé supprimé avec succès.');
    }

}

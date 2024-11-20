<?php

namespace App\Http\Controllers;

use App\Models\CentreSante;
use App\Http\Requests\StoreCentreSanteRequest;
use App\Http\Requests\UpdateCentreSanteRequest;
use App\Models\Adherant;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

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
        
        
        $validatedData = $request->validated();
        $validatedData['password'] = Hash::make('123456789'); 
        CentreSante::create($validatedData);
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
    public function edit($id)
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
                'url' => route('centres-sante.index'),
                'active' => true
            ],
        ];

        $pageTitle = 'Édition de ' . $centre->nom;  

        return view('pages.backend.centres_sante.edit', compact('centre', 'breadcrumbsItems', 'pageTitle'));
    }

    public function searchAdherent(Request $request)
    {
        // Valider le code carte
        $validated = $request->validate([
            'code_carte' => 'required|string',
        ]);

        $adherent = Adherant::where('code_carte', $validated['code_carte'])->first();

        if ($adherent) {
            return view('partenaires.prestations.nouvelle', compact('adherent'));
        } else {
            $message = 'Aucun adhérent trouvé avec ce code carte.';
            return view('partenaires.prestations.nouvelle', compact('message'));
        }
    }
    
    



    
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCentreSanteRequest $request,  $id)
    {
        $centre = CentreSante::findOrFail($id);

        $centre->update($request->validated());
        return redirect()->route('centres_sante.index')->with('success', 'Centre de santé mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $centreSante = CentreSante::findOrFail($id);
        $centreSante->delete();
        return redirect()->route('centres-sante.index')->with('success', 'Centre de santé supprimé avec succès.');
    }

}

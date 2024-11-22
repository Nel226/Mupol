<?php

namespace App\Http\Controllers;

use App\Models\Partenaire;
use App\Http\Requests\StorePartenaireRequest;
use App\Http\Requests\UpdatePartenaireRequest;
use App\Models\Adherant;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class PartenaireController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $breadcrumbsItems = [
            [
                'name' => 'Partenaires',
                'url' => route('partenaires.index'),
                'active' => true
            ],
        
        ];
        $pageTitle = 'Partenaires';

        $partenaires = Partenaire::all();

        $hopitaux = $partenaires->where('type', 'hopital');
        $cliniques = $partenaires->where('type', 'clinique');
        $pharmacies = $partenaires->where('type', 'pharmacie');

        return view('pages.backend.partenaires.index', [
            'partenaires' => $partenaires,
            'hopitaux' => $hopitaux,
            'cliniques' => $cliniques,
            'pharmacies' => $pharmacies,

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
                'name' => 'Partenaires',
                'url' => route('partenaires.index'),
                'active' => false
            ],
            [
                'name' => 'Ajouter',
                'url' => route('partenaires.create'),
                'active' => true
            ],
        ];
        $pageTitle = 'Ajouter un partenaire';

        return view('pages.backend.partenaires.create', compact('breadcrumbsItems', 'pageTitle'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePartenaireRequest $request)
    {
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos/partenaires', 'public');

        } else {
            $photoPath = null;  
        }
        
        
        $validatedData = $request->validated();
        $validatedData['photo'] = $photoPath; 

        $validatedData['password'] = Hash::make('123456789'); 
        Partenaire::create($validatedData);
        return redirect()->route('partenaires.index')->with('success', 'Partenaire de santé ajouté avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $partenaire = Partenaire::findOrFail($id);
        $breadcrumbsItems = [
            [
                'name' => 'Partenaires',
                'url' => route('partenaires.index'),
                'active' => false
            ],
            [
                'name' => $partenaire->nom, 
                'url' => route('partenaires.show', $partenaire->id),
                'active' => true
            ],
        ];
    
        $pageTitle = 'Détails de ' . $partenaire->nom;
        return view('pages.backend.partenaires.show', compact('partenaire', 'breadcrumbsItems', 'pageTitle'));
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $partenaire = Partenaire::findOrFail($id); 

        $breadcrumbsItems = [
            [
                'name' => 'Partenaires',
                'url' => route('partenaires.index'),
                'active' => false
            ],
            [
                'name' => $partenaire->nom,  
                'url' => route('partenaires.index'),
                'active' => true
            ],
        ];

        $pageTitle = 'Édition de ' . $partenaire->nom;  

        return view('pages.backend.partenaires.edit', compact('partenaire', 'breadcrumbsItems', 'pageTitle'));
    }

    public function searchAdherent(Request $request)
    {
        $validated = $request->validate([
            'code_carte' => 'required|string',
        ]);

        $adherent = Adherant::where('code_carte', $validated['code_carte'])->first();
        $adherent->ayantsDroits = json_decode($adherent->ayantsDroits, true); 

        if ($adherent) {
            return view('pages.frontend.partenaires.prestations.create', compact('adherent'));
        } else {
            $message = 'Aucun adhérent trouvé avec ce code carte.';
            return view('pages.frontend.partenaires.prestations.create', compact('message'));
        }
    }
    
    
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePartenaireRequest $request,  $id)
    {
        $partenaire = Partenaire::findOrFail($id);

        $partenaire->update($request->validated());
        return redirect()->route('partenaires.index')->with('success', 'partenaire de santé mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $partenaireSante = Partenaire::findOrFail($id);
        $partenaireSante->delete();
        return redirect()->route('partenaires.index')->with('success', 'partenaire de santé supprimé avec succès.');
    }

}

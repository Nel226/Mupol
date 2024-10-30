<?php

namespace App\Http\Controllers;

use App\Models\Adherant;
use App\Http\Requests\StoreAdherantRequest;
use App\Http\Requests\UpdateAdherantRequest;
use App\Models\AyantDroit;
use App\Models\Prestation;
use Carbon\Carbon;

class AdherantController extends Controller
{
 

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $header = [
            'ordre', 'date_enregistrement', 'nom', 'prenom', 'genre', 'service', 'no_matricule',
            'code_carte', 'telephone', 'charge', 'mensualite', 'adhesion'
        ];
        $headerAyantDroit = [
            'nom', 'prenom', 'sexe', 'date_naissance', 'relation', 'code', 'matricule_adherant'
        ];
        $breadcrumbsItems = [
            [
                'name' => 'Adhésions',
                'url' => route('adherants.index'),
                'active' => true
            ],
        ];
        $pageTitle = 'Liste des adhésions';

        $adherants = Adherant::all();
        $ad = AyantDroit::all();
        $mutualistes = $adherants->concat($ad);

        $groupedAdherants = $adherants->groupBy(function($adherant) {
            return \Carbon\Carbon::parse($adherant->date_enregistrement)->format('Y-m');
        })->sortKeys();
        $sheets = [];
        foreach ($groupedAdherants as $yearMonth => $adherants) {
            $sheets[$yearMonth] = $adherants->map(function($adherant) {
                return [
                    'id'=> $adherant->id,
                    'ordre' => $adherant->ordre,
                    'date_enregistrement' => $adherant->date_enregistrement,
                    'nom' => $adherant->nom,
                    'prenom' => $adherant->prenom,
                    'genre' => $adherant->genre,
                    'service' => $adherant->service,
                    'no_matricule' => $adherant->no_matricule,
                    'code_carte' => $adherant->code_carte,
                    'telephone' => $adherant->telephone,
                    'charge' => $adherant->charge,
                    'mensualite' => $adherant->mensualite,
                    'adhesion' => $adherant->adhesion,
                ];
            })->toArray();
        }
    
        $ayantsDroit = AyantDroit::with('adherant')->get()->map(function($ayantDroit) {
            return [
                'id' => $ayantDroit->id,
                'nom' => $ayantDroit->nom,
                'prenom' => $ayantDroit->prenom,
                'sexe' => $ayantDroit->sexe,
                'date_naissance' => $ayantDroit->date_naissance,
                'relation' => $ayantDroit->relation,
                'code' => $ayantDroit->code,
                'matricule_adherant' => $ayantDroit->adherant->no_matricule, 
                'date_enregistrement_adherant' => $ayantDroit->adherant->date_enregistrement 

            ];
        });
        $ayantsDroitAll = AyantDroit::all();
        
        $groupedAyantsDroits = $ayantsDroit->groupBy(function($ayantDroit) {
            return Carbon::parse($ayantDroit['date_enregistrement_adherant'])->format('Y-m');
        })->sortKeys();

        
    
        $sheetsAyantsDroits = [];
        foreach ($groupedAyantsDroits as $yearMonth => $ayantsDroits) {
            $sheetsAyantsDroits[$yearMonth] = collect($ayantsDroits)->map(function($ayantDroit) {
                return [
                    'id' => $ayantDroit['id'],
                    'nom' => $ayantDroit['nom'],
                    'prenom' => $ayantDroit['prenom'],
                    'sexe' => $ayantDroit['sexe'],
                    'date_naissance' => $ayantDroit['date_naissance'],
                    'relation' => $ayantDroit['relation'],
                    'code' => $ayantDroit['code'],
                    'matricule_adherant' => $ayantDroit['matricule_adherant'],
                ];
            })->toArray();
        }

        return view('pages.backend.adherants.index', compact('header', 'mutualistes','ayantsDroitAll', 'sheets', 'sheetsAyantsDroits', 'ayantsDroit', 'ad','adherants', 'headerAyantDroit', 'breadcrumbsItems', 'pageTitle'));
    }
    


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $breadcrumbsItems = [
            [
                'name' => 'Adhésions',
                'url' => route('adherants.index'),
                'active' => false
            ],
            [
                'name' => 'Création adhérent',
                'url' => route('adherants.create'),
                'active' => true
            ],
        ];
        $pageTitle = 'Création adhérent';

        return view('pages.backend.adherants.create', compact('pageTitle', 'breadcrumbsItems'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAdherantRequest $request)
    {
        $header = [
            'ordre', 'date_enregistrement', 'nom', 'prenom', 'genre', 'service', 'no_matricule',
             'code_carte', 'telephone', 'charge', 'mensualite', 'adhesion'
        ];
        $headerAyantDroit = [
            'nom', 'prenom', 'sexe', 'date_naissance', 'relation', 'code', 'matricule_adherant'
        ];
    
        $adherants = Adherant::all();
        $ayantsDroit = AyantDroit::with('adherant')->get()->map(function($ayantDroit) {
            return [
                'id' => $ayantDroit->id,
                'nom' => $ayantDroit->nom,
                'prenom' => $ayantDroit->prenom,
                'sexe' => $ayantDroit->sexe,
                'date_naissance' => $ayantDroit->date_naissance,
                'relation' => $ayantDroit->relation,
                'code' => $ayantDroit->code,
                'matricule_adherant' => $ayantDroit->adherant->no_matricule, // Matricule de l'adhérent
            ];
        });
        $validatedData = $request->validate([
        'nom' => 'required',
        'prenom' => 'required',
        'genre' => 'required',
        'service' => 'required',
        'no_matricule' => 'required',
        'code_carte' => 'required',
        'telephone' => 'required',
        'charge' => 'required',
        'mensualite' => 'required',
        'adhesion' => 'required',
        'photo' => 'image', 
        'date_enregistrement'=>'required',
    ]);

    if ($request->hasFile('photo')) {
        $photoPath = $request->file('photo')->store('photos', 'public');
        $validatedData['photo'] = $photoPath;
    }

    $validatedData['ordre'] = $validatedData['ordre'] ?? 0; 

    $adherant = Adherant::create($validatedData);
    session()->flash('header', $header);
    session()->flash('adherants', $adherants);
    return redirect()->route('adherants.index')->with('success', 'Adhérent ajouté avec succès.');
   
    
    }

    /**
     * Display the specified resource.
     */
    public function show(Adherant $adherant)
    {
        $pretations = Prestation::where('adherantCode' == $adherant->code_carte);
        return view('pages.backend.adherants.show', compact('adherant', 'pretations'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        $adherant = Adherant::findOrFail($id); // Trouver l'ayant droit par ID

        return view('pages.backend.adherants.edit',compact('adherant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAdherantRequest $request, $id)
    {

        $validatedData = $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'genre' => 'required',
            'service' => 'required',
            'no_matricule' => 'required',
            'code_carte' => 'required',
            'charge' => 'required',
            'mensualite' => 'required',
            'adhesion' => 'required',
            'date_enregistrement' => 'required|date',
            'photo' => 'image|nullable', // optionnel
        ]);
        $adherant = Adherant::findOrFail($id);

        $adherant->nom = $validatedData['nom'];
        $adherant->prenom = $validatedData['prenom'];
        $adherant->genre = $validatedData['genre'];
        $adherant->service = $validatedData['service'];
        $adherant->no_matricule = $validatedData['no_matricule'];
        $adherant->code_carte = $validatedData['code_carte'];
        $adherant->charge = $validatedData['charge'];
        $adherant->mensualite = $validatedData['mensualite'];
        $adherant->adhesion = $validatedData['adhesion'];
        $adherant->date_enregistrement = $validatedData['date_enregistrement'];

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos', 'public');
            $adherant->photo = $photoPath;
        }

        $adherant->save();

        return redirect()->route('adherants.index')->with('success', 'Adhérent mis à jour avec succès.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $adherant = Adherant::findOrFail($id);
            $adherant->delete();
            
            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
    
}

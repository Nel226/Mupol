<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;


use App\Models\Adherent;
use App\Http\Requests\StoreAdherentRequest;
use App\Http\Requests\UpdateAdherentRequest;
use App\Models\AyantDroit;
use App\Models\Prestation;
use Carbon\Carbon;

class AdherentController extends Controller
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
            'nom', 'prenom', 'sexe', 'date_naissance', 'relation', 'code', 'matricule_adherent'
        ];
        $breadcrumbsItems = [
            [
                'name' => 'Adhésions',
                'url' => route('adherents.index'),
                'active' => true
            ],
        ];
        $pageTitle = 'Liste des adhésions';

        $adherents = Adherent::all();
        $ad = AyantDroit::all();
        $mutualistes = $adherents->concat($ad);

        $groupedAdherents = $adherents->groupBy(function($adherent) {
            return \Carbon\Carbon::parse($adherent->date_enregistrement)->format('Y-m');
        })->sortKeys();
        $sheets = [];
        foreach ($groupedAdherents as $yearMonth => $adherents) {
            $sheets[$yearMonth] = $adherents->map(function($adherent) {
                return [
                    'id'=> $adherent->id,
                    'ordre' => $adherent->ordre,
                    'date_enregistrement' => $adherent->date_enregistrement,
                    'nom' => $adherent->nom,
                    'prenom' => $adherent->prenom,
                    'genre' => $adherent->genre,
                    'service' => $adherent->service,
                    'no_matricule' => $adherent->no_matricule,
                    'code_carte' => $adherent->code_carte,
                    'telephone' => $adherent->telephone,
                    'charge' => $adherent->charge,
                    'mensualite' => $adherent->mensualite,
                    'adhesion' => $adherent->adhesion,
                ];
            })->toArray();
        }
    
        $ayantsDroit = AyantDroit::with('adherent')->get()->map(function($ayantDroit) {
            return [
                'id' => $ayantDroit->id,
                'nom' => $ayantDroit->nom,
                'prenom' => $ayantDroit->prenom,
                'sexe' => $ayantDroit->sexe,
                'date_naissance' => $ayantDroit->date_naissance,
                'relation' => $ayantDroit->relation,
                'code' => $ayantDroit->code,
                'matricule_adherent' => $ayantDroit->adherent->no_matricule, 
                'date_enregistrement_adherent' => $ayantDroit->adherent->date_enregistrement 

            ];
        });
        $ayantsDroitAll = AyantDroit::all();
        
        $groupedAyantsDroits = $ayantsDroit->groupBy(function($ayantDroit) {
            return Carbon::parse($ayantDroit['date_enregistrement_adherent'])->format('Y-m');
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
                    'matricule_adherent' => $ayantDroit['matricule_adherent'],
                ];
            })->toArray();
        }

        return view('pages.backend.adherents.index', compact('header', 'mutualistes','ayantsDroitAll', 'sheets', 'sheetsAyantsDroits', 'ayantsDroit', 'ad','adherents', 'headerAyantDroit', 'breadcrumbsItems', 'pageTitle'));
    }
    


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $breadcrumbsItems = [
            [
                'name' => 'Adhésions',
                'url' => route('adherents.index'),
                'active' => false
            ],
            [
                'name' => 'Création adhérent',
                'url' => route('adherents.create'),
                'active' => true
            ],
        ];
        $pageTitle = 'Création adhérent';

        return view('pages.backend.adherents.create', compact('pageTitle', 'breadcrumbsItems'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAdherentRequest $request)
    {
        $header = [
            'ordre', 'date_enregistrement', 'nom', 'prenom', 'genre', 'service', 'no_matricule',
             'code_carte', 'telephone', 'charge', 'mensualite', 'adhesion'
        ];
        $headerAyantDroit = [
            'nom', 'prenom', 'sexe', 'date_naissance', 'relation', 'code', 'matricule_adherent'
        ];
    
        $adherents = Adherent::all();
        $ayantsDroit = AyantDroit::with('adherent')->get()->map(function($ayantDroit) {
            return [
                'id' => $ayantDroit->id,
                'nom' => $ayantDroit->nom,
                'prenom' => $ayantDroit->prenom,
                'sexe' => $ayantDroit->sexe,
                'date_naissance' => $ayantDroit->date_naissance,
                'relation' => $ayantDroit->relation,
                'code' => $ayantDroit->code,
                'matricule_adherent' => $ayantDroit->adherent->no_matricule, // Matricule de l'adhérent
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

        $adherent = Adherent::create($validatedData);
        session()->flash('header', $header);
        session()->flash('adherents', $adherents);
        return redirect()->route('adherents.index')->with('success', 'Adhérent ajouté avec succès.');
    
    
    }

    /**
     * Display the specified resource.
     */
    public function show(Adherent $adherent)
    {
        $pretations = Prestation::where('adherentCode' == $adherent->code_carte);
        return view('pages.backend.adherents.show', compact('adherent', 'pretations'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        $adherent = Adherent::findOrFail($id); // Trouver l'ayant droit par ID

        return view('pages.backend.adherents.edit',compact('adherent'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAdherentRequest $request, $id)
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
        $adherent = Adherent::findOrFail($id);

        $adherent->nom = $validatedData['nom'];
        $adherent->prenom = $validatedData['prenom'];
        $adherent->genre = $validatedData['genre'];
        $adherent->service = $validatedData['service'];
        $adherent->no_matricule = $validatedData['no_matricule'];
        $adherent->code_carte = $validatedData['code_carte'];
        $adherent->charge = $validatedData['charge'];
        $adherent->mensualite = $validatedData['mensualite'];
        $adherent->adhesion = $validatedData['adhesion'];
        $adherent->date_enregistrement = $validatedData['date_enregistrement'];

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos', 'public');
            $adherent->photo = $photoPath;
        }

        $adherent->save();

        return redirect()->route('adherents.index')->with('success', 'Adhérent mis à jour avec succès.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $adherent = Adherent::findOrFail($id);
            $adherent->delete();
            
            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

}

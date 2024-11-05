<?php

namespace App\Http\Controllers;

use App\Imports\AyantDroitsImport;
use App\Models\AyantDroit;
use App\Http\Requests\StoreAyantDroitRequest;
use App\Http\Requests\UpdateAyantDroitRequest;
use App\Models\Adherant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;


use Maatwebsite\Excel\Facades\Excel;

class AyantDroitController extends Controller
{
    // Frontend

    public function ayantsDroits()
    {
        $adherent = auth()->guard('adherent')->user();
        $ayantsDroits = AyantDroit::where('adherant_id', $adherent->id)->get();
        return  view('pages.frontend.adherents.ayantsdroits.index',
                compact('adherent', 'ayantsDroits')
        );

    }
    public function newAyantDroitAdherent()
    {
        $adherent = auth()->guard('adherent')->user();
        $adherent->ayantsDroits = json_decode($adherent->ayantsDroits, true); 

        $ayantsDroits = $adherent->ayantsDroits;
        return  view('pages.frontend.adherents.ayantsdroits.create',
                compact('adherent', 'ayantsDroits')
        );

    }
    public function storeAyantDroitAdherent(StoreAyantDroitRequest $request)
    {
        $adherent = auth()->guard('adherent')->user();
        $adherent->ayantsDroits = json_decode($adherent->ayantsDroits, true); 

        $ayantsDroits = $adherent->ayantsDroits;


        $ayantDroit = new AyantDroit();
        $ayantDroit->nom = $request->nom;
        $ayantDroit->prenom = $request->prenom;
        $ayantDroit->sexe = $request->sexe;
        $ayantDroit->date_naissance = $request->date_naissance;
        $ayantDroit->relation = $request->relation;
        $ayantDroit->code = $adherent->matricule . '/01';
        $ayantDroit->adherant_id = $adherent->id;

        $ayantDroit->save();
        return redirect()->route('adherents.ayantsdroits')->with('success', 'Ayant droit ajouté avec succès.');
        

    }
    public function deleteAyantDroitAdherent($id)
    {
        
        $ayantDroit = AyantDroit::find($id);

        if ($ayantDroit) {
            $ayantDroit->delete();
            return redirect()->back()->with('success', 'Ayant droit supprimé avec succès.');
        }

        return redirect()->back()->with('error', 'Ayant droit non trouvé.');
    }
   
    

    // Backend

    /**
    * Display a listing of the resource.
    */
    public function index()
    {
        //
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
                'name' => 'Création ayant droit',
                'url' => route('ayantsdroits.create'),
                'active' => true
            ],
        ];
        $pageTitle = 'Création ayant droit';
        $adherants = Adherant::all();
        
        return view('pages.backend.ayantsdroits.create',compact('adherants', 'pageTitle', 'breadcrumbsItems'));
        
    }
    
    /**
    * Store a newly created resource in storage.
    */
    public function store(StoreAyantDroitRequest $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'sexe' => 'required',
            'date_naissance' => 'required|date',
            'relation' => 'required',
            'adherant_id' => 'required',
            'code' => 'required',
            
        ]);
        
        $adherant = Adherant::where('no_matricule', $request->adherant_id)->firstOrFail();
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
                'matricule_adherant' => $ayantDroit->adherant->no_matricule, 
            ];
        });        
        $ayantDroit = new AyantDroit();
        $ayantDroit->nom = $validatedData['nom'];
        $ayantDroit->prenom = $validatedData['prenom'];
        $ayantDroit->sexe = $validatedData['sexe'];
        $ayantDroit->date_naissance = $validatedData['date_naissance'];
        $ayantDroit->relation = $validatedData['relation'];
        $ayantDroit->adherant_id = $adherant->id; 

        $ayantDroit->code = $validatedData['code'];
        
        $ayantDroit->save();
        return redirect()->route('adherants.index')->with('success', 'Ayant droit ajouté avec succès.');
   
        

    }
    
    public function import(Request $request)
    {
    $validator = Validator::make($request->all(), [
        'excel-file-ayant-droit' => 'required|mimes:xlsx,xls,csv'
    ]);
    
    // Si la validation échoue, retourner avec les erreurs
    if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();
    }
    $headerAyantDroit = [
            'nom', 'prenom', 'sexe', 'date_naissance', 'relation', 'code', 'matricule_id'
    ];

    // Récupérer le fichier depuis la requête
    $file = $request->file('excel-file-ayant-droit');
    try {
        // Importer les données depuis le fichier Excel
        Excel::import(new AyantDroitsImport, $file);

        // Rediriger avec un message de succès
        return redirect()->route('adherants.index')
                         ->with('success', 'Ayant-droits importés avec succès.');
    } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
        $failures = $e->failures();
        $messages = [];

        // Collecter les messages d'erreur
        foreach ($failures as $failure) {
            $messages[] = 'Erreur à la ligne ' . $failure->row() . ': ' . implode(', ', $failure->errors());
        }

        // Retourner avec les messages d'erreur
        return back()->withErrors($messages)->withInput();
    } catch (\Exception $e) {
        Log::error('Erreur générale lors de l\'importation : ' . $e->getMessage());
        // En cas d'erreur générale
        return back()->withErrors(['error' => 'Erreur lors de l\'importation : ' . $e->getMessage()]);
    }
    }

    /**
    * Display the specified resource.
    */
    public function show(AyantDroit $ayantDroit)
    {
        //
    }
    
    /**
    * Show the form for editing the specified resource.
    */
    
    public function edit($id)
    {
        $ayantDroit = AyantDroit::findOrFail($id); // Trouver l'ayant droit par ID
        $adherants = Adherant::all(); 

        return view('pages.backend.ayantsdroits.edit',compact('adherants', 'ayantDroit'));

    }
    
    /**
    * Update the specified resource in storage.
    */
    public function update(UpdateAyantDroitRequest $request, $id)
    {
        $validatedData = $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'sexe' => 'required',
            'date_naissance' => 'required|date',
            'relation' => 'required',
            'adherant_id' => 'required',
            'code' => 'required',
        ]);

        $ayantDroit = AyantDroit::findOrFail($id);

        $ayantDroit->nom = $validatedData['nom'];
        $ayantDroit->prenom = $validatedData['prenom'];
        $ayantDroit->sexe = $validatedData['sexe'];
        $ayantDroit->date_naissance = $validatedData['date_naissance'];
        $ayantDroit->relation = $validatedData['relation'];

        $adherant = Adherant::where('no_matricule', $request->adherant_id)->firstOrFail();
        $ayantDroit->adherant_id = $adherant->id; 
        $ayantDroit->code = $validatedData['code'];

        $ayantDroit->save();

        return redirect()->route('adherants.index')->with('success', 'Ayant droit mis à jour avec succès.');
    }


    
    /**
    * Remove the specified resource from storage.
    */
    public function destroy($id)
    {
        try {
            $ayantDroit = AyantDroit::findOrFail($id);
            
            $ayantDroit->delete();

            return response()->json(['success' => 'Enregistrement supprimé avec succès!'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erreur lors de la suppression: ' . $e->getMessage()], 500);
        }
    }

}

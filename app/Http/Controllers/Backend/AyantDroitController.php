<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;

use App\Imports\AyantDroitsImport;
use App\Models\AyantDroit;
use App\Http\Requests\StoreAyantDroitRequest;
use App\Http\Requests\UpdateAyantDroitRequest;
use App\Models\Adherent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;


use Maatwebsite\Excel\Facades\Excel;

class AyantDroitController extends Controller
{

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
                'url' => route('adherents.index'),
                'active' => false
            ],
            [
                'name' => 'Création ayant droit',
                'url' => route('ayantsdroits.create'),
                'active' => true
            ],
        ];
        $pageTitle = 'Création ayant droit';
        $adherents = Adherent::all();
        
        return view('pages.backend.ayantsdroits.create',compact('adherents', 'pageTitle', 'breadcrumbsItems'));
        
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
            'adherent_id' => 'required',
            'code' => 'required',
            
        ]);
        
        $adherent = Adherent::where('no_matricule', $request->adherent_id)->firstOrFail();
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
                'matricule_adherent' => $ayantDroit->adherent->no_matricule, 
            ];
        });        
        $ayantDroit = new AyantDroit();
        $ayantDroit->nom = $validatedData['nom'];
        $ayantDroit->prenom = $validatedData['prenom'];
        $ayantDroit->sexe = $validatedData['sexe'];
        $ayantDroit->date_naissance = $validatedData['date_naissance'];
        $ayantDroit->relation = $validatedData['relation'];
        $ayantDroit->adherent_id = $adherent->id; 

        $ayantDroit->code = $validatedData['code'];
        
        $ayantDroit->save();
        return redirect()->route('adherents.index')->with('success', 'Ayant droit ajouté avec succès.');
   
        

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
            return redirect()->route('adherents.index')
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
    public function show($id)
    {
        $ayantDroit = AyantDroit::with('adherent')->findOrFail($id);
        $pageTitle = 'Informations mutualiste';

        return view('pages.backend.ayantsdroits.show', compact('ayantDroit', 'pageTitle'));
    }
    
    /**
    * Show the form for editing the specified resource.
    */
    
    public function edit($id)
    {
        $ayantDroit = AyantDroit::findOrFail($id); // Trouver l'ayant droit par ID
        $breadcrumbsItems = [
            [
                'name' => 'Adhésions',
                'url' => route('adherents.index'),
                'active' => false
            ],
            [
                'name' => 'Modification ayant droit',
                'url' => route('ayantsdroits.edit', $ayantDroit->id ),
                'active' => true
            ],
        ];
        $pageTitle = 'Edition ayant droit';
        $autresAyantsDroit = AyantDroit::where('adherent_id', $ayantDroit->adherent_id)
                ->orderBy('position') // Optionnel : trier par position
                ->get();
        return view('pages.backend.ayantsdroits.edit',compact( 'ayantDroit', 'breadcrumbsItems', 'pageTitle', 'autresAyantsDroit'));

    }
    
    /**
    * Update the specified resource in storage.
    */
    public function update(UpdateAyantDroitRequest $request, $id)
    {
        $ayantDroit = AyantDroit::findOrFail($id);
    
        $ayantDroit->update($request->validated());
    
        $ayantDroit->code = $ayantDroit->adherent->matricule.'/0'.$request->position;
        $ayantDroit->save(); 
        return redirect()->route('adherents.index')->with('success', 'Ayant droit mis à jour avec succès.');
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

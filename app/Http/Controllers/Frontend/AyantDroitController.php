<?php

namespace App\Http\Controllers\Frontend;

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

    public function ayantsDroits()
    {
        $adherent = auth()->guard('adherent')->user();
        $ayantsDroits = AyantDroit::where('adherent_id', $adherent->id)->get();
        $pageTitle = 'Liste des ayants droit';
        return  view('pages.frontend.adherents.ayantsdroits.index',
                compact('adherent', 'ayantsDroits', 'pageTitle')
        );

    }
    public function newAyantDroitAdherent()
    {
        $adherent = auth()->guard('adherent')->user();
        $adherent->ayantsDroits = json_decode($adherent->ayantsDroits, true); 

        $ayantsDroits = $adherent->ayantsDroits;
        $pageTitle = 'Nouveau';
        return  view('pages.frontend.adherents.ayantsdroits.create',
                compact('adherent', 'ayantsDroits', 'pageTitle')
        );

    }
    public function storeAyantDroitAdherent(StoreAyantDroitRequest $request)
    {
        $adherent = auth()->guard('adherent')->user();
        $nextPosition = AyantDroit::where('adherent_id', $adherent->id)->max('position') + 1;
        
        if ($nextPosition > 6) {
            return back()->withErrors(['message' => 'Vous ne pouvez pas ajouter plus de 7 ayants droits.']);
        }
    
        $ayantDroit = new AyantDroit();
        $ayantDroit->nom = $request->nom;
        $ayantDroit->prenom = $request->prenom;
        $ayantDroit->sexe = $request->sexe;
        $ayantDroit->date_naissance = $request->date_naissance;
        $ayantDroit->relation = $request->relation;
        $ayantDroit->code = $adherent->matricule . '/0'.$nextPosition;
        $ayantDroit->adherent_id = $adherent->id;
        $ayantDroit->position = $nextPosition;
    
        // Gestion des fichiers
        if ($request->hasFile('photo')) {
            $ayantDroit->photo = $request->file('photo')->store('ayants_droits/photos', 'public');
        }
        
        if ($request->hasFile('extrait')) {
            $ayantDroit->extrait = $request->file('extrait')->store('ayants_droits/extraits', 'public');
        }
    
        if ($request->relation === 'Epoux' || $request->relation === 'Epouse') {
            if ($request->hasFile('cnib')) {
                $ayantDroit->cnib = $request->file('cnib')->store('ayants_droits/cnib', 'public');
            }
        }
    
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
   
 

}

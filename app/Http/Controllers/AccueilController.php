<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DemandeAdhesion;


class AccueilController extends Controller
{
    public function accueil (){
        return view('pages.frontend.accueil');
    }

    public function newAdhesion(){
        return view('pages.frontend.adherents.formulaire_adhesion');
    }


    public function resumeAdhesion($id)
    {
        $demandeAdhesion = DemandeAdhesion::findOrFail($id);
        $ayantsDroits = json_decode($demandeAdhesion->ayantsDroits, true); 
        return view('pages.frontend.adherents.resume_adhesion', compact('demandeAdhesion', 'ayantsDroits'));
    }
}

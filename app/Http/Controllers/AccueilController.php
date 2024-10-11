<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccueilController extends Controller
{
    public function accueil (){
        return view('pages.frontend.accueil');
    }

    public function newAdhesion(){
        return view('pages.frontend.adherents.formulaire_adhesion');
    }
}

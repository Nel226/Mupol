<?php

namespace App\Http\Controllers;

use App\Models\DemandeAdhesion;
use Illuminate\Http\Request;

class DemandeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $breadcrumbsItems = [
            [
                'name' => 'Adhésions',
                'url' => route('adherants.index'),
                'active' => true
            ],
        ];
        $pageTitle = 'Liste des demandes d\'adhésions';

        $demandes = DemandeAdhesion::all();
        
        return view('pages.backend.demandes.index', compact('demandes', 'breadcrumbsItems', 'pageTitle'));
    }
    


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Display the specified resource.
     */
    public function show(DemandeAdhesion $demande)
    {
        $breadcrumbsItems = [
            [
                'name' => 'Adhésions',
                'url' => route('adherants.index'),
                'active' => true
            ],
        ];
        $pageTitle = 'Liste des demandes d\'adhésions';
        return view('pages.backend.demandes.show', compact('demande', 'breadcrumbsItems', 'pageTitle' ));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        $demande = DemandeAdhesion::findOrFail($id); 

        return view('pages.backend.demandes.edit',compact('demande'));
    }


}

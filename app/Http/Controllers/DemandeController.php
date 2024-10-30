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

        $demandes = DemandeAdhesion::orderBy('created_at', 'desc')->get();
        
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
                'name' => 'Demandes',
                'url' => route('demandes.index'),
                'active' => false
            ],
            [
                'name' => 'Adhésions',
                'url' => route('demandes.index'),
                'active' => true
            ],
        ];
        $pageTitle = 'Demande N°'.$demande->id;
        $demande->ayantsDroits = json_decode($demande->ayantsDroits, true); 

        return view('pages.backend.demandes.show', compact('demande', 'breadcrumbsItems', 'pageTitle' ));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        $demande = DemandeAdhesion::findOrFail($id); 
        $pageTitle = 'Modification demande N°'.$demande->id;


        return view('pages.backend.demandes.edit',compact('demande', 'pageTitle'));
    }


}

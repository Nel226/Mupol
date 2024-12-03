<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;

use App\Models\Adherent;
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
                'url' => route('adherents.index'),
                'active' => true
            ],
        ];
        $pageTitle = 'Liste des demandes d\'adhésions';

        $demandes = Adherent::orderBy('created_at', 'desc')->get();
        
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

    public function accept($id)
    {
        $adherent = Adherent::find($id);

        if ($adherent) {
            $adherent->is_adherent = true;
            $adherent->save();

            $demande = $adherent->demande; 

            if ($demande) {
                $demande->etat = 1;
                $demande->save();
            }

            return redirect()->back()->with('success', 'La demande a été acceptée avec succès.');
        }

        return redirect()->back()->withErrors(['error' => 'Adhérent non trouvé.']);
    }


}

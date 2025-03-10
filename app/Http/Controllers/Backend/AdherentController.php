<?php

namespace App\Http\Controllers\Backend;
use App\Helpers\DemandeCategorieHelper;
use App\Helpers\PasswordHelper;
use App\Http\Controllers\Controller;


use App\Models\Adherent;
use App\Http\Requests\StoreAdherentRequest;
use App\Http\Requests\UpdateAdherentRequest;
use App\Mail\ConfirmationCreationCompte;
use App\Mail\ConfirmationDemandeAdhesion;
use App\Mail\CreationAdherent;
use App\Models\AyantDroit;
use App\Models\DemandeAdhesion;
use App\Models\Prestation;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class AdherentController extends Controller
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
        $pageTitle = 'Liste des adhésions';

        $adherents = Adherent::all()->map(function ($adherent) {
            $adherent->type = 'adherent'; // Ajoute le type
            return $adherent;
        });
    
        $ayantsDroit = AyantDroit::with('adherent')->get()->map(function ($ayantDroit) {
            $ayantDroit->type = 'ayant_droit'; // Ajoute le type
            return $ayantDroit;
        });    
        $mutualistes = $adherents->concat($ayantsDroit);

        return view('pages.backend.adherents.index', compact( 'mutualistes', 'ayantsDroit','adherents', 'pageTitle', 'breadcrumbsItems'));
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
        $validatedData = $request->validated();

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

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos/adherents', 'public');
            $validatedData['photo'] = $photoPath;
        }

        $validatedData['is_adherent'] = true; 
        $validatedData['is_new'] = true; 
        $validatedData['must_change_password'] = true; 
        $generatedPassword = PasswordHelper::generateSecurePassword();
        $validatedData['password'] = $generatedPassword; 
        $validatedData['charge'] = $validatedData['nombreAyantsDroits']; 
        $categorie = DemandeCategorieHelper::determineCategorie($validatedData['charge']);
        $validatedData['categorie'] = $categorie; 
        $validatedData['code_carte'] = $validatedData['matricule'].'/00';
        if ($request->ayantsDroits) {
            $validatedData['ayantsDroits'] = $request->ayantsDroits;
        }
        $adherent = Adherent::create($validatedData);
        $pdf = Pdf::loadView('pages.frontend.adherents.fiches.cession_volontaire', ['adherent' => $adherent]);

        Mail::to($request->email)->send(new CreationAdherent($adherent, $pdf, $generatedPassword));

        dd($adherent);
        return redirect()->route('adherents.index')->with('success', 'Adhérent ajouté avec succès.');
    
    
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Rechercher l'adhérent par ID ou UUID
        $adherent = Adherent::where('id', $id)
                            ->firstOrFail(); // Génère une 404 si non trouvé

        $pageTitle = 'Informations mutualiste';

        // Corriger la requête Prestation (mauvaise syntaxe)
        $pretations = Prestation::where('adherentCode', $adherent->code_carte)->get();

        return view('pages.backend.adherents.show', compact('adherent', 'pretations', 'pageTitle'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        $adherent = Adherent::findOrFail($id); // Trouver l'ayant droit par ID
        $ayantsDroit = AyantDroit::where('adherent_id', $adherent->id)->get();
        $breadcrumbsItems = [
            [
                'name' => 'Adhésions',
                'url' => route('adherents.index'),
                'active' => false
            ],
            [
                'name' => 'Modification adhérent',
                'url' => route('adherents.edit', $adherent->id ),
                'active' => true
            ],
        ];
        $pageTitle = 'Modifier adhérent';

        return view('pages.backend.adherents.edit',compact('adherent', 'ayantsDroit', 'breadcrumbsItems', 'pageTitle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAdherentRequest $request, $id)
    {

        
        $validatedData = $request->validated();
    
        // Trouver l'adhérent à mettre à jour
        $adherent = Adherent::findOrFail($id);
       
        $categorie = DemandeCategorieHelper::determineCategorie($request->nombreAyantsDroits);
        $validatedData['categorie'] = $categorie;
        // Mettre à jour les informations de l'adhérent
        $adherent->update([
            'nom' => $validatedData['nom'],
            'prenom' => $validatedData['prenom'],
            'telephone' => $validatedData['telephone'],
            'genre' => $validatedData['genre'],
            'service' => $validatedData['service'],
            'nombreAyantsDroits' => $validatedData['nombreAyantsDroits'],

            'date_enregistrement' => $validatedData['date_enregistrement'],
            'charge' => $request->nombreAyantsDroits,
            'is_adherent' => true,
            'mensualite' => $validatedData['mensualite'],
            'categorie' => $validatedData['categorie'],
        ]);
      
        // if (isset($validatedData['ayantsDroits'])) {
        //     foreach ($validatedData['ayantsDroits'] as $ayantDroit) {
        //         $adherent->ayantsDroits()->updateOrCreate(
        //             ['id' => $ayantDroit['id']], // Assurez-vous que l'id existe si vous souhaitez mettre à jour
        //             [
        //                 'nom' => $ayantDroit['nom'],
        //                 'prenom' => $ayantDroit['prenom'],
        //                 'sexe' => $ayantDroit['sexe'],
        //                 'date_naissance' => $ayantDroit['date_naissance'],
        //                 'relation' => $ayantDroit['relation'],
        //             ]
        //         );
        //     }
        // }
    
        

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

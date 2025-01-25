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
use App\Models\AyantDroit;
use App\Models\DemandeAdhesion;
use App\Models\Prestation;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Request;

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

        $adherents = Adherent::all();
        $ayantsDroit = AyantDroit::with('adherent')->get();        
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
        $pageTitle = 'Informations mutualiste';

        $pretations = Prestation::where('adherentCode' == $adherent->code_carte);
        return view('pages.backend.adherents.show', compact('adherent', 'pretations', 'pageTitle'));

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

        
        $validatedData = $request->validated();
    
        // Trouver l'adhérent à mettre à jour
        $adherent = Adherent::findOrFail($id);
        $matricule =  $adherent->matricule;
        $cotisations = DemandeCategorieHelper::calculerCotisationMensuelleTotale($request->nombreAyantsDroits, $request->statut);
        $mensualite = $cotisations['cotisationTotale'];
        $charge = $request->nombreAyantsDroits;
        $categorie = DemandeCategorieHelper::determineCategorie($request->nombreAyantsDroits);
        $generatedPassword = PasswordHelper::generateSecurePassword();

        $validatedData['mensualite'] = $mensualite;
        $validatedData['charge'] = $charge;
        $validatedData['categorie'] = $categorie;
        // Mettre à jour les informations de l'adhérent
        $adherent->update([
            'nip' => $validatedData['nip'],
            'cnib' => $validatedData['cnib'],
            'delivree' => $validatedData['delivree'],
            'expire' => $validatedData['expire'],
            'adresse' => $validatedData['adresse'],
            'genre' => $validatedData['genre'],
            'ville' => $validatedData['ville'],
            'departement' => $validatedData['departement'],
            'pays' => $validatedData['pays'],
            'nom_pere' => $validatedData['nom_pere'],
            'nom_mere' => $validatedData['nom_mere'],
            'situation_matrimoniale' => $validatedData['situation_matrimoniale'],
            'nom_prenom_personne_besoin' => $validatedData['nom_prenom_personne_besoin'],
            'lieu_residence' => $validatedData['lieu_residence'],
            'telephone_personne_prevenir' => $validatedData['telephone_personne_prevenir'],
            'statut' => $validatedData['statut'],
            'dateDepartARetraite' => $validatedData['dateDepartARetraite'],
            'grade' => $validatedData['grade'],
            'service' => $validatedData['service'],
            'direction' => $validatedData['direction'],
            'date_enregistrement' => $validatedData['date_enregistrement'],
            'region' => $validatedData['region'],
            'province' => $validatedData['province'],
            'localite' => $validatedData['localite'],
            'is_adherent' => true,
            'code_carte' => $matricule.'/00',
            'password' => $generatedPassword,
            'mensualite' => $validatedData['mensualite'],
            'charge' => $validatedData['charge'],
            'categorie' => $validatedData['categorie'],
        ]);
        Mail::to($adherent->email)->send(new ConfirmationCreationCompte($adherent->email, $generatedPassword));
        $demande = DemandeAdhesion::find($adherent->demande_id);

        if ($demande) {
            $demande->etat = true;
            $demande->save();
        }
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
    
        

        return redirect()->route('demandes.index')->with('success', 'Adhérent mis à jour avec succès.');
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

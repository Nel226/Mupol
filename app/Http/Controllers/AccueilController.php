<?php

namespace App\Http\Controllers;

use App\Helpers\PDFHelper;
use Illuminate\Http\Request;
use App\Models\DemandeAdhesion;
use Carbon\Carbon;
use App\Helpers\DemandeCategorieHelper;
use App\Helpers\DateHelper;
use Illuminate\Support\Facades\Mail;
use App\Mail\ConfirmationDemandeAdhesion; 
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Adherant;
use Illuminate\Support\Facades\Hash;
use App\Mail\AdherantRegistrationMail;
use App\Models\AyantDroit;
use Illuminate\Support\Str;

class AccueilController extends Controller
{
    public function accueil (){
        return view('pages.frontend.accueil');
    }

    public function newAdhesion(){
        return view('pages.frontend.adherents.formulaire_adhesion');
    }

    public function recapitulatifForm( Request $request)
    {
        $data = $request->all();
        $totalSteps = 5;
        return view('components.wizard-membership', [
            'step' => 5, 
            'data' => $data, 
            'totalSteps' => $totalSteps,
        ]);

    }
    public function resumeAdhesion($id)
    {
        $demandeAdhesion = DemandeAdhesion::findOrFail($id);
        $cotisations = DemandeCategorieHelper::calculerCotisationMensuelleTotale($demandeAdhesion->nombreAyantsDroits);

        $dateActuelle = now()->format('Y-m-d'); 
        $dateEnLettres = DateHelper::convertirDateEnLettres($dateActuelle);
        $ayantsDroits = json_decode($demandeAdhesion->ayantsDroits, true); 
        return view('pages.frontend.adherents.resume_adhesion', compact('demandeAdhesion', 'dateEnLettres', 'ayantsDroits','cotisations'));
    }

    public function showCessionVolontaire($id)
    {
        $date = Carbon::parse(now())->translatedFormat('d F Y'); 

        $demandeAdhesion = DemandeAdhesion::findOrFail($id);
        $cotisations = DemandeCategorieHelper::calculerCotisationMensuelleTotale($demandeAdhesion->nombreAyantsDroits);
        return view('pages.frontend.adherents.fiches.cession_volontaire', compact('demandeAdhesion', 'cotisations'));
    }
    
    public function finalAdhesion(Request $request)
    {

        $demandeAdhesion = DemandeAdhesion::findOrFail($request->input('demande_adhesion_id'));
        $demandeAdhesion->region = $request->input('region');
        $demandeAdhesion->province = $request->input('province');
        $demandeAdhesion->localite = $request->input('localite');
        $demandeAdhesion->signature = $request->input('signature'); 
        $demandeAdhesion->save();
        $cotisations = DemandeCategorieHelper::calculerCotisationMensuelleTotale($demandeAdhesion->nombreAyantsDroits);
        $pdf = Pdf::loadView('pages.frontend.adherents.fiches.cession_volontaire', ['demandeAdhesion' => $demandeAdhesion]);

        $generatedPassword = 'ggbvvhLJJn';

        $adherent = Adherant::create([
            'matricule' => $demandeAdhesion->matricule, 
            'nip' => $demandeAdhesion->nip,
            'cnib' => $demandeAdhesion->cnib,
            'delivree' => $demandeAdhesion->delivree,
            'expire' => $demandeAdhesion->expire,
            'adresse' => $demandeAdhesion->adresse_permanente,
            'telephone' => $demandeAdhesion->telephone,
            'email' => $demandeAdhesion->email,
            'nom' => $demandeAdhesion->nom,
            'prenom' => $demandeAdhesion->prenom,
            'genre' => $demandeAdhesion->genre, 
            'departement' => $demandeAdhesion->departement, 
            'ville' => $demandeAdhesion->ville,
            'pays' => $demandeAdhesion->pays,
            'nom_pere' => $demandeAdhesion->nom_pere,
            'nom_mere' => $demandeAdhesion->nom_mere,
            'situation_matrimoniale' => $demandeAdhesion->situation_matrimoniale,
            'nom_prenom_personne_besoin' => $demandeAdhesion->nom_prenom_personne_besoin,
            'lieu_residence' => $demandeAdhesion->lieu_residence,
            'telephone_personne_prevenir' => $demandeAdhesion->telephone_personne_prevenir,
            'photo' => $demandeAdhesion->photo,
            'nombreAyantsDroits' => $demandeAdhesion->nombreAyantsDroits,
            'ayantsDroits' => $demandeAdhesion->ayantsDroits,
            'categorie' => $demandeAdhesion->categorie,
            'statut' => $demandeAdhesion->statut,
            'grade' => $demandeAdhesion->grade,
            'departARetraite' => $demandeAdhesion->departARetraite,
            'numeroCARFO' => $demandeAdhesion->numeroCARFO,
            'dateIntegration' => $demandeAdhesion->dateIntegration,
            'dateDepartARetraite' => $demandeAdhesion->dateDepartARetraite,
            'direction' => $demandeAdhesion->direction,
            'service' => $demandeAdhesion->service,
            'password' => Hash::make($generatedPassword), 
            'date_enregistrement' => now(),
            'code_carte' => $demandeAdhesion->matricule . '/00', 

        ]);

        $ayantsDroitsArray = json_decode($demandeAdhesion->ayantsDroits, true);

        if (is_array($ayantsDroitsArray)) {
            foreach ($ayantsDroitsArray as $index => $ayantDroitData) {
                AyantDroit::create([
                    'nom' => $ayantDroitData['nom'],
                    'prenom' => $ayantDroitData['prenom'],
                    'sexe' => $ayantDroitData['sexe'],
                    'photo' => $ayantDroitData['photo'],
                    'cnib' => $ayantDroitData['cnib'] ?? null,
                    'extrait' => $ayantDroitData['extrait'] ?? null,
                    'adherant_id' => $adherent->id ,

                    'date_naissance' => $ayantDroitData['date_naissance'],
                    'relation' => $ayantDroitData['lien_parente'],
                    'code' => $adherent->matricule . '/0' .$index,
                    'position' => $index, 

                ]);
            }
        }

        Mail::to($demandeAdhesion->email)->send(new ConfirmationDemandeAdhesion($demandeAdhesion, $pdf, $generatedPassword));

        return view('pages.frontend.adherents.final-demande-adhesion', compact( 'cotisations', 'demandeAdhesion'));
    }


    public function downloadCessionFiche($id)
    {
        $demandeAdhesion = DemandeAdhesion::findOrFail($id);
        
        $data = [
            'demandeAdhesion' => $demandeAdhesion,
            'logoPath' => public_path('images/logofinal.png'),
            'signature' => $demandeAdhesion->signature, 

        ];
        
        return PDFHelper::downloadPDF('pages.frontend.adherents.fiches.cession_volontaire', $data, 'Fiche_cession_volontaire_' . $demandeAdhesion->id);
    }
    
    public function imprimerFicheCession($id)
    {
        $demandeAdhesion = DemandeAdhesion::findOrFail($id);

        return view('pages.frontend.adherents.fiches.cession_volontaire', compact('demandeAdhesion'));
    }


    public function downloadFormAdhesion($id)
    {
        $demandeAdhesion = demandeAdhesion::findOrFail($id);

        $data = [
            'demandeAdhesion' => $demandeAdhesion,
            'logoPath' => public_path('images/logofinal.png'), // Path to your logo image
        ];

        return PDFHelper::downloadPDF('pages.frontend.adherents.fiches.formulaire_adhesion', $data, 'Formulaire_adhesion' . $demandeAdhesion->id . '.pdf');
    }


}

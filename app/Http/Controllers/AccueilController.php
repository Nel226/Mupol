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
use App\Helpers\PasswordHelper;

class AccueilController extends Controller
{
    public function accueil (){
        $types = ['consultation', 'hospitalisation', 'radio', 'maternite', 'allocation', 'analyse_biomedicale', 'pharmacie', 'optique', 'dentaire_auditif', 'autre'];
        $descriptions = [
            'consultation' => 'Nous proposons des consultations médicales pour évaluer vos besoins en santé et recommander un traitement adapté.',
            'hospitalisation' => 'Notre établissement dispose d\'installations modernes pour un séjour hospitalier sécurisé et confortable.',
            'radio' => 'Nos services de radiologie offrent une large gamme de tests pour diagnostiquer et traiter divers problèmes médicaux.',
            'maternite' => 'Nous offrons des soins de maternité complets pour assurer le bien-être de la mère et de l\'enfant tout au long de la grossesse.',
            'allocation' => 'Des allocations pour soutenir financièrement les patients dans leurs soins médicaux sont disponibles sur demande.',
            'analyse_biomedicale' => 'Nos analyses biomédicales permettent un diagnostic précis, contribuant à la prise en charge rapide de vos problèmes de santé.',
            'pharmacie' => 'La pharmacie propose une large gamme de médicaments et de produits de santé pour répondre à vos besoins médicaux quotidiens.',
            'optique' => 'Nos services d\'optique incluent des examens de la vue et des solutions pour améliorer votre confort visuel.',
            'dentaire_auditif' => 'Soins dentaires et auditifs personnalisés pour garantir une santé bucco-dentaire et auditive optimale.',
        ];
        return view('pages.frontend.accueil', compact('types', 'descriptions'));
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
        $cotisations = DemandeCategorieHelper::calculerCotisationMensuelleTotale($demandeAdhesion->nombreAyantsDroits, $demandeAdhesion->statut);

        $dateActuelle = now()->format('Y-m-d'); 
        $dateEnLettres = DateHelper::convertirDateEnLettres($dateActuelle);
        $ayantsDroits = json_decode($demandeAdhesion->ayantsDroits, true); 
        return view('pages.frontend.adherents.resume_adhesion', compact('demandeAdhesion', 'dateEnLettres', 'ayantsDroits','cotisations'));
    }

    public function showCessionVolontaire($id)
    {
        $date = Carbon::parse(now())->translatedFormat('d F Y'); 

        $demandeAdhesion = DemandeAdhesion::findOrFail($id);
        $cotisations = DemandeCategorieHelper::calculerCotisationMensuelleTotale($demandeAdhesion->nombreAyantsDroits, $demandeAdhesion->statut);
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
        $cotisations = DemandeCategorieHelper::calculerCotisationMensuelleTotale($demandeAdhesion->nombreAyantsDroits, $demandeAdhesion->statut);
        $pdf = Pdf::loadView('pages.frontend.adherents.fiches.cession_volontaire', ['demandeAdhesion' => $demandeAdhesion]);

        $adherent = Adherant::where('matricule', $demandeAdhesion->matricule)->first();
    
        if (!$adherent) {
            $generatedPassword = PasswordHelper::generateSecurePassword();
            
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
                'region' => $demandeAdhesion->region,
                'province' => $demandeAdhesion->province,
                'localite' => $demandeAdhesion->localite,
                'must_change_password' => true,
                'is_adherent' => false,


            ]);
        }

        $ayantsDroitsArray = json_decode($demandeAdhesion->ayantsDroits, true);

        if (is_array($ayantsDroitsArray)) {
            foreach ($ayantsDroitsArray as $index => $ayantDroitData) {
                AyantDroit::create([
                    'nom' => $ayantDroitData['nom'],
                    'prenom' => $ayantDroitData['prenom'],
                    'sexe' => $ayantDroitData['sexe'],
                    'photo' => $ayantDroitData['photo'] ?? null,
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


    public function contacts()
    {
        return view('pages.frontend.contacts.contacts');
    }

    public function services()
    {
        return view('pages.frontend.services.services');
    }

    public function enConstruction()
    {
        return view('pages.frontend.under-construction');
    }

}

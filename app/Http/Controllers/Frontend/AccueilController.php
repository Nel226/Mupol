<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Helpers\PDFHelper;
use Illuminate\Http\Request;
use App\Models\DemandeAdhesion;
use Carbon\Carbon;
use App\Helpers\DemandeCategorieHelper;
use App\Helpers\DateHelper;
use Illuminate\Support\Facades\Mail;
use App\Mail\ConfirmationDemandeAdhesion; 
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Adherent;
use Illuminate\Support\Facades\Hash;
use App\Mail\AdherentRegistrationMail;
use App\Models\AyantDroit;
use App\Helpers\PasswordHelper;
use App\Models\Partenaire;
use App\Models\Article;
use Mews\Purifier\Facades\Purifier;


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
        $articles = Article::latest()->get();
        return view('pages.frontend.accueil', compact('types', 'descriptions', 'articles'));
    }

    public function newAdhesion(Request $request, $adherentType){
        return view('pages.frontend.adherents.formulaire_adhesion', [
            'type' => $request->query('type', 'nouveau'), // 'nouveau' par défaut
            'adherentType' => $adherentType
        ]);
    }

    public function oldAdhesion(Request $request)
    {
        try {
            // Validation des données
            $validatedData = $request->validate([
                'nom' => 'required|string|max:255',
                'prenom' => 'required|string|max:255',
                'matricule' => 'required|string|max:20|unique:demande_adhesions,matricule',
                'telephone' => 'required|string|regex:/^(\+?[1-9][0-9]{0,2})?[0-9]{8,10}$/',
                'email' => 'required|email|max:255',
                'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:1024',
            ], [
                'matricule.unique' => 'Vous avez déjà soumis une demande de création de compte qui est actuellement en attente de validation.',
            ]);

            // Ajout d'une clé pour signaler une ancienne adhésion
            $validatedData['is_new'] = false;

            // Vérification et stockage de la photo
            if ($request->hasFile('photo')) {
                $photoPath = $request->file('photo')->store('photos/adherents', 'public');
                $validatedData['photo'] = $photoPath;
            }

            // Enregistrement de la demande
            DemandeAdhesion::create($validatedData);

            // Retour en cas de succès
            return redirect()
                ->route('user.login')
                ->with('success', 'Vos données ont été soumises avec succès et sont en cours de validation. Vous recevrez un email lorsque la création de votre compte sera approuvée.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Gestion spécifique des erreurs de validation
            if ($e->validator->errors()->has('matricule')) {
                return redirect()
                    ->back()
                    ->with('error', 'Erreur : ' . $e->validator->errors()->first('matricule'))
                    ->withInput();
            }

            return redirect()
                ->back()
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Exception $e) {
            // Gestion des erreurs imprévues
            return redirect()
                ->back()
                ->with('error', 'Une erreur inattendue s\'est produite. Veuillez réessayer plus tard.')
                ->withInput();
        }
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
    
    public function finalAdhesion($id)
    {

        $demandeAdhesion = DemandeAdhesion::findOrFail($id);
       
        $demandeAdhesion->save();
        $cotisations = DemandeCategorieHelper::calculerCotisationMensuelleTotale($demandeAdhesion->nombreAyantsDroits, $demandeAdhesion->statut);
        $mensualite = $cotisations['cotisationTotale'];
        $pdf = Pdf::loadView('pages.frontend.adherents.fiches.cession_volontaire', ['demandeAdhesion' => $demandeAdhesion]);

        $generatedPassword = PasswordHelper::generateSecurePassword();
        $data = [
            'matricule' => $demandeAdhesion->matricule,
            'nip' => $demandeAdhesion->nip,
            'cnib' => $demandeAdhesion->cnib,
            'delivree' => $demandeAdhesion->delivree,
            'expire' => $demandeAdhesion->expire,
            'adresse' => $demandeAdhesion->adresse,
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
            'charge' => $demandeAdhesion->nombreAyantsDroits,

            'ayantsDroits' => $demandeAdhesion->ayantsDroits,
            'categorie' => $demandeAdhesion->categorie,
            'mensualite' => $mensualite,

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
            'demande_id' => $demandeAdhesion->id,
            
            'is_new' => true,

            'is_adherent' => false,


        ];
        $adherent = Adherent::create($data);
        

        $ayantsDroitsArray = json_decode($demandeAdhesion->ayantsDroits, true);
        if ($demandeAdhesion->nombreAyantsDroits > 0) {
            if (is_array($ayantsDroitsArray)) {
                foreach ($ayantsDroitsArray as $index => $ayantDroitData) {
                    $position = $index + 1;
                    AyantDroit::create([
                        'nom' => $ayantDroitData['nom'],
                        'prenom' => $ayantDroitData['prenom'],
                        'sexe' => $ayantDroitData['sexe'],
                        'photo' => !empty($ayantDroitData['photo']) ? $ayantDroitData['photo'] : null,
                        'cnib' => !empty($ayantDroitData['cnib']) ? $ayantDroitData['cnib'] : null,
                        'extrait' => !empty($ayantDroitData['extrait']) ? $ayantDroitData['extrait'] : null,
                        'adherent_id' => $adherent->id ,
    
                        'date_naissance' => $ayantDroitData['date_naissance'],
                        'relation' => $ayantDroitData['relation'],
                        'code' => $adherent->matricule . '/' . str_pad($position, 2, '0', STR_PAD_LEFT), 
                        'position' => $position, 
    
                    ]);
                }
            }
        }

        Mail::to($demandeAdhesion->email)->send(new ConfirmationDemandeAdhesion($demandeAdhesion, $pdf, $generatedPassword));
        session(['demandeAdhesionId' => $demandeAdhesion->id]);
        return redirect()->route('final-demande-adhesion')->with([
            'cotisations' => $cotisations,
            'status' => 'Votre demande d\'adhésion a été envoyée avec succès!'
        ]);
    }

    public function confirmationAdhesion()
    {
        $cotisations = session('cotisations');
        $demandeAdhesion = session('demandeAdhesion');
        return view('pages.frontend.adherents.final-demande-adhesion', compact('cotisations', 'demandeAdhesion'));
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
            'ayantsDroits' => json_decode($demandeAdhesion->ayantsDroits, true),
        ];

        return PDFHelper::downloadPDF('pages.frontend.adherents.fiches.formulaire_adhesion', $data, 'Formulaire_adhesion' . $demandeAdhesion->id);
    }

    public function apropos()
    {
        return view('pages.frontend.apropos.apropos');
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


    public function partenaires()
    {
        $partenaires = Partenaire::all();
        $groupedPartenaires = $partenaires->groupBy('type');

        return view('pages.frontend.partenaires.liste-partenaires', compact('partenaires', 'groupedPartenaires'));
    }

    public function articleDetails($id)
    {

        $article = Article::findOrFail($id);
        $article->increment('views');
        $article->contenu = Purifier::clean($article->contenu);
        $recentArticles = Article::latest()->take(3)->get();
        $previousArticle = Article::where('id', '<', $article->id)->latest()->first();
        $nextArticle = Article::where('id', '>', $article->id)->first();
        
        return view('pages.frontend.articles.details', compact('article', 'recentArticles', 'previousArticle', 'nextArticle'));
    }
}

<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\DemandeCategorieHelper;
use App\Helpers\PasswordHelper;
use App\Http\Controllers\Controller;
use App\Mail\ConfirmationCreationCompte;
use App\Models\Adherent;
use App\Models\AyantDroit;
use App\Models\DemandeAdhesion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use App\Mail\Adherent\FicheCessionVolontaire;

use Barryvdh\DomPDF\Facade\Pdf;


class DemandeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $breadcrumbsItems = [
            [
                'name' => 'Demandes',
                'url' => route('demandes.index'),
                'active' => true
            ],
        ];
        $pageTitle = 'Liste des demandes d\'adhésions';

        $demandesNouveaux = DemandeAdhesion::whereNotNull('email')
            ->where('is_new' , true )
            ->where('etat' , false )

            ->orderBy('created_at', 'desc')
            ->get();

        $demandesAnciens = DemandeAdhesion::whereNotNull('email')
            ->where('is_new' , false )
            ->where('etat' , false )

            ->orderBy('created_at', 'desc')
            ->get();


        return view('pages.backend.demandes.index', compact('demandesAnciens', 'demandesNouveaux', 'breadcrumbsItems', 'pageTitle'));
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
        $message = "Aucun adhérent ne correspond à cette demande.";
        $adherent = null;
        if ($demande->is_new === 0) {
            $adherent = Adherent::where('matricule', $demande->matricule)->first();
            if ($adherent) {
                $message = "Un adhérent correspond.";
            }
        }
        $pageTitle = 'Demande N°'.$demande->id;
        $demande->ayantsDroits = json_decode($demande->ayantsDroits, true);

        return view('pages.backend.demandes.show', compact('demande', 'adherent', 'message', 'breadcrumbsItems', 'pageTitle' ));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        $demande = DemandeAdhesion::findOrFail($id);
        $adherent = Adherent::where('demande_id', $id)->first();
        $breadcrumbsItems = [
            [
                'name' => 'Demandes',
                'url' => route('demandes.index'),
                'active' => false
            ],
            [
                'name' => $demande->nom,
                'url' => route('demandes.index'),
                'active' => true
            ],
        ];

        $pageTitle = 'Modification demande N°'.$demande->id;


        return view('pages.backend.demandes.edit',compact('demande','adherent',  'pageTitle', 'breadcrumbsItems'));
    }

    public function update(Request $request, $id)
    {
        // Récupérer la demande ou renvoyer une erreur 404 si elle n'existe pas
        $demande = DemandeAdhesion::findOrFail($id);

        // Valider les données envoyées dans la requête
        $validatedData = $request->validate([
            'nom' => 'required|string|max:20',
            'prenom' => 'required|string|max:55',
            'matricule' => 'required|string|max:10', // Validation unique avec exception pour l'enregistrement actuel
            'telephone' => 'required|string|max:20|regex:/^(\+?[1-9][0-9]{0,2})?[0-9]{8,10}$/',
            'email' => 'required|email|max:255', // Validation unique avec exception
        ]);

        // Mise à jour des données de la demande
        try {
            $demande->update($validatedData);
            return redirect()->route('demandes.show', $id)->with('success', 'La demande a été mise à jour avec succès.');
        } catch (\Exception $e) {
            // Gestion des erreurs lors de la mise à jour
            return redirect()->back()->withErrors(['error' => 'Une erreur est survenue lors de la mise à jour : ' . $e->getMessage()]);
        }
    }


    public function accept($id)
    {
        try {
            // Vérification de l'existence de la demande
            $demande = DemandeAdhesion::find($id);
            if (!$demande) {
                return redirect()->back()->withErrors(['error' => 'La demande avec l\'ID fourni est introuvable.']);
            }

            // Recherche de l'adhérent lié à la demande
            $adherent = Adherent::where('matricule', $demande->matricule)->first();
            if (!$adherent) {
                return redirect()->back()->withErrors(['error' => 'Aucun adhérent correspondant à cette demande n\'a été trouvé.']);
            }

            // Vérification d'unicité de l'email
            $emailExists = Adherent::where('email', $demande->email)->where('id', '!=', $adherent->id)->exists();
            if ($emailExists) {
                return redirect()->back()->withErrors(['error' => 'L\'e-mail fourni est déjà utilisé par un autre adhérent.']);
            }

            if ($adherent->is_new === 0) {
                $generatedPassword = PasswordHelper::generateSecurePassword();
                $categorie = DemandeCategorieHelper::determineCategorie($adherent->charge);

                // Mise à jour de l'adhérent
                $adherent->password = Hash::make($generatedPassword);
                $adherent->email = $demande->email;
                $adherent->telephone = $demande->telephone;
                $adherent->nombreAyantsDroits = $adherent->charge;
                $adherent->photo = $demande->photo;
                $adherent->categorie = $categorie;
            }

            $adherent->is_adherent = true;
            $adherent->demande_id = $demande->id;
            $adherent->save();

            if ($adherent->is_new === 0) {
                Mail::to($adherent->email)->send(new ConfirmationCreationCompte($adherent->email, $generatedPassword));
            }

            // Mise à jour de l'état de la demande
            $demande->etat = true;
            $demande->save();

            return redirect()->route('demandes.index')->with('success', 'La demande a été acceptée avec succès.');
        } catch (\Exception $e) {
            // Gestion des exceptions générales
            return redirect()->back()->withErrors(['error' => 'Une erreur inattendue s\'est produite : ' . $e->getMessage()]);
        }
    }


    public function destroy($id)
    {
        $demande = DemandeAdhesion::find($id);

        if (!$demande) {
            return redirect()->back()->withErrors(['error' => 'Demande introuvable.']);
        }

        AyantDroit::whereIn('adherent_id', Adherent::where('demande_id', $demande->id)->pluck('id'))->delete();

        Adherent::where('demande_id', $demande->id)->delete();

        $demande->delete();

        return redirect()->route('demandes.index')->with('success', 'La demande a été rejetée avec succès.');
    }


    public function previewForm($id)
    {
        $demandeAdhesion = demandeAdhesion::findOrFail($id);

        $data = [
            'demandeAdhesion' => $demandeAdhesion,
            'logoPath' => public_path('images/logofinal.png'), // Path to your logo image
            'ayantsDroits' => json_decode($demandeAdhesion->ayantsDroits, true),
        ];
        $pdf = Pdf::loadView('pages.frontend.adherents.fiches.formulaire_adhesion', $data);

        $fileName = "Formulaire_adhesion{$id}.pdf";
        $filePath = "temp/{$fileName}";
        Storage::put($filePath, $pdf->output());

        return response()->file(storage_path("app/$filePath"), [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="'.$fileName.'"'
        ]);
    }

    public function previewFiche($id)
    {
        $demandeAdhesion = demandeAdhesion::findOrFail($id);

        $data = [
            'demandeAdhesion' => $demandeAdhesion,
            'logoPath' => public_path('images/logofinal.png'), // Path to your logo image
            'ayantsDroits' => json_decode($demandeAdhesion->ayantsDroits, true),
        ];
        $pdf = Pdf::loadView('pages.frontend.adherents.fiches.cession_volontaire', $data);

        $fileName = "Fiche_cession_volontaire_salaire{$id}.pdf";
        $filePath = "temp/{$fileName}";
        Storage::put($filePath, $pdf->output());

        return response()->file(storage_path("app/$filePath"), [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="'.$fileName.'"'
        ]);
    }

    public function envoiFicheCessionSalaire($id)
    {
        $demandeAdhesion = DemandeAdhesion::findOrFail($id);


        $pdf = Pdf::loadView('pages.frontend.adherents.fiches.cession_volontaire', ['demandeAdhesion' => $demandeAdhesion]);
        Mail::to($demandeAdhesion->email)->send(new FicheCessionVolontaire($demandeAdhesion, $pdf));
        return redirect()->back()->with('success', 'La fiche a été envoyée avec succès.');

    }


}

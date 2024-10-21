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

        Mail::to($demandeAdhesion->email)->send(new ConfirmationDemandeAdhesion($demandeAdhesion, $pdf));

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

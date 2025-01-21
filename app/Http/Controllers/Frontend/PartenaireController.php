<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Partenaire;
use App\Http\Requests\StorePartenaireRequest;
use App\Http\Requests\UpdatePartenaireRequest;
use App\Models\Adherent;
use App\Models\AyantDroit;

use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class PartenaireController extends Controller
{

    public function searchAdherent(Request $request)
{
    $validated = $request->validate([
        'code_carte' => 'required|string',
    ]);

    $pageTitle = 'Recherche';

    // Recherche dans la table adherents
    $adherent = Adherent::where('code_carte', $validated['code_carte'])->first();

    if ($adherent) {
        $dateEnregistrement = Carbon::parse($adherent->date_enregistrement);
        $sixMonthsAgo = now()->subMonths(6);
        if ($dateEnregistrement->greaterThan($sixMonthsAgo)) {
            $message = 'Carte trouvée, mais elle n\'est pas valide (moins de 6 mois).';
            return view('pages.frontend.partenaires.prestations.create', compact('adherent', 'message', 'pageTitle'));
        }

        $message = 'Carte trouvée et valide.';
        return view('pages.frontend.partenaires.prestations.create', compact('adherent', 'message', 'pageTitle'));
    }

    // Recherche dans la table ayant_droits
    $ayantDroit = AyantDroit::where('code', $validated['code_carte'])->first();

    if ($ayantDroit) {
        // Récupérer l'adhérent lié à cet ayant droit
        $adherent = $ayantDroit->adherent;

        if ($adherent) {
            $dateEnregistrement = Carbon::parse($adherent->date_enregistrement);
            $sixMonthsAgo = now()->subMonths(6);
            if ($dateEnregistrement->greaterThan($sixMonthsAgo)) {
                $message = 'Carte trouvée pour l\'ayant droit, mais elle n\'est pas valide (moins de 6 mois).';
                return view('pages.frontend.partenaires.prestations.create', compact('ayantDroit', 'message', 'pageTitle'));
            }

            $message = 'Carte trouvée et valide pour l\'ayant droit.';
            return view('pages.frontend.partenaires.prestations.create', compact('ayantDroit', 'message', 'pageTitle'));
        }

        $message = "Carte trouvée pour l'ayant droit, mais aucun adhérent associé n'a été trouvé.";
        return view('pages.frontend.partenaires.prestations.create', compact('message', 'pageTitle'));
    }

    // Aucun résultat trouvé
    $message = 'Aucun adhérent ou ayant droit trouvé avec ce code carte.';
    return view('pages.frontend.partenaires.prestations.create', compact('message', 'pageTitle'));
}

    
    
    

}

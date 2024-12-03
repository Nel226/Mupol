<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Partenaire;
use App\Http\Requests\StorePartenaireRequest;
use App\Http\Requests\UpdatePartenaireRequest;
use App\Models\Adherent;
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
    
        $adherent = Adherent::where('code_carte', $validated['code_carte'])->first();
        $pageTitle = 'Recherche';
    
        if ($adherent) {
            $dateEnregistrement = Carbon::parse($adherent->date_enregistrement);
            $sixMonthsAgo = now()->subMonths(6);
            if ($dateEnregistrement->greaterThan($sixMonthsAgo)) {
                $message = 'Trouvé mais pas valide.';
                return view('pages.frontend.partenaires.prestations.create', compact('message', 'pageTitle'));
            }
    
            return view('pages.frontend.partenaires.prestations.create', compact('adherent', 'pageTitle'));
        } else {
            $message = 'Aucun adhérent trouvé avec ce code carte.';
            return view('pages.frontend.partenaires.prestations.create', compact('message', 'pageTitle'));
        }
    }
    
    

}

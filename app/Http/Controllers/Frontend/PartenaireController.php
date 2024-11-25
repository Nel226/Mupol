<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Partenaire;
use App\Http\Requests\StorePartenaireRequest;
use App\Http\Requests\UpdatePartenaireRequest;
use App\Models\Adherent;
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
        $adherent->ayantsDroits = json_decode($adherent->ayantsDroits, true); 

        if ($adherent) {
            return view('pages.frontend.partenaires.prestations.create', compact('adherent'));
        } else {
            $message = 'Aucun adhérent trouvé avec ce code carte.';
            return view('pages.frontend.partenaires.prestations.create', compact('message'));
        }
    }
    

}

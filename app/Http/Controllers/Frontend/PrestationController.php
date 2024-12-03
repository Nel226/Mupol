<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

use App\Models\Prestation;
use App\Http\Requests\StorePrestationRequest;
use App\Http\Requests\UpdatePrestationRequest;
use App\Models\AyantDroit;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Str;

class PrestationController extends Controller
{
    // Frontend

    public function prestations()
    {
        $adherent = auth()->guard('adherent')->user();
        
        $prestations = $adherent->prestations;
        $pageTitle = 'Liste des demandes';
        return  view('pages.frontend.adherents.prestations.index',
                compact('adherent', 'prestations', 'pageTitle')
        );
    }

    public function prestationsPartenaire()
    {
        $partenaire = auth()->guard('partenaire')->user();
        $prestations = $partenaire->prestations;
        return  view('pages.frontend.partenaires.prestations.index',
                compact('partenaire', 'prestations')
        );
    }
   
    

    public function newPrestationAdherent()
    {
        $adherent = auth()->guard('adherent')->user();
        $adherent->ayantsDroits = AyantDroit::where('adherent_id', $adherent->id)->get();
        $pageTitle = 'Remboursements';

    
        return view('pages.frontend.adherents.prestations.create', compact('adherent', 'pageTitle'));
    }
    public function newPrestationPartenaire()
    {
        $partenaire = auth()->guard('partenaire')->user();
        $pageTitle ='Recherche';
    
        return view('pages.frontend.partenaires.prestations.create', compact('partenaire', 'pageTitle'));
    }
    public function storePrestationAdherent(StorePrestationRequest $request)
    {
        $data = $request->all();
        $adherentCode = $request->adherentCode;
        $totalMontant = Prestation::where('adherentCode', $adherentCode)->sum('montant');
        $types = ['consultation', 'hospitalisation', 'radio', 'maternite', 'allocation', 'analyse_biomedicale', 'pharmacie', 'optique', 'dentaire_auditif', 'autre'];
        $prestationsToSave = [];

        foreach ($types as $type) {
          
            for ($i = 0; $i <= 20; $i++) { 
                $typeSuffix = $i > 0 ? "-$i" : ''; 
                if (!empty($data["date_$type$typeSuffix"]) && !empty($data["centre_$type$typeSuffix"]) && !empty($data["montant_$type$typeSuffix"])) {

                    $prestationsToSave[] = [
                        'adherentCode' => $data['adherentCode'],
                        'adherentNom' => $data['adherentNom'],
                        'adherentPrenom' => $data['adherentPrenom'],
                        'adherentSexe' => $data['adherentSexe'],
                        'beneficiaire' => $data['beneficiaire'],
                        'idPrestation' => Uuid::uuid4()->toString(),
                        'contactPrestation' => $data['contactPrestation'],
                        'acte' => $data["acte$typeSuffix"],
                        'date' => $data["date_$type$typeSuffix"],
                        'centre' => $data["centre_$type$typeSuffix"],
                        'montant' => $data["montant_$type$typeSuffix"],
                        'type' => $data["type_$type$typeSuffix"] ?? null,
                        'sous_type' => $data["sous_type_$type$typeSuffix"] ?? null,
                        'validite' => 'en attente',
                        'etat_paiement' => false,
                    ];
                }
            }
        }

        if (empty($prestationsToSave)) {
            return back()->withErrors(['message' => 'Veuillez remplir tous les champs obligatoires pour chaque prestation visible.']);
        }
        

        foreach ($prestationsToSave as $prestationData) {
            $montant = $prestationData['montant'];
            if ($totalMontant + $montant > 1500000) {
                return back()->withErrors(['error' => 'Erreur : La somme totale des prestations de cet adhérent dépasse 1 500 000.']);
            }

            $prestation = new Prestation($prestationData);
            
            // if ($request->hasFile('preuve')) {
            //     foreach ($request->file('preuve') as $file) {
            //         $path = $file->store('preuves', 'public'); 
            //         $prestation->preuve = json_encode([$path]); 
            //     }
            // }
            if ($request->hasFile('preuve')) {
                $files = [];
                foreach ($request->file('preuve') as $file) {
                    $path = $file->store('preuves', 'public');
                    $files[] = $path; 
                }
                $prestation->preuve = json_encode($files); 
            }
            

            $prestation->save(); 
        }

        $adherent = auth()->guard('adherent')->user();
        
        $adherent->ayantsDroits = json_decode($adherent->ayantsDroits, true); 

        return redirect()->route('adherents.prestations')->with('success', 'Enregistrement réussi');

    }
    
}
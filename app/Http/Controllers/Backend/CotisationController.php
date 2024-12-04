<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;

use App\Models\Adherent;
use App\Models\Prestation;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CotisationController extends Controller
{
    public function index(Request $request)
    {
        $breadcrumbsItems = [
            [
                'name' => 'Cotisations',
                'url' => route('cotisations.index'),
                'active' => true
            ],
        ];

        $pageTitle = 'Gestion des cotisations';

        $sumTotalMensualites = 0;
        $sumTotalCotisations = 0;
        $sumTotalAdhesions = 0;
        $sumTotalPrestations = 0;
    
        $prestationsCostsByAct = [
            'consultation' => 0,
            'hospitalisation' => 0,
            'radio' => 0,
            'maternite' => 0,
            'allocation' => 0,
            'analyse_biomedicale' => 0,
            'pharmacie' => 0,
            'optique' => 0,
            'dentaire_auditif' => 0,
            'autre' => 0,
        ];
    
        $years = Prestation::selectRaw('YEAR(date) as year')->distinct()->pluck('year');
    
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
    
        $adherents = Adherent::whereBetween('date_enregistrement', [$startDate, $endDate])->get();
        $prestations = Prestation::whereBetween('date', [$startDate, $endDate])->get();
    
        foreach ($adherents as $adherent) {
            $adherent->months_since_joining = $this->calculateMonthsSinceJoining($adherent->date_enregistrement);
            $adherent->total_mensualites = $this->totalMensualites($adherent->date_enregistrement, $adherent->mensualite);
            $adherent->total_cotisations = (float)$adherent->adhesion + (float)$this->totalMensualites($adherent->date_enregistrement, $adherent->mensualite);
            $sumTotalMensualites += $adherent->total_mensualites;
            $sumTotalCotisations += $adherent->total_cotisations;
            $sumTotalAdhesions += (float)$adherent->adhesion;
        }
    
        foreach ($prestations as $prestation) {
            $sumTotalPrestations += $prestation->montant * 80 / 100;
    
            $typeActe = $prestation->acte;
            if (isset($prestationsCostsByAct[$typeActe])) {
                $prestationsCostsByAct[$typeActe] += $prestation->montant * 80 / 100;
            }
        }
    
        return view('pages.backend.cotisations.index', compact(
            'adherents',
            'prestations',
            'prestationsCostsByAct',
            'sumTotalMensualites',
            'sumTotalCotisations',
            'sumTotalAdhesions',
            'sumTotalPrestations',
            'years',
            'startDate',
            'endDate',
            'breadcrumbsItems',
            'pageTitle'
        ));
    }
    
    

    private function totalMensualites($date_enregistrement, $mensualite)
    {
        $monthsSinceJoining = $this->calculateMonthsSinceJoining($date_enregistrement);
        return $monthsSinceJoining * $mensualite;
    }
    private function calculateMonthsSinceJoining($date_enregistrement)
    {
        $now = Carbon::now();
        $date_enregistrement = Carbon::parse($date_enregistrement);

        return $date_enregistrement->diffInMonths($now);
    }
}

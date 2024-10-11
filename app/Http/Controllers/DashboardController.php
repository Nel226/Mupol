<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Adherant;
use App\Models\AyantDroit;
use App\Models\Prestation;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        
        $adherentsCount = Adherant::count();
        $ayantsDroitCount = AyantDroit::count();
        $mutualistesCount = $adherentsCount + $ayantsDroitCount;
        $adherants = Adherant::all();
        $pourcentageValidatedPrestationsCount = 0;
        $pourcentageInvalidatedPrestationsCount = 0;
        $newAdherantsCount = $this->getNewAdherantsThisWeek();

        $totalPrestationsCount = Prestation::count();
        $validatedPrestationsCount = Prestation::where('etat_paiement', 1)->count();
        $invalidatedPrestationsCount = Prestation::where('etat_paiement', 0)->count();
        if ($totalPrestationsCount>0) {
            $pourcentageValidatedPrestationsCount = round(($validatedPrestationsCount*100)/$totalPrestationsCount);
            $pourcentageInvalidatedPrestationsCount = round(($invalidatedPrestationsCount*100)/$totalPrestationsCount);
        }
        $prestationsEnAttenteValidation = Prestation::where('validite', "en attente")
        ->orderBy('created_at', 'desc') 
        ->limit(10) 
        ->get();

        $nombrePrestationsNonValidees = Prestation::where('validite', 'en attente')->count();
        $nombrePrestationsValidees = Prestation::where('validite', 'accepté')->count();

        $prestationsEnAttente = Prestation::where('etat_paiement', 0)
        ->orderBy('created_at', 'desc') 
        ->limit(4) 
        ->get();

        $sumTotalMensualites = 0;
        $sumTotalCotisations = 0;
        $sumTotalAdhesions = 0;
        $sumTotalPrestations = 0;

        $adherants = Adherant::all();
        $prestations = Prestation::all();
        foreach ($adherants as $adherant) {
            $adherant->months_since_joining = $this->calculateMonthsSinceJoining($adherant->date_enregistrement);
            $adherant->total_mensualites = $this->totalMensualites($adherant->date_enregistrement, $adherant->mensualite);
            $adherant->total_cotisations = (float)$adherant->adhesion + (float)$this->totalMensualites($adherant->date_enregistrement, $adherant->mensualite);
            $sumTotalMensualites += $adherant->total_mensualites;
            $sumTotalCotisations += $adherant->total_cotisations;
            $sumTotalAdhesions += (float)$adherant->adhesion;
        }
        foreach ($prestations as $prestation) {
            
            $sumTotalPrestations += $prestation->montant*80/100;
        }
        $monthlyPayments = DB::table('prestations')
        ->select(DB::raw('SUM(montant) as total'), DB::raw('MONTH(created_at) as month'))
        ->where('etat_paiement', 1)
        ->groupBy(DB::raw('MONTH(created_at)'))
        ->pluck('total', 'month')->toArray();

        $monthlyPaymentsData = [];
        for ($i = 1; $i <= 12; $i++) {
            $monthlyPaymentsData[$i] = $monthlyPayments[$i] ?? 0;
        }
        $adherantsPerWeek = Adherant::selectRaw('WEEK(created_at) as week, COUNT(*) as count')
            ->where('created_at', '>=', Carbon::now()->subWeeks(8))
            ->groupBy('week')
            ->orderBy('week', 'asc')
            ->get();

        $weeks = [];
        $counts = [];
        
        foreach ($adherantsPerWeek as $data) {
            $weeks[] = "Semaine " . $data->week;
            $counts[] = $data->count;
        }

        $currentDateTime = Carbon::now();
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
        foreach ($prestations as $prestation) {
            $sumTotalPrestations += $prestation->montant * 80 / 100;
    
            $typeActe = $prestation->acte;
            if (isset($prestationsCostsByAct[$typeActe])) {
                $prestationsCostsByAct[$typeActe] += $prestation->montant * 80 / 100;
            }
        }
            
        return view('pages.backend.dashboard', compact('monthlyPaymentsData', 
                                        'monthlyPayments' ,
                                        'pourcentageInvalidatedPrestationsCount', 
                                        'pourcentageValidatedPrestationsCount', 
                                        'sumTotalCotisations', 'sumTotalPrestations', 
                                        'sumTotalMensualites', 
                                        'sumTotalAdhesions', 
                                        'adherentsCount',
                                        'mutualistesCount',
                                        'validatedPrestationsCount', 
                                        'invalidatedPrestationsCount', 
                                        'prestationsEnAttente',
                                        'ayantsDroitCount',
                                        'newAdherantsCount',
                                        'adherantsPerWeek',
                                        'weeks',
                                        'counts',
                                        'prestationsEnAttenteValidation',
                                        'nombrePrestationsNonValidees',
                                        'nombrePrestationsValidees',
                                        'prestationsCostsByAct',
                                        'currentDateTime'
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

    public function getNewAdherantsThisWeek()
    {
        // Détermine le début et la fin de la semaine en cours
        $startOfWeek = Carbon::now()->startOfWeek(); 
        $endOfWeek = Carbon::now()->endOfWeek();     

        // Récupère les adhérents créés pendant cette période
        $adherants = Adherant::whereBetween('created_at', [$startOfWeek, $endOfWeek])->get();

        // Compte le nombre d'adhérents
        $count = $adherants->count();

        return $count;
    }
}

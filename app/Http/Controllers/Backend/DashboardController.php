<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Adherent;
use App\Models\AyantDroit;
use App\Models\Prestation;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        
        $adherentsCount = Adherent::count();
        $ayantsDroitCount = AyantDroit::count();
        $mutualistesCount = $adherentsCount + $ayantsDroitCount;
        $adherents = Adherent::all();
        $pourcentageValidatedPrestationsCount = 0;
        $pourcentageInvalidatedPrestationsCount = 0;
        $newAdherentsCount = $this->getNewAdherentsThisWeek();

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

        $adherents = Adherent::all();
        $prestations = Prestation::all();
        foreach ($adherents as $adherent) {
            $adherent->months_since_joining = $this->calculateMonthsSinceJoining($adherent->date_enregistrement);
            $adherent->total_mensualites = $this->totalMensualites($adherent->date_enregistrement, $adherent->mensualite);
            $adherent->total_cotisations = (float)$adherent->adhesion + (float)$this->totalMensualites($adherent->date_enregistrement, $adherent->mensualite);
            $sumTotalMensualites += $adherent->total_mensualites;
            $sumTotalCotisations += $adherent->total_cotisations;
            $sumTotalAdhesions += (float)$adherent->adhesion;
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
        $adherentsPerWeek = Adherent::selectRaw('WEEK(created_at) as week, COUNT(*) as count')
            ->where('created_at', '>=', Carbon::now()->subWeeks(8))
            ->groupBy('week')
            ->orderBy('week', 'asc')
            ->get();

        $weeks = [];
        $counts = [];
        
        foreach ($adherentsPerWeek as $data) {
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
                                        'newAdherentsCount',
                                        'adherentsPerWeek',
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

    public function getNewAdherentsThisWeek()
    {
        // Détermine le début et la fin de la semaine en cours
        $startOfWeek = Carbon::now()->startOfWeek(); 
        $endOfWeek = Carbon::now()->endOfWeek();     

        // Récupère les adhérents créés pendant cette période
        $adherents = Adherent::whereBetween('created_at', [$startOfWeek, $endOfWeek])->get();

        // Compte le nombre d'adhérents
        $count = $adherents->count();

        return $count;
    }
}

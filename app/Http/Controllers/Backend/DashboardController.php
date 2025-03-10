<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Adherent;
use App\Models\AyantDroit;
use App\Models\Prestation;
use App\Models\User;
use App\Models\Article;

use Carbon\Carbon;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Redis;

class DashboardController extends Controller
{
    public function index( Request $request )
    {
        
        $adherentsCount1 = Adherent::count();
        $ayantsDroitCount1 = AyantDroit::count();
        $mutualistesCount = $adherentsCount1 + $ayantsDroitCount1;
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
        $selectedYear = $request->input('year', Carbon::now()->year);

        // Comptabiliser les mutualistes par mois pour l'année sélectionnée
        $mutualistesParMois = DB::table('adherents')
            ->select(DB::raw('MONTH(date_enregistrement) as month, COUNT(*) as count'))
            ->whereYear('date_enregistrement', $selectedYear)
            ->groupBy(DB::raw('MONTH(date_enregistrement)'))
            ->get();

        
        $ayantsDroitParMois = DB::table('ayant_droits')
            ->join('adherents', 'ayant_droits.adherent_id', '=', 'adherents.id')
            ->select(DB::raw('MONTH(adherents.date_enregistrement) as month, COUNT(ayant_droits.id) as count'))
            ->whereYear('adherents.date_enregistrement', $selectedYear)
            ->groupBy(DB::raw('MONTH(adherents.date_enregistrement)'))
            ->get();

        // Fusionner les adhérents et ayants droit par mois
        $evolutionMutualistes = [];
        for ($i = 1; $i <= 12; $i++) {
            $adherentsCount = $mutualistesParMois->firstWhere('month', $i)->count ?? 0;
            $ayantsDroitCount = $ayantsDroitParMois->firstWhere('month', $i)->count ?? 0;

            $evolutionMutualistes[$i] = $adherentsCount + $ayantsDroitCount;
        }
        //admin
        $totalUsers = User::count();
        $totalRoles = Role::count();
        $recentUsers = User::latest()->take(5)->get();
        $totalArticles = Article::count();

        $roles = Role::withCount('users')->get();

        $monthlyViews = DB::table('articles')
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('SUM(views) as total_views'))
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->pluck('total_views', 'month')->toArray();

        // Initialiser les données pour tous les mois (pour éviter les valeurs nulles)
        $monthlyViewsData = [];
        for ($i = 1; $i <= 12; $i++) {
            $monthlyViewsData[$i] = $monthlyViews[$i] ?? 0;
        }
        
        return view('pages.backend.dashboard', compact('monthlyPaymentsData', 
                                        'monthlyPayments' ,
                                        'monthlyViewsData', 
                                        'totalArticles',
                                        'pourcentageInvalidatedPrestationsCount', 
                                        'pourcentageValidatedPrestationsCount', 
                                        'sumTotalCotisations', 'sumTotalPrestations', 
                                        'sumTotalMensualites', 
                                        'sumTotalAdhesions', 
                                        'adherentsCount',
                                        'adherentsCount1',

                                        'mutualistesCount',
                                        'validatedPrestationsCount', 
                                        'invalidatedPrestationsCount', 
                                        'prestationsEnAttente',
                                        'ayantsDroitCount',
                                        'ayantsDroitCount1',

                                        'newAdherentsCount',
                                        'adherentsPerWeek',
                                        'weeks',
                                        'counts',
                                        'prestationsEnAttenteValidation',
                                        'nombrePrestationsNonValidees',
                                        'nombrePrestationsValidees',
                                        'prestationsCostsByAct',
                                        'currentDateTime',
                                        'selectedYear',
                                        'evolutionMutualistes',
                                        'totalUsers', 'totalRoles', 
                                        'roles', 'recentUsers',
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

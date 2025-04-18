<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;


use App\Helpers\PDFHelper;
use App\Models\Prestation;
use App\Http\Requests\StorePrestationRequest;
use App\Http\Requests\UpdatePrestationRequest;
use App\Models\Adherent;
use App\Models\AyantDroit;
use App\Models\Categorie;
use App\Models\Depense;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Pagination\LengthAwarePaginator;


class PrestationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        $adherents = Adherent::all();
        $ayantsDroit = AyantDroit::all();

        // Date limite pour l'adhésion (6 mois en arrière)
        $sixMonthsAgo = Carbon::now()->subMonths(6);


        $adherentsValides = Adherent::where('date_enregistrement', '<=', $sixMonthsAgo)->get();

        $ayantsDroitValides = AyantDroit::whereIn('adherent_id', $adherentsValides->pluck('id'))->get();

        $prestations = Prestation::orderBy('created_at', 'desc')->get();
        $prestationsValides = Prestation::where('validite', 'accepté')->get();
        $pageTitle = 'Liste des prestations';
        $breadcrumbsItems = [
            [
                'name' => 'Prestations',
                'url' => route('prestations.index'),
                'active' => true
            ],
        ];
        return view('pages.backend.prestations.index', compact('adherents', 'ayantsDroit', 'prestations', 'prestationsValides', 'adherentsValides', 'ayantsDroitValides', 'pageTitle', 'breadcrumbsItems'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $adherents = Adherent::all();
        $ayantsDroit = AyantDroit::all();

        // Date limite pour l'adhésion (6 mois en arrière)
        $sixMonthsAgo = Carbon::now()->subMonths(6);


        $adherentsValides = Adherent::all();




        $ayantsDroitValides = AyantDroit::whereIn('adherent_id', $adherentsValides->pluck('id'))->get();

        $prestations = Prestation::all();
        $prestationsValides = Prestation::where('validite', 'accepté')->get();
        $pageTitle = 'Nouvelle prestation';

        return view('pages.backend.prestations.create', compact('adherents', 'ayantsDroit', 'prestations', 'prestationsValides', 'adherentsValides', 'ayantsDroitValides', 'pageTitle'));

    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(StorePrestationRequest $request)
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
                        'idPrestation' => $data['idPrestation'],
                        'contactPrestation' => $data['contactPrestation'],
                        'acte' => $data["acte"], // Modifie
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
                    $path = $file->store("preuves/{$adherentCode}", 'public');

                    $files[] = $path;
                }
                $prestation->preuve = json_encode($files);
            }


            $prestation->save();
        }

        return redirect()->route('prestations.index')->with('success', 'Enregistrement réussi');
    }



    /**
     * Display the specified resource.
     */
    public function show(Prestation $prestation)
    {
        if (!empty($prestation->preuve)) {
            $prestation->preuve = json_decode($prestation->preuve, true) ?? [];
        } else {
            $prestation->preuve = [];
        }

        $montantModerateur = (($prestation->montant*20)/100);
        $montantMutuelle = (($prestation->montant*80)/100);

        return view('pages.backend.prestations.show',compact('prestation', 'montantModerateur', 'montantMutuelle'));

    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Prestation $prestation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePrestationRequest $request, Prestation $prestation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Prestation $prestation)
    {
        //
    }

    public function valider($id)
    {
        $prestation = Prestation::findOrFail($id);
        $prestation->validite = 'accepté';

        $prestation->save();

        return redirect()->route('prestations.index')->with('success', 'La prestation a été validée avec succès.');
    }
    public function rejeter($id)
    {
        $prestation = Prestation::findOrFail($id);
        $prestation->validite = 'rejeté'; // Vous pouvez définir 'rejeté', 'en attente', etc., selon vos besoins

        $prestation->save();

        return redirect()->route('prestations.index')->with('success', 'La prestation a été rejetée.');
    }

    public function validerPaiement($id)
    {
        $prestation = Prestation::findOrFail($id);
        $prestation->etat_paiement = 1;
        $prestation->save();

        $categorie = Categorie::where('nom', 'Prestations et dépenses de personnels')->first();
        $sousCategorie = Categorie::where('nom', 'Couverture des risques maladies ou accidents')->first();

        Depense::create([
            'uuid' => (string) Str::uuid(),
            'montant' => $prestation->montant,
            'description' => 'Dépense pour prestation' ,
            'categorie_id' => $categorie->uuid,
            'sous_categorie_id' => $sousCategorie->uuid,
            'date' => $prestation->created_at->format('Y-m-d')
        ]);

        return redirect()->route('prestations.index')->with('success', 'Le paiement a été validé avec succès.');
    }

    public function ImageToDataUrl(String $filename): String
    {
        if (!file_exists($filename)) {
            throw new Exception('File not found.');
        }

        $mime = mime_content_type($filename);
        if ($mime === false) {
            throw new Exception('Illegal MIME type.');
        }

        $raw_data = file_get_contents($filename);
        if (empty($raw_data)) {
            throw new Exception('File not readable or empty.');
        }

        return "data:{$mime};base64," . base64_encode($raw_data);
    }

    public function downloadReceipt($id)
    {
        $prestation = Prestation::findOrFail($id);

        $data = [
            'prestation' => $prestation,
            'logoPath' => public_path('images/logofinal.png'),
        ];
        return PDFHelper::downloadPDF('pages.backend.prestations.prestation', $data, 'Recu_paiement_' . $prestation->id);
    }

    public function suiviTous(Request $request)
    {
        $pageTitle = 'Prestations par adhérents';
        $currentYear = $request->input('year', Carbon::now()->year);
        $centre = $request->input('centre');
        $search = $request->input('search');

        // Prestations des adhérents
        $prestationsAdherents = Prestation::join('adherents', 'prestations.adherentCode', '=', 'adherents.code_carte')
            ->whereYear('prestations.created_at', $currentYear)
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('adherents.nom', 'like', "%$search%")
                        ->orWhere('adherents.prenom', 'like', "%$search%")
                        ->orWhere('adherents.code_carte', 'like', "%$search%");
                });
            })
            ->when($centre, function ($query, $centre) {
                $query->where('prestations.centre', $centre);
            })
            ->select('prestations.*', 'adherents.id as adherent_id')
            ->get();

        // Prestations des ayants droit
        $prestationsAyantsDroit = Prestation::join('ayant_droits', 'prestations.adherentCode', '=', 'ayant_droits.code')
            ->join('adherents', 'ayant_droits.adherent_id', '=', 'adherents.id')
            ->whereYear('prestations.created_at', $currentYear)
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('adherents.nom', 'like', "%$search%")
                        ->orWhere('adherents.prenom', 'like', "%$search%")
                        ->orWhere('adherents.code_carte', 'like', "%$search%");
                });
            })
            ->when($centre, function ($query, $centre) {
                $query->where('prestations.centre', $centre);
            })
            ->select('prestations.*', 'adherents.id as adherent_id')
            ->distinct()
            ->get();

        // Fusion, tri et regroupement
        $prestationsAll = $prestationsAdherents
            ->merge($prestationsAyantsDroit)
            ->sortByDesc('created_at');

        $prestationsGroupedByAdherent = $prestationsAll->groupBy('adherent_id');

        // Pagination manuelle
        $adherentIds = $prestationsGroupedByAdherent->keys();
        $page = $request->input('page', 1);
        $perPage = 5;
        $offset = ($page - 1) * $perPage;

        $paginatedAdherentIds = $adherentIds->slice($offset, $perPage);
        $paginatedGrouped = collect();

        foreach ($paginatedAdherentIds as $adherentId) {
            $paginatedGrouped[$adherentId] = $prestationsGroupedByAdherent[$adherentId];
        }

        $paginatedPrestations = new LengthAwarePaginator(
            $paginatedGrouped,
            $adherentIds->count(),
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        // Récupération des centres distincts pour le filtre
        $centresDisponibles = Prestation::select('centre')
            ->distinct()
            ->orderBy('centre')
            ->pluck('centre');

        // Statistiques pour le centre sélectionné
        $nombreAdherentsCentre = null;
        $nombrePrestationsCentre = null;

        if ($centre) {
            $nombreAdherentsCentre = $prestationsAll->pluck('adherent_id')->unique()->count();
            $nombrePrestationsCentre = $prestationsAll->count();
        }

        // Vue AJAX ou complète
        $view = view('pages.backend.prestations.suivi.suivi-all', compact(
            'pageTitle',
            'paginatedPrestations',
            'currentYear',
            'centre',
            'centresDisponibles',
            'nombreAdherentsCentre',
            'nombrePrestationsCentre'
        ));

        return $request->ajax() ? response()->view('pages.backend.prestations.suivi.suivi-all', $view->getData()) : $view;
    }

    public function suivi(Request $request)
    {
        $pageTitle = 'Suivi des prestations';

        $currentYear = $request->input('year', Carbon::now()->year);
        $adherentCodes = Adherent::pluck('code_carte')->toArray();
        $prestationsAdherents = Prestation::join('adherents', 'prestations.adherentCode', '=', 'adherents.code_carte')
            ->whereYear('prestations.created_at', $currentYear)
            ->select('prestations.*', 'adherents.id as adherent_id')
            ->get();

        $prestationsAyantsDroit = Prestation::join('ayant_droits', 'prestations.adherentCode', '=', 'ayant_droits.code')
            ->join('adherents', 'ayant_droits.adherent_id', '=', 'adherents.id')
            ->whereYear('prestations.created_at', $currentYear)
            ->select('prestations.*', 'adherents.id as adherent_id')
            ->distinct()
            ->get();



        $prestationsAll = $prestationsAdherents->merge($prestationsAyantsDroit);


        $prestationsGroupedByAdherent = $prestationsAll->groupBy('adherent_id');

        $adherents = Adherent::whereYear('date_enregistrement', $currentYear)->get();
        $ayantsDroit = AyantDroit::join('adherents', 'ayant_droits.adherent_id', '=', 'adherents.id')
            ->whereYear('adherents.date_enregistrement', $currentYear)
            ->select('ayant_droits.*')
            ->get();
        $prestations = Prestation::whereYear('created_at', $currentYear)->get();
        $categories = [
            'Nombre de nouveaux bénéficiaires',
            'Nombre de bénéficiaires (A)',
            'Nombre moyen de bénéficiaire (A1)',
            'Nombre d’hospitalisation (B)',
            'Nombre d’hospitalisation Cumulée (B1)',
            'Taux d’utilisation mensuel % C (C)',
            'Taux d’utilisation cumulée %(D)',
            'Coût total des hospitalisations (E)',
            'Coût Cumulé total des hospitalisations (E1)',
            'Coût moyen mensuel d’une hospitalisation (F)',
            'Coût moyen cumulé d’une hospitalisation (G)'
        ];

        $months = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];

        $data = [];
        $hospitalisationsCumulative = 0;
        $coutCumulative = 0;
        $beneficiairesCumulative = 0;
        $totalCoutCumulative = 0;

        foreach ($categories as $category) {
            foreach ($months as $month) {
                $data[$category][$month] = 0;
            }
            $data[$category]['Total'] = 0;
            $data[$category]['Moyenne'] = 0;
            $data[$category]['Référence'] = '';
        }

        // Nombre de bénéficiaires (adhérents + ayants droit)
        foreach ($adherents as $adherent) {
            $date = Carbon::parse($adherent->date_enregistrement);
            $month = $months[$date->month - 1];

            $data['Nombre de nouveaux bénéficiaires'][$month]++;
            $data['Nombre de nouveaux bénéficiaires']['Total']++;

            $data['Nombre de bénéficiaires (A)'][$month]++;
            $data['Nombre de bénéficiaires (A)']['Total']++;
        }

        foreach ($ayantsDroit as $ayantDroit) {
            $date = Carbon::parse($ayantDroit->adherent->date_enregistrement);
            $month = $months[$date->month - 1];

            // Nombre de bénéficiaires (A) par mois
            $data['Nombre de nouveaux bénéficiaires'][$month]++;
            $data['Nombre de nouveaux bénéficiaires']['Total']++;

            $data['Nombre de bénéficiaires (A)'][$month]++;
            $data['Nombre de bénéficiaires (A)']['Total']++;
        }

        // Calcul du cumul des bénéficiaires pour chaque mois
        foreach ($months as $index => $month) {
            $beneficiairesCumulative += $data['Nombre de bénéficiaires (A)'][$month];
            $data['Nombre de bénéficiaires (A)'][$month] = $beneficiairesCumulative;

            // Calculer A1 = A / nombre de mois déjà écoulés
            $data['Nombre moyen de bénéficiaire (A1)'][$month] = floor($beneficiairesCumulative / ($index + 1));
            $data['Nombre moyen de bénéficiaire (A1)']['Total'] = $data['Nombre moyen de bénéficiaire (A1)'][$month];
        }

        // Calculer les statistiques à pfartir des prestations
        foreach ($prestations as $prestation) {
            $date = Carbon::parse($prestation->created_at);
            $month = $months[$date->month - 1];

            // Nombre d’hospitalisations (B)
            if ($prestation->acte == 'hospitalisation') {
                $data['Nombre d’hospitalisation (B)'][$month]++;
                $data['Nombre d’hospitalisation (B)']['Total']++;

                // Cumul des hospitalisations (B1)
                $hospitalisationsCumulative++;
                $data['Nombre d’hospitalisation Cumulée (B1)'][$month] = $hospitalisationsCumulative;
                $data['Nombre d’hospitalisation Cumulée (B1)']['Total'] = $hospitalisationsCumulative;

                // Coût total des hospitalisations (E)
                if (!isset($data['Coût total des hospitalisations (E)'][$month])) {
                    $data['Coût total des hospitalisations (E)'][$month] = 0;
                }
                $data['Coût total des hospitalisations (E)'][$month] += $prestation->montant;
                $data['Coût total des hospitalisations (E)']['Total'] += $prestation->montant;


            }
        }

        // Calculer le cumul par mois pour B1
        foreach ($months as $index => $month) {
            if ($index > 0) {
                $data['Nombre d’hospitalisation Cumulée (B1)'][$month] = $data['Nombre d’hospitalisation Cumulée (B1)'][$months[$index - 1]] + $data['Nombre d’hospitalisation (B)'][$month];
            }

            // Cumul du coût total des hospitalisations (E1)
            if ($index > 0) {
                $data['Coût Cumulé total des hospitalisations (E1)'][$month] = $data['Coût Cumulé total des hospitalisations (E1)'][$months[$index - 1]] + $data['Coût total des hospitalisations (E)'][$month];
            } else {
                $data['Coût Cumulé total des hospitalisations (E1)'][$month] = $data['Coût total des hospitalisations (E)'][$month];
            }
            $data['Coût Cumulé total des hospitalisations (E1)']['Total'] = $data['Coût Cumulé total des hospitalisations (E1)'][$month] ;

            // Coût moyen cumulé d’une hospitalisation (G)
            if ($data['Nombre d’hospitalisation Cumulée (B1)'][$month] > 0) {
                $data['Coût moyen cumulé d’une hospitalisation (G)'][$month] = number_format((float)$data['Coût Cumulé total des hospitalisations (E1)'][$month] / $data['Nombre d’hospitalisation Cumulée (B1)'][$month], 2, ',', ' ');
            }
        }
        if ($data['Nombre d’hospitalisation Cumulée (B1)']['Total'] > 0) {
            $data['Coût moyen cumulé d’une hospitalisation (G)']['Total'] = number_format((float)$data['Coût Cumulé total des hospitalisations (E1)']['Total']  / $data['Nombre d’hospitalisation Cumulée (B1)']['Total'], 2, ',', ' ');
        } else {
            $data['Coût moyen cumulé d’une hospitalisation (G)']['Total'] = 0;
        }

        // Calcul des moyennes et taux d'utilisation
        foreach ($months as $index => $month) {
            $previousMonths = $index + 1;

            // Taux d’utilisation mensuel % (C)
            if ($data['Nombre de bénéficiaires (A)'][$month] > 0) {

                $data['Taux d’utilisation mensuel % C (C)'][$month] = number_format(($data['Nombre d’hospitalisation (B)'][$month] / $data['Nombre de bénéficiaires (A)'][$month])*$previousMonths * 100, 2);
            }
            if ($beneficiairesCumulative > 0) {
                $data['Taux d’utilisation mensuel % C (C)']['Total'] = number_format(($hospitalisationsCumulative / $beneficiairesCumulative)*12 * 100, 2);
            } else {
                $data['Taux d’utilisation mensuel % C (C)']['Total'] = 0;
            }
            // Taux d’utilisation cumulée % (D)
            if ($data['Nombre moyen de bénéficiaire (A1)'][$month] > 0) {
                $data['Taux d’utilisation cumulée %(D)'][$month] = number_format(($data['Nombre d’hospitalisation Cumulée (B1)'][$month] / $data['Nombre moyen de bénéficiaire (A1)'][$month])*$previousMonths * 100, 2);

            }
            if ($data['Nombre moyen de bénéficiaire (A1)']['Total'] > 0) {
                $data['Taux d’utilisation cumulée %(D)']['Total'] = number_format(($hospitalisationsCumulative / $data['Nombre moyen de bénéficiaire (A1)']['Total'])*12 * 100, 2);
            } else {
                $data['Taux d’utilisation cumulée %(D)']['Total'] = 0;
            }

            // Coût moyen mensuel d’une hospitalisation (F)
            if ($data['Nombre d’hospitalisation (B)'][$month] > 0) {
            $data['Coût moyen mensuel d’une hospitalisation (F)'][$month] = number_format($data['Coût total des hospitalisations (E)'][$month] / $data['Nombre d’hospitalisation (B)'][$month], 2, ',', ' ');
            }



        }
        if ($data['Nombre d’hospitalisation (B)']['Total'] > 0) {
            $data['Coût moyen mensuel d’une hospitalisation (F)']['Total'] = number_format($data['Coût total des hospitalisations (E)']['Total']  / $data['Nombre d’hospitalisation (B)']['Total'], 2, ',', ' ');
        } else {
            $data['Coût moyen mensuel d’une hospitalisation (F)']['Total'] = 0;
        }

		// Calcul des moyennes totales pour chaque catégorie
        foreach ($categories as $category) {
            $data[$category]['Moyenne'] = (float) ($data[$category]['Total'] ?? 0) / max(count($months), 1);
        }

        // Convertir les données pour Tabulator
        // Catégories nécessitant un affichage avec deux décimales (taux et coûts moyens)
        $categoriesWithDecimals = [
            'Taux d’utilisation mensuel % C (C)',
            'Taux d’utilisation cumulée %(D)',
            'Coût moyen mensuel d’une hospitalisation (F)',
            'Coût moyen cumulé d’une hospitalisation (G)',
        ];

        // Convertion
        $tabulatorData = [];
        foreach ($categories as $category) {
            $row = ['Category' => $category];
            foreach ($months as $month) {
                $value = $data[$category][$month];

                if (in_array($category, $categoriesWithDecimals) && is_numeric($value)) {
                    $row[$month] = number_format($value, 2, ',', ' ');
                } else {
                    $row[$month] = is_numeric($value) ? number_format($value, 0, ',', ' ') : $value;
                }
            }

            $totalValue = $data[$category]['Total'];
            $row['Total'] = in_array($category, $categoriesWithDecimals) && is_numeric($totalValue)
                ? number_format($totalValue, 2, ',', ' ')
                : (is_numeric($totalValue) ? number_format($totalValue, 0, ',', ' ') : $totalValue);

            $moyenneValue = $data[$category]['Moyenne'];
            $row['Moyenne'] = in_array($category, $categoriesWithDecimals) && is_numeric($moyenneValue)
                ? number_format($moyenneValue, 2, ',', ' ')
                : (is_numeric($moyenneValue) ? number_format($moyenneValue, 0, ',', ' ') : $moyenneValue);

            $row['Référence'] = $data[$category]['Référence'];
            $tabulatorData[] = $row;
        }

        $viewData = [
            'tabulatorData' => $tabulatorData,
            'currentYear' => $currentYear,
        ];

        return view('pages.backend.prestations.suivi', compact('tabulatorData', 'prestationsGroupedByAdherent', 'currentYear', 'prestationsAll', 'months' , 'data', 'pageTitle'));
    }

    public function suiviConsultation(Request $request)
    {
        $pageTitle = 'Suivi des prestations';
        $currentYear = $request->input('year', Carbon::now()->year);
        $adherentCodes = Adherent::pluck('code_carte')->toArray();

        $adherents = Adherent::whereYear('date_enregistrement', $currentYear)->get();
        $ayantsDroit = AyantDroit::join('adherents', 'ayant_droits.adherent_id', '=', 'adherents.id')
            ->whereYear('adherents.date_enregistrement', $currentYear)
            ->select('ayant_droits.*')
            ->get();
        $prestations = Prestation::whereYear('created_at', $currentYear)->get();
        $categories = [
            'Nombre de nouveaux bénéficiaires',
            'Nombre de bénéficiaires (A)',
            'Nombre moyen de bénéficiaire (A1)',
            'Nombre de consultation (B)',
            'Nombre de consultation Cumulée (B1)',
            'Taux d’utilisation mensuel % C (C)',
            'Taux d’utilisation cumulée %(D)',
            'Coût total des consultations (E)',
            'Coût Cumulé total des consultations (E1)',
            'Coût moyen mensuel d’une consultation (F)',
            'Coût moyen cumulé d’une consultation (G)'
        ];

        $months = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];

        $data = [];
        $consultationsCumulative = 0;
        $coutCumulative = 0;
        $beneficiairesCumulative = 0;
        $totalCoutCumulative = 0;

        foreach ($categories as $category) {
            foreach ($months as $month) {
                $data[$category][$month] = 0;
            }
            $data[$category]['Total'] = 0;
            $data[$category]['Moyenne'] = 0;
            $data[$category]['Référence'] = '';
        }

        // Nombre de bénéficiaires (adhérents + ayants droit)
        foreach ($adherents as $adherent) {
            $date = Carbon::parse($adherent->date_enregistrement);
            $month = $months[$date->month - 1];

            $data['Nombre de nouveaux bénéficiaires'][$month]++;
            $data['Nombre de nouveaux bénéficiaires']['Total']++;

            $data['Nombre de bénéficiaires (A)'][$month]++;
            $data['Nombre de bénéficiaires (A)']['Total']++;
        }

        foreach ($ayantsDroit as $ayantDroit) {
            $date = Carbon::parse($ayantDroit->adherent->date_enregistrement);
            $month = $months[$date->month - 1];

            // Nombre de bénéficiaires (A) par mois
            $data['Nombre de nouveaux bénéficiaires'][$month]++;
            $data['Nombre de nouveaux bénéficiaires']['Total']++;

            $data['Nombre de bénéficiaires (A)'][$month]++;
            $data['Nombre de bénéficiaires (A)']['Total']++;
        }

        // Calcul du cumul des bénéficiaires pour chaque mois
        foreach ($months as $index => $month) {
            $beneficiairesCumulative += $data['Nombre de bénéficiaires (A)'][$month];
            $data['Nombre de bénéficiaires (A)'][$month] = $beneficiairesCumulative;

            // Calculer A1 = A / nombre de mois déjà écoulés
            $data['Nombre moyen de bénéficiaire (A1)'][$month] = floor($beneficiairesCumulative / ($index + 1));
            $data['Nombre moyen de bénéficiaire (A1)']['Total'] = $data['Nombre moyen de bénéficiaire (A1)'][$month];
        }

        // Calculer les statistiques à partir des prestations
        foreach ($prestations as $prestation) {
            $date = Carbon::parse($prestation->created_at);
            $month = $months[$date->month - 1];

            // Nombre de consultation (B)
            if ($prestation->acte == 'consultation') {
                $data['Nombre de consultation (B)'][$month]++;
                $data['Nombre de consultation (B)']['Total']++;

                // Cumul des hospitalisations (B1)
                $consultationsCumulative++;
                $data['Nombre de consultation Cumulée (B1)'][$month] = $consultationsCumulative;
                $data['Nombre de consultation Cumulée (B1)']['Total'] = $consultationsCumulative;

                // Coût total des hospitalisations (E)
                if (!isset($data['Coût total des consultations (E)'][$month])) {
                    $data['Coût total des consultations (E)'][$month] = 0;
                }
                $data['Coût total des consultations (E)'][$month] += $prestation->montant;
                $data['Coût total des consultations (E)']['Total'] += $prestation->montant;


            }
        }

        // Calculer le cumul par mois pour B1
        foreach ($months as $index => $month) {
            if ($index > 0) {
                $data['Nombre de consultation Cumulée (B1)'][$month] = $data['Nombre de consultation Cumulée (B1)'][$months[$index - 1]] + $data['Nombre de consultation (B)'][$month];
            }

            // Cumul du coût total des consultations (E1)
            if ($index > 0) {
                $data['Coût Cumulé total des consultations (E1)'][$month] = $data['Coût Cumulé total des consultations (E1)'][$months[$index - 1]] + $data['Coût total des consultations (E)'][$month];
            } else {
                $data['Coût Cumulé total des consultations (E1)'][$month] = $data['Coût total des consultations (E)'][$month];
            }
            $data['Coût Cumulé total des consultations (E1)']['Total'] = $data['Coût Cumulé total des consultations (E1)'][$month] ;

            // Coût moyen cumulé d’une consultations (G)
            if ($data['Nombre de consultation Cumulée (B1)'][$month] > 0) {
                $data['Coût moyen cumulé d’une consultation (G)'][$month] = $data['Coût Cumulé total des consultations (E1)'][$month] / $data['Nombre de consultation Cumulée (B1)'][$month];
            }
        }
        if ($data['Nombre de consultation Cumulée (B1)']['Total'] > 0) {
            $data['Coût moyen cumulé d’une consultation (G)']['Total'] = $data['Coût Cumulé total des consultations (E1)']['Total']  / $data['Nombre de consultation Cumulée (B1)']['Total'];
        } else {
            $data['Coût moyen cumulé d’une consultation (G)']['Total'] = 0;
        }

        // Calcul des moyennes et taux d'utilisation
        foreach ($months as $index => $month) {
            $previousMonths = $index + 1;

            // Taux d’utilisation mensuel % (C)
            if ($data['Nombre de bénéficiaires (A)'][$month] > 0) {
                $data['Taux d’utilisation mensuel % C (C)'][$month] = number_format(($data['Nombre de consultation (B)'][$month] / $data['Nombre de bénéficiaires (A)'][$month])*$previousMonths * 100, 2);
            }
            if ($beneficiairesCumulative > 0) {
                $data['Taux d’utilisation mensuel % C (C)']['Total'] = number_format(($consultationsCumulative / $beneficiairesCumulative)*12 * 100, 2);
            } else {
                $data['Taux d’utilisation mensuel % C (C)']['Total'] = 0;
            }
            // Taux d’utilisation cumulée % (D)
            if ($data['Nombre moyen de bénéficiaire (A1)'][$month] > 0) {
                $data['Taux d’utilisation cumulée %(D)'][$month] = number_format(($data['Nombre de consultation Cumulée (B1)'][$month] / $data['Nombre moyen de bénéficiaire (A1)'][$month])*$previousMonths * 100, 2);

            }
            if ($data['Nombre moyen de bénéficiaire (A1)']['Total'] > 0) {
                $data['Taux d’utilisation cumulée %(D)']['Total'] = number_format(($consultationsCumulative / $data['Nombre moyen de bénéficiaire (A1)']['Total'])*12 * 100, 2);
            } else {
                $data['Taux d’utilisation cumulée %(D)']['Total'] = 0;
            }

            // Coût moyen mensuel d’une consultation (F)
            if ($data['Nombre de consultation (B)'][$month] > 0) {
                $data['Coût moyen mensuel d’une consultation (F)'][$month] = $data['Coût total des consultations (E)'][$month] / $data['Nombre de consultation (B)'][$month];
            }

        }
        if ($data['Nombre de consultation (B)']['Total'] > 0) {
            $data['Coût moyen mensuel d’une consultation (F)']['Total'] = $data['Coût total des consultations (E)']['Total']  / $data['Nombre de consultation (B)']['Total'];
        } else {
            $data['Coût moyen mensuel d’une consultation (F)']['Total'] = 0;
        }

        // Calcul des moyennes totales pour chaque catégorie
        foreach ($categories as $category) {
            $data[$category]['Moyenne'] = (float) ($data[$category]['Total'] ?? 0) / max(count($months), 1);
        }

        // Convertir les données pour Tabulator
        // $tabulatorData = [];
        // foreach ($categories as $category) {
        //     $row = ['Category' => $category];
        //     foreach ($months as $month) {
        //         $row[$month] = $data[$category][$month];
        //     }
        //     $row['Total'] = $data[$category]['Total'];
        //     $row['Moyenne'] = $data[$category]['Moyenne'];
        //     $row['Référence'] = $data[$category]['Référence'];
        //     $tabulatorData[] = $row;
        // }
        $categoriesWithDecimals = [
            'Taux d’utilisation mensuel % C (C)',
            'Taux d’utilisation cumulée %(D)',
            'Coût moyen mensuel d’une consultation (F)',
            'Coût moyen cumulé d’une consultation (G)',
        ];

        $tabulatorData = [];
        foreach ($categories as $category) {
            $row = ['Category' => $category];
            foreach ($months as $month) {
                $value = $data[$category][$month];

                if (in_array($category, $categoriesWithDecimals) && is_numeric($value)) {
                    $row[$month] = number_format($value, 2, ',', ' ');
                } else {
                    $row[$month] = is_numeric($value) ? number_format($value, 0, ',', ' ') : $value;
                }
            }

            $totalValue = $data[$category]['Total'];
            $row['Total'] = in_array($category, $categoriesWithDecimals) && is_numeric($totalValue)
                ? number_format($totalValue, 2, ',', ' ')
                : (is_numeric($totalValue) ? number_format($totalValue, 0, ',', ' ') : $totalValue);

            $moyenneValue = $data[$category]['Moyenne'];
            $row['Moyenne'] = in_array($category, $categoriesWithDecimals) && is_numeric($moyenneValue)
                ? number_format($moyenneValue, 2, ',', ' ')
                : (is_numeric($moyenneValue) ? number_format($moyenneValue, 0, ',', ' ') : $moyenneValue);

            $row['Référence'] = $data[$category]['Référence'];
            $tabulatorData[] = $row;
        }

        $viewData = [
            'tabulatorData' => $tabulatorData,
            'currentYear' => $currentYear,
        ];

        return view('pages.backend.prestations.suivi-consultation', compact('tabulatorData', 'currentYear', 'months' , 'data', 'pageTitle'));
    }

    // Radiologie
    public function suiviRadio(Request $request)
    {
        $pageTitle = 'Suivi des prestations';
        $currentYear = $request->input('year', Carbon::now()->year);
        $adherentCodes = Adherent::pluck('code_carte')->toArray();
        $prestationsAdherents = Prestation::join('adherents', 'prestations.adherentCode', '=', 'adherents.code_carte')
            ->whereYear('prestations.created_at', $currentYear)
            ->select('prestations.*', 'adherents.id as adherent_id')
            ->get();

        $prestationsAyantsDroit = Prestation::join('ayant_droits', 'prestations.adherentCode', '=', 'ayant_droits.code')
            ->join('adherents', 'ayant_droits.adherent_id', '=', 'adherents.id')
            ->whereYear('prestations.created_at', $currentYear)
            ->select('prestations.*', 'adherents.id as adherent_id')
            ->distinct()
            ->get();

        $prestationsAll = $prestationsAdherents->merge($prestationsAyantsDroit);

        $prestationsGroupedByAdherent = $prestationsAll->groupBy('adherent_id');

        $adherents = Adherent::whereYear('date_enregistrement', $currentYear)->get();
        $ayantsDroit = AyantDroit::join('adherents', 'ayant_droits.adherent_id', '=', 'adherents.id')
            ->whereYear('adherents.date_enregistrement', $currentYear)
            ->select('ayant_droits.*')
            ->get();
        $prestations = Prestation::whereYear('created_at', $currentYear)->get();
        $categories = [
            'Nombre de nouveaux bénéficiaires',
            'Nombre de bénéficiaires (A)',
            'Nombre moyen de bénéficiaire (A1)',
            'Nombre de radios (B)',
            'Nombre de radios Cumulée (B1)',
            'Taux d’utilisation mensuel % C (C)',
            'Taux d’utilisation cumulée %(D)',
            'Coût total des radios (E)',
            'Coût Cumulé total des radios (E1)',
            'Coût moyen mensuel d’une radio (F)',
            'Coût moyen cumulé d’une radio (G)'
        ];

        $months = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];

        $data = [];
        $radiosCumulative = 0;
        $coutCumulative = 0;
        $beneficiairesCumulative = 0;
        $totalCoutCumulative = 0;

        foreach ($categories as $category) {
            foreach ($months as $month) {
                $data[$category][$month] = 0;
            }
            $data[$category]['Total'] = 0;
            $data[$category]['Moyenne'] = 0;
            $data[$category]['Référence'] = '';
        }

        // Nombre de bénéficiaires (adhérents + ayants droit)
        foreach ($adherents as $adherent) {
            $date = Carbon::parse($adherent->date_enregistrement);
            $month = $months[$date->month - 1];

            $data['Nombre de nouveaux bénéficiaires'][$month]++;
            $data['Nombre de nouveaux bénéficiaires']['Total']++;

            $data['Nombre de bénéficiaires (A)'][$month]++;
            $data['Nombre de bénéficiaires (A)']['Total']++;
        }

        foreach ($ayantsDroit as $ayantDroit) {
            $date = Carbon::parse($ayantDroit->adherent->date_enregistrement);
            $month = $months[$date->month - 1];

            // Nombre de bénéficiaires (A) par mois
            $data['Nombre de nouveaux bénéficiaires'][$month]++;
            $data['Nombre de nouveaux bénéficiaires']['Total']++;

            $data['Nombre de bénéficiaires (A)'][$month]++;
            $data['Nombre de bénéficiaires (A)']['Total']++;
        }

        // Calcul du cumul des bénéficiaires pour chaque mois
        foreach ($months as $index => $month) {
            $beneficiairesCumulative += $data['Nombre de bénéficiaires (A)'][$month];
            $data['Nombre de bénéficiaires (A)'][$month] = $beneficiairesCumulative;

            // Calculer A1 = A / nombre de mois déjà écoulés
            $data['Nombre moyen de bénéficiaire (A1)'][$month] = floor($beneficiairesCumulative / ($index + 1));
            $data['Nombre moyen de bénéficiaire (A1)']['Total'] = $data['Nombre moyen de bénéficiaire (A1)'][$month];
        }

        // Calculer les statistiques à partir des prestations
        foreach ($prestations as $prestation) {
            $date = Carbon::parse($prestation->created_at);
            $month = $months[$date->month - 1];

            // Nombre de radios (B)
            if ($prestation->acte == 'radio') {
                $data['Nombre de radios (B)'][$month]++;
                $data['Nombre de radios (B)']['Total']++;

                // Cumul des radios (B1)
                $radiosCumulative++;
                $data['Nombre de radios Cumulée (B1)'][$month] = $radiosCumulative;
                $data['Nombre de radios Cumulée (B1)']['Total'] = $radiosCumulative;

                // Coût total des radios (E)
                if (!isset($data['Coût total des radios (E)'][$month])) {
                    $data['Coût total des radios (E)'][$month] = 0;
                }
                $data['Coût total des radios (E)'][$month] += $prestation->montant;
                $data['Coût total des radios (E)']['Total'] += $prestation->montant;


            }
        }

        // Calculer le cumul par mois pour B1
        foreach ($months as $index => $month) {
            if ($index > 0) {
                $data['Nombre de radios Cumulée (B1)'][$month] = $data['Nombre de radios Cumulée (B1)'][$months[$index - 1]] + $data['Nombre de radios (B)'][$month];
            }

            // Cumul du coût total des radios (E1)
            if ($index > 0) {
                $data['Coût Cumulé total des radios (E1)'][$month] = $data['Coût Cumulé total des radios (E1)'][$months[$index - 1]] + $data['Coût total des radios (E)'][$month];
            } else {
                $data['Coût Cumulé total des radios (E1)'][$month] = $data['Coût total des radios (E)'][$month];
            }
            $data['Coût Cumulé total des radios (E1)']['Total'] = $data['Coût Cumulé total des radios (E1)'][$month] ;

            // Coût moyen cumulé d’une radio (G)
            if ($data['Nombre de radios Cumulée (B1)'][$month] > 0) {
                $data['Coût moyen cumulé de radios (G)'][$month] = $data['Coût Cumulé total des radios (E1)'][$month] / $data['Nombre de radios Cumulée (B1)'][$month];
            }
        }
        if ($data['Nombre de radios Cumulée (B1)']['Total'] > 0) {
            $data['Coût moyen cumulé d’une radio (G)']['Total'] = $data['Coût Cumulé total des radios (E1)']['Total']  / $data['Nombre de radios Cumulée (B1)']['Total'];
        } else {
            $data['Coût moyen cumulé d’une radio (G)']['Total'] = 0;
        }

        // Calcul des moyennes et taux d'utilisation
        foreach ($months as $index => $month) {
            $previousMonths = $index + 1;

            // Taux d’utilisation mensuel % (C)
            if ($data['Nombre de bénéficiaires (A)'][$month] > 0) {
                $data['Taux d’utilisation mensuel % C (C)'][$month] = number_format(($data['Nombre de radios (B)'][$month] / $data['Nombre de bénéficiaires (A)'][$month])*$previousMonths * 100, 2);
            }
            if ($beneficiairesCumulative > 0) {
                $data['Taux d’utilisation mensuel % C (C)']['Total'] = number_format(($radiosCumulative / $beneficiairesCumulative)*12 * 100, 2);
            } else {
                $data['Taux d’utilisation mensuel % C (C)']['Total'] = 0;
            }
            // Taux d’utilisation cumulée % (D)
            if ($data['Nombre moyen de bénéficiaire (A1)'][$month] > 0) {
                $data['Taux d’utilisation cumulée %(D)'][$month] = number_format(($data['Nombre de radios Cumulée (B1)'][$month] / $data['Nombre moyen de bénéficiaire (A1)'][$month])*$previousMonths * 100, 2);

            }
            if ($data['Nombre moyen de bénéficiaire (A1)']['Total'] > 0) {
                $data['Taux d’utilisation cumulée %(D)']['Total'] = number_format(($radiosCumulative / $data['Nombre moyen de bénéficiaire (A1)']['Total'])*12 * 100, 2);
            } else {
                $data['Taux d’utilisation cumulée %(D)']['Total'] = 0;
            }

            // Coût moyen mensuel d’une radio (F)
            if ($data['Nombre de radios (B)'][$month] > 0) {
                $data['Coût moyen mensuel d’une radio (F)'][$month] = $data['Coût total des radios (E)'][$month] / $data['Nombre de radios (B)'][$month];
            }



        }
        if ($data['Nombre de radios (B)']['Total'] > 0) {
            $data['Coût moyen mensuel d’une radio (F)']['Total'] = $data['Coût total des radios (E)']['Total']  / $data['Nombre de radios (B)']['Total'];
        } else {
            $data['Coût moyen mensuel d’une radio (F)']['Total'] = 0;
        }

        // Calcul des moyennes totales pour chaque catégorie
        foreach ($categories as $category) {
            $data[$category]['Moyenne'] = (float) ($data[$category]['Total'] ?? 0) / max(count($months), 1);
        }

        // Convertir les données pour Tabulator
        // Catégories nécessitant un affichage avec deux décimales (taux et coûts moyens)
        $categoriesWithDecimals = [
            'Taux d’utilisation mensuel % C (C)',
            'Taux d’utilisation cumulée %(D)',
            'Coût moyen mensuel d’une radio (F)',
            'Coût moyen cumulé d’une radio (G)',
        ];

        // Convertion
        $tabulatorData = [];
        foreach ($categories as $category) {
            $row = ['Category' => $category];
            foreach ($months as $month) {
                $value = $data[$category][$month];

                if (in_array($category, $categoriesWithDecimals) && is_numeric($value)) {
                    $row[$month] = number_format($value, 2, ',', ' ');
                } else {
                    $row[$month] = is_numeric($value) ? number_format($value, 0, ',', ' ') : $value;
                }
            }

            $totalValue = $data[$category]['Total'];
            $row['Total'] = in_array($category, $categoriesWithDecimals) && is_numeric($totalValue)
                ? number_format($totalValue, 2, ',', ' ')
                : (is_numeric($totalValue) ? number_format($totalValue, 0, ',', ' ') : $totalValue);

            $moyenneValue = $data[$category]['Moyenne'];
            $row['Moyenne'] = in_array($category, $categoriesWithDecimals) && is_numeric($moyenneValue)
                ? number_format($moyenneValue, 2, ',', ' ')
                : (is_numeric($moyenneValue) ? number_format($moyenneValue, 0, ',', ' ') : $moyenneValue);

            $row['Référence'] = $data[$category]['Référence'];
            $tabulatorData[] = $row;
        }

        $viewData = [
            'tabulatorData' => $tabulatorData,
            'currentYear' => $currentYear,
        ];

        return view('pages.backend.prestations.suivi-radio', compact('tabulatorData', 'prestationsGroupedByAdherent', 'currentYear', 'prestationsAll', 'months' , 'data', 'pageTitle'));
    }

    // Maternité
    public function suiviMaternite(Request $request)
    {
        $pageTitle = 'Suivi des prestations';
        $currentYear = $request->input('year', Carbon::now()->year);
        $adherentCodes = Adherent::pluck('code_carte')->toArray();
        $prestationsAdherents = Prestation::join('adherents', 'prestations.adherentCode', '=', 'adherents.code_carte')
            ->whereYear('prestations.created_at', $currentYear)
            ->select('prestations.*', 'adherents.id as adherent_id')
            ->get();

        $prestationsAyantsDroit = Prestation::join('ayant_droits', 'prestations.adherentCode', '=', 'ayant_droits.code')
            ->join('adherents', 'ayant_droits.adherent_id', '=', 'adherents.id')
            ->whereYear('prestations.created_at', $currentYear)
            ->select('prestations.*', 'adherents.id as adherent_id')
            ->distinct()
            ->get();

        $prestationsAll = $prestationsAdherents->merge($prestationsAyantsDroit);

        $prestationsGroupedByAdherent = $prestationsAll->groupBy('adherent_id');

        $adherents = Adherent::whereYear('date_enregistrement', $currentYear)->get();
        $ayantsDroit = AyantDroit::join('adherents', 'ayant_droits.adherent_id', '=', 'adherents.id')
            ->whereYear('adherents.date_enregistrement', $currentYear)
            ->select('ayant_droits.*')
            ->get();
        $prestations = Prestation::whereYear('created_at', $currentYear)->get();
        $categories = [
            'Nombre de nouveaux bénéficiaires',
            'Nombre de bénéficiaires (A)',
            'Nombre moyen de bénéficiaire (A1)',
            'Nombre de maternites (B)',
            'Nombre de maternites Cumulée (B1)',
            'Taux d’utilisation mensuel % C (C)',
            'Taux d’utilisation cumulée %(D)',
            'Coût total des maternites (E)',
            'Coût Cumulé total des maternites (E1)',
            'Coût moyen mensuel d’une maternite (F)',
            'Coût moyen cumulé d’une maternite (G)'
        ];

        $months = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];

        $data = [];
        $maternitesCumulative = 0;
        $coutCumulative = 0;
        $beneficiairesCumulative = 0;
        $totalCoutCumulative = 0;

        foreach ($categories as $category) {
            foreach ($months as $month) {
                $data[$category][$month] = 0;
            }
            $data[$category]['Total'] = 0;
            $data[$category]['Moyenne'] = 0;
            $data[$category]['Référence'] = '';
        }

        // Nombre de bénéficiaires (adhérents + ayants droit)
        foreach ($adherents as $adherent) {
            $date = Carbon::parse($adherent->date_enregistrement);
            $month = $months[$date->month - 1];
            $data['Nombre de nouveaux bénéficiaires'][$month]++;
            $data['Nombre de nouveaux bénéficiaires']['Total']++;

            $data['Nombre de bénéficiaires (A)'][$month]++;
            $data['Nombre de bénéficiaires (A)']['Total']++;
        }

        foreach ($ayantsDroit as $ayantDroit) {
            $date = Carbon::parse($ayantDroit->adherent->date_enregistrement);
            $month = $months[$date->month - 1];

            // Nombre de bénéficiaires (A) par mois
            $data['Nombre de nouveaux bénéficiaires'][$month]++;
            $data['Nombre de nouveaux bénéficiaires']['Total']++;

            $data['Nombre de bénéficiaires (A)'][$month]++;
            $data['Nombre de bénéficiaires (A)']['Total']++;
        }

        // Calcul du cumul des bénéficiaires pour chaque mois
        foreach ($months as $index => $month) {
            $beneficiairesCumulative += $data['Nombre de bénéficiaires (A)'][$month];
            $data['Nombre de bénéficiaires (A)'][$month] = $beneficiairesCumulative;

            // Calculer A1 = A / nombre de mois déjà écoulés
            $data['Nombre moyen de bénéficiaire (A1)'][$month] = floor($beneficiairesCumulative / ($index + 1));
            $data['Nombre moyen de bénéficiaire (A1)']['Total'] = $data['Nombre moyen de bénéficiaire (A1)'][$month];
        }

        // Calculer les statistiques à partir des prestations
        foreach ($prestations as $prestation) {
            $date = Carbon::parse($prestation->created_at);
            $month = $months[$date->month - 1];

            // Nombre de maternites (B)
            if ($prestation->acte == 'maternite') {
                $data['Nombre de maternites (B)'][$month]++;
                $data['Nombre de maternites (B)']['Total']++;

                // Cumul des maternites (B1)
                $maternitesCumulative++;
                $data['Nombre de maternites Cumulée (B1)'][$month] = $maternitesCumulative;
                $data['Nombre de maternites Cumulée (B1)']['Total'] = $maternitesCumulative;

                // Coût total des maternites (E)
                if (!isset($data['Coût total des maternites (E)'][$month])) {
                    $data['Coût total des maternites (E)'][$month] = 0;
                }
                $data['Coût total des maternites (E)'][$month] += $prestation->montant;
                $data['Coût total des maternites (E)']['Total'] += $prestation->montant;


            }
        }

        // Calculer le cumul par mois pour B1
        foreach ($months as $index => $month) {
            if ($index > 0) {
                $data['Nombre de maternites Cumulée (B1)'][$month] = $data['Nombre de maternites Cumulée (B1)'][$months[$index - 1]] + $data['Nombre de maternites (B)'][$month];
            }

            // Cumul du coût total des maternites (E1)
            if ($index > 0) {
                $data['Coût Cumulé total des maternites (E1)'][$month] = $data['Coût Cumulé total des maternites (E1)'][$months[$index - 1]] + $data['Coût total des maternites (E)'][$month];
            } else {
                $data['Coût Cumulé total des maternites (E1)'][$month] = $data['Coût total des maternites (E)'][$month];
            }
            $data['Coût Cumulé total des maternites (E1)']['Total'] = $data['Coût Cumulé total des maternites (E1)'][$month] ;

            // Coût moyen cumulé d’une maternite (G)
            if ($data['Nombre de maternites Cumulée (B1)'][$month] > 0) {
                $data['Coût moyen cumulé d’une maternite (G)'][$month] = $data['Coût Cumulé total des maternites (E1)'][$month] / $data['Nombre de maternites Cumulée (B1)'][$month];
            }
        }
        if ($data['Nombre de maternites Cumulée (B1)']['Total'] > 0) {
            $data['Coût moyen cumulé d’une maternite (G)']['Total'] = $data['Coût Cumulé total des maternites (E1)']['Total']  / $data['Nombre de maternites Cumulée (B1)']['Total'];
        } else {
            $data['Coût moyen cumulé d’une maternite (G)']['Total'] = 0;
        }

        // Calcul des moyennes et taux d'utilisation
        foreach ($months as $index => $month) {
            $previousMonths = $index + 1;

            // Taux d’utilisation mensuel % (C)
            if ($data['Nombre de bénéficiaires (A)'][$month] > 0) {
                $data['Taux d’utilisation mensuel % C (C)'][$month] = number_format(($data['Nombre de maternites (B)'][$month] / $data['Nombre de bénéficiaires (A)'][$month])*$previousMonths * 100, 2);
            }
            if ($beneficiairesCumulative > 0) {
                $data['Taux d’utilisation mensuel % C (C)']['Total'] = number_format(($maternitesCumulative / $beneficiairesCumulative)*12 * 100, 2);
            } else {
                $data['Taux d’utilisation mensuel % C (C)']['Total'] = 0;
            }
            // Taux d’utilisation cumulée % (D)
            if ($data['Nombre moyen de bénéficiaire (A1)'][$month] > 0) {
                $data['Taux d’utilisation cumulée %(D)'][$month] = number_format(($data['Nombre de maternites Cumulée (B1)'][$month] / $data['Nombre moyen de bénéficiaire (A1)'][$month])*$previousMonths * 100, 2);

            }
            if ($data['Nombre moyen de bénéficiaire (A1)']['Total'] > 0) {
                $data['Taux d’utilisation cumulée %(D)']['Total'] = number_format(($maternitesCumulative / $data['Nombre moyen de bénéficiaire (A1)']['Total'])*12 * 100, 2);
            } else {
                $data['Taux d’utilisation cumulée %(D)']['Total'] = 0;
            }

            // Coût moyen mensuel d’une maternite (F)
            if ($data['Nombre de maternites (B)'][$month] > 0) {
                $data['Coût moyen mensuel d’une maternite (F)'][$month] = $data['Coût total des maternites (E)'][$month] / $data['Nombre de maternites (B)'][$month];
            }



        }
        if ($data['Nombre de maternites (B)']['Total'] > 0) {
            $data['Coût moyen mensuel d’une maternite (F)']['Total'] = $data['Coût total des maternites (E)']['Total']  / $data['Nombre de maternites (B)']['Total'];
        } else {
            $data['Coût moyen mensuel d’une maternite (F)']['Total'] = 0;
        }

        // Calcul des moyennes totales pour chaque catégorie
        foreach ($categories as $category) {
            $data[$category]['Moyenne'] = (float) ($data[$category]['Total'] ?? 0) / max(count($months), 1);
        }

        // Catégories nécessitant un affichage avec deux décimales (taux et coûts moyens)
        $categoriesWithDecimals = [
            'Taux d’utilisation mensuel % C (C)',
            'Taux d’utilisation cumulée %(D)',
            'Coût moyen mensuel d’une maternite (F)',
            'Coût moyen cumulé d’une maternite (G)'
        ];


        // Convertir les données pour Tabulator
        foreach ($categories as $category) {
            $row = ['Category' => $category];
            foreach ($months as $month) {
                $value = $data[$category][$month];

                if (in_array($category, $categoriesWithDecimals) && is_numeric($value)) {
                    $row[$month] = number_format($value, 2, ',', ' ');
                } else {
                    $row[$month] = is_numeric($value) ? number_format($value, 0, ',', ' ') : $value;
                }
            }

            $totalValue = $data[$category]['Total'];
            $row['Total'] = in_array($category, $categoriesWithDecimals) && is_numeric($totalValue)
                ? number_format($totalValue, 2, ',', ' ')
                : (is_numeric($totalValue) ? number_format($totalValue, 0, ',', ' ') : $totalValue);

            $moyenneValue = $data[$category]['Moyenne'];
            $row['Moyenne'] = in_array($category, $categoriesWithDecimals) && is_numeric($moyenneValue)
                ? number_format($moyenneValue, 2, ',', ' ')
                : (is_numeric($moyenneValue) ? number_format($moyenneValue, 0, ',', ' ') : $moyenneValue);

            $row['Référence'] = $data[$category]['Référence'];
            $tabulatorData[] = $row;
        }

        $viewData = [
            'tabulatorData' => $tabulatorData,
            'currentYear' => $currentYear,
        ];

        return view('pages.backend.prestations.suivi-maternite', compact('tabulatorData', 'prestationsGroupedByAdherent', 'currentYear', 'prestationsAll', 'months' , 'data', 'pageTitle'));
    }

    //
    public function suiviAllocation(Request $request)
    {
        $pageTitle = 'Suivi des prestations';
        $currentYear = $request->input('year', Carbon::now()->year);
        $adherentCodes = Adherent::pluck('code_carte')->toArray();
        $prestationsAdherents = Prestation::join('adherents', 'prestations.adherentCode', '=', 'adherents.code_carte')
            ->whereYear('prestations.created_at', $currentYear)
            ->select('prestations.*', 'adherents.id as adherent_id')
            ->get();

        $prestationsAyantsDroit = Prestation::join('ayant_droits', 'prestations.adherentCode', '=', 'ayant_droits.code')
            ->join('adherents', 'ayant_droits.adherent_id', '=', 'adherents.id')
            ->whereYear('prestations.created_at', $currentYear)
            ->select('prestations.*', 'adherents.id as adherent_id')
            ->distinct()
            ->get();



        $prestationsAll = $prestationsAdherents->merge($prestationsAyantsDroit);


        $prestationsGroupedByAdherent = $prestationsAll->groupBy('adherent_id');

        $adherents = Adherent::whereYear('date_enregistrement', $currentYear)->get();
        $ayantsDroit = AyantDroit::join('adherents', 'ayant_droits.adherent_id', '=', 'adherents.id')
            ->whereYear('adherents.date_enregistrement', $currentYear)
            ->select('ayant_droits.*')
            ->get();
        $prestations = Prestation::whereYear('created_at', $currentYear)->get();
        $categories = [
            'Nombre de nouveaux bénéficiaires',
            'Nombre de bénéficiaires (A)',
            'Nombre moyen de bénéficiaire (A1)',
            'Nombre d’allocations (B)',
            'Nombre d’allocations Cumulée (B1)',
            'Taux d’utilisation mensuel % C (C)',
            'Taux d’utilisation cumulée %(D)',
            'Coût total des allocations (E)',
            'Coût Cumulé total des allocations (E1)',
            'Coût moyen mensuel d’une allocation (F)',
            'Coût moyen cumulé d’une allocation (G)'
        ];

        $months = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];

        $data = [];
        $allocationsCumulative = 0;
        $coutCumulative = 0;
        $beneficiairesCumulative = 0;
        $totalCoutCumulative = 0;

        foreach ($categories as $category) {
            foreach ($months as $month) {
                $data[$category][$month] = 0;
            }
            $data[$category]['Total'] = 0;
            $data[$category]['Moyenne'] = 0;
            $data[$category]['Référence'] = '';
        }

        // Nombre de bénéficiaires (adhérents + ayants droit)
        foreach ($adherents as $adherent) {
            $date = Carbon::parse($adherent->date_enregistrement);
            $month = $months[$date->month - 1];
            $data['Nombre de nouveaux bénéficiaires'][$month]++;
            $data['Nombre de nouveaux bénéficiaires']['Total']++;
            $data['Nombre de bénéficiaires (A)'][$month]++;
            $data['Nombre de bénéficiaires (A)']['Total']++;
        }

        foreach ($ayantsDroit as $ayantDroit) {
            $date = Carbon::parse($ayantDroit->adherent->date_enregistrement);
            $month = $months[$date->month - 1];

            // Nombre de bénéficiaires (A) par mois
            $data['Nombre de nouveaux bénéficiaires'][$month]++;
            $data['Nombre de nouveaux bénéficiaires']['Total']++;
            $data['Nombre de bénéficiaires (A)'][$month]++;
            $data['Nombre de bénéficiaires (A)']['Total']++;
        }

        // Calcul du cumul des bénéficiaires pour chaque mois
        foreach ($months as $index => $month) {
            $beneficiairesCumulative += $data['Nombre de bénéficiaires (A)'][$month];
            $data['Nombre de bénéficiaires (A)'][$month] = $beneficiairesCumulative;

            // Calculer A1 = A / nombre de mois déjà écoulés
            $data['Nombre moyen de bénéficiaire (A1)'][$month] = floor($beneficiairesCumulative / ($index + 1));
            $data['Nombre moyen de bénéficiaire (A1)']['Total'] = $data['Nombre moyen de bénéficiaire (A1)'][$month];
        }

        // Calculer les statistiques à partir des prestations
        foreach ($prestations as $prestation) {
            $date = Carbon::parse($prestation->created_at);
            $month = $months[$date->month - 1];

            // Nombre allocations (B)
            if ($prestation->acte == 'allocation') {
                $data['Nombre d’allocations (B)'][$month]++;
                $data['Nombre d’allocations (B)']['Total']++;

                // Cumul des allocations (B1)
                $allocationsCumulative++;
                $data['Nombre d’allocations Cumulée (B1)'][$month] = $allocationsCumulative;
                $data['Nombre d’allocations Cumulée (B1)']['Total'] = $allocationsCumulative;

                // Coût total des allocations (E)
                if (!isset($data['Coût total des allocations (E)'][$month])) {
                    $data['Coût total des allocations (E)'][$month] = 0;
                }
                $data['Coût total des allocations (E)'][$month] += $prestation->montant;
                $data['Coût total des allocations (E)']['Total'] += $prestation->montant;


            }
        }

        // Calculer le cumul par mois pour B1
        foreach ($months as $index => $month) {
            if ($index > 0) {
                $data['Nombre d’allocations Cumulée (B1)'][$month] = $data['Nombre d’allocations Cumulée (B1)'][$months[$index - 1]] + $data['Nombre d’allocations (B)'][$month];
            }

            // Cumul du coût total des allocations (E1)
            if ($index > 0) {
                $data['Coût Cumulé total des allocations (E1)'][$month] = $data['Coût Cumulé total des allocations (E1)'][$months[$index - 1]] + $data['Coût total des allocations (E)'][$month];
            } else {
                $data['Coût Cumulé total des allocations (E1)'][$month] = $data['Coût total des allocations (E)'][$month];
            }
            $data['Coût Cumulé total des allocations (E1)']['Total'] = $data['Coût Cumulé total des allocations (E1)'][$month] ;

            // Coût moyen cumulé d’une allocation (G)
            if ($data['Nombre d’allocations Cumulée (B1)'][$month] > 0) {
                $data['Coût moyen cumulé d’une allocation (G)'][$month] = $data['Coût Cumulé total des allocations (E1)'][$month] / $data['Nombre d’allocations Cumulée (B1)'][$month];
            }
        }
        if ($data['Nombre d’allocations Cumulée (B1)']['Total'] > 0) {
            $data['Coût moyen cumulé d’une allocation (G)']['Total'] = $data['Coût Cumulé total des allocations (E1)']['Total']  / $data['Nombre d’allocations Cumulée (B1)']['Total'];
        } else {
            $data['Coût moyen cumulé d’une allocation (G)']['Total'] = 0;
        }

        // Calcul des moyennes et taux d'utilisation
        foreach ($months as $index => $month) {
            $previousMonths = $index + 1;

            // Taux d’utilisation mensuel % (C)
            if ($data['Nombre de bénéficiaires (A)'][$month] > 0) {
                $data['Taux d’utilisation mensuel % C (C)'][$month] = number_format(($data['Nombre d’allocations (B)'][$month] / $data['Nombre de bénéficiaires (A)'][$month])*$previousMonths * 100, 2);
            }
            if ($beneficiairesCumulative > 0) {
                $data['Taux d’utilisation mensuel % C (C)']['Total'] = number_format(($allocationsCumulative / $beneficiairesCumulative)*12 * 100, 2);
            } else {
                $data['Taux d’utilisation mensuel % C (C)']['Total'] = 0;
            }
            // Taux d’utilisation cumulée % (D)
            if ($data['Nombre moyen de bénéficiaire (A1)'][$month] > 0) {
                $data['Taux d’utilisation cumulée %(D)'][$month] = number_format(($data['Nombre d’allocations Cumulée (B1)'][$month] / $data['Nombre moyen de bénéficiaire (A1)'][$month])*$previousMonths * 100, 2);

            }
            if ($data['Nombre moyen de bénéficiaire (A1)']['Total'] > 0) {
                $data['Taux d’utilisation cumulée %(D)']['Total'] = number_format(($allocationsCumulative / $data['Nombre moyen de bénéficiaire (A1)']['Total'])*12 * 100, 2);
            } else {
                $data['Taux d’utilisation cumulée %(D)']['Total'] = 0;
            }

            // Coût moyen mensuel d’une allocation (F)
            if ($data['Nombre d’allocations (B)'][$month] > 0) {
                $data['Coût moyen mensuel d’une allocation (F)'][$month] = $data['Coût total des allocations (E)'][$month] / $data['Nombre d’allocations (B)'][$month];
            }



        }
        if ($data['Nombre d’allocations (B)']['Total'] > 0) {
            $data['Coût moyen mensuel d’une allocation (F)']['Total'] = $data['Coût total des allocations (E)']['Total']  / $data['Nombre d’allocation (B)']['Total'];
        } else {
            $data['Coût moyen mensuel d’une allocation (F)']['Total'] = 0;
        }

        // Calcul des moyennes totales pour chaque catégorie
        foreach ($categories as $category) {
            $data[$category]['Moyenne'] = (float) ($data[$category]['Total'] ?? 0) / max(count($months), 1);
        }

        // Catégories nécessitant un affichage avec deux décimales (taux et coûts moyens)
        $categoriesWithDecimals = [
            'Taux d’utilisation mensuel % C (C)',
            'Taux d’utilisation cumulée %(D)',
            'Coût moyen mensuel d’une allocation (F)',
            'Coût moyen cumulé d’une allocation (G)'
        ];


        // Convertir les données pour Tabulator
        foreach ($categories as $category) {
            $row = ['Category' => $category];
            foreach ($months as $month) {
                $value = $data[$category][$month];

                if (in_array($category, $categoriesWithDecimals) && is_numeric($value)) {
                    $row[$month] = number_format($value, 2, ',', ' ');
                } else {
                    $row[$month] = is_numeric($value) ? number_format($value, 0, ',', ' ') : $value;
                }
            }

            $totalValue = $data[$category]['Total'];
            $row['Total'] = in_array($category, $categoriesWithDecimals) && is_numeric($totalValue)
                ? number_format($totalValue, 2, ',', ' ')
                : (is_numeric($totalValue) ? number_format($totalValue, 0, ',', ' ') : $totalValue);

            $moyenneValue = $data[$category]['Moyenne'];
            $row['Moyenne'] = in_array($category, $categoriesWithDecimals) && is_numeric($moyenneValue)
                ? number_format($moyenneValue, 2, ',', ' ')
                : (is_numeric($moyenneValue) ? number_format($moyenneValue, 0, ',', ' ') : $moyenneValue);

            $row['Référence'] = $data[$category]['Référence'];
            $tabulatorData[] = $row;
        }

        $viewData = [
            'tabulatorData' => $tabulatorData,
            'currentYear' => $currentYear,
        ];

        return view('pages.backend.prestations.suivi-allocation', compact('tabulatorData', 'prestationsGroupedByAdherent', 'currentYear', 'prestationsAll', 'months' , 'data', 'pageTitle'));
    }


    public function suiviAnalyseBiomedicale(Request $request)
    {
        $pageTitle = 'Suivi des prestations';
        $currentYear = $request->input('year', Carbon::now()->year);
        $adherentCodes = Adherent::pluck('code_carte')->toArray();
        $prestationsAdherents = Prestation::join('adherents', 'prestations.adherentCode', '=', 'adherents.code_carte')
            ->whereYear('prestations.created_at', $currentYear)
            ->select('prestations.*', 'adherents.id as adherent_id')
            ->get();

        $prestationsAyantsDroit = Prestation::join('ayant_droits', 'prestations.adherentCode', '=', 'ayant_droits.code')
            ->join('adherents', 'ayant_droits.adherent_id', '=', 'adherents.id')
            ->whereYear('prestations.created_at', $currentYear)
            ->select('prestations.*', 'adherents.id as adherent_id')
            ->distinct()
            ->get();



        $prestationsAll = $prestationsAdherents->merge($prestationsAyantsDroit);


        $prestationsGroupedByAdherent = $prestationsAll->groupBy('adherent_id');

        $adherents = Adherent::whereYear('date_enregistrement', $currentYear)->get();
        $ayantsDroit = AyantDroit::join('adherents', 'ayant_droits.adherent_id', '=', 'adherents.id')
            ->whereYear('adherents.date_enregistrement', $currentYear)
            ->select('ayant_droits.*')
            ->get();
        $prestations = Prestation::whereYear('created_at', $currentYear)->get();
        $categories = [
            'Nombre de nouveaux bénéficiaires',
            'Nombre de bénéficiaires (A)',
            'Nombre moyen de bénéficiaire (A1)',
            'Nombre d’analyses biomédicales (B)',
            'Nombre d’analyses biomédicales Cumulée (B1)',
            'Taux d’utilisation mensuel % C (C)',
            'Taux d’utilisation cumulée %(D)',
            'Coût total des analyses biomédicales (E)',
            'Coût Cumulé total des analyses biomédicales (E1)',
            'Coût moyen mensuel d’une analyse biomédicale (F)',
            'Coût moyen cumulé d’une analyse biomédicale (G)'
        ];

        $months = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];

        $data = [];
        $analysesBiomedicalesCumulative = 0;
        $coutCumulative = 0;
        $beneficiairesCumulative = 0;
        $totalCoutCumulative = 0;

        foreach ($categories as $category) {
            foreach ($months as $month) {
                $data[$category][$month] = 0;
            }
            $data[$category]['Total'] = 0;
            $data[$category]['Moyenne'] = 0;
            $data[$category]['Référence'] = '';
        }

        // Nombre de bénéficiaires (adhérents + ayants droit)
        foreach ($adherents as $adherent) {
            $date = Carbon::parse($adherent->date_enregistrement);
            $month = $months[$date->month - 1];

            $data['Nombre de nouveaux bénéficiaires'][$month]++;
            $data['Nombre de nouveaux bénéficiaires']['Total']++;

            $data['Nombre de bénéficiaires (A)'][$month]++;
            $data['Nombre de bénéficiaires (A)']['Total']++;
        }

        foreach ($ayantsDroit as $ayantDroit) {
            $date = Carbon::parse($ayantDroit->adherent->date_enregistrement);
            $month = $months[$date->month - 1];

            // Nombre de bénéficiaires (A) par mois
            $data['Nombre de nouveaux bénéficiaires'][$month]++;
            $data['Nombre de nouveaux bénéficiaires']['Total']++;

            $data['Nombre de bénéficiaires (A)'][$month]++;
            $data['Nombre de bénéficiaires (A)']['Total']++;
        }

        // Calcul du cumul des bénéficiaires pour chaque mois
        foreach ($months as $index => $month) {
            $beneficiairesCumulative += $data['Nombre de bénéficiaires (A)'][$month];
            $data['Nombre de bénéficiaires (A)'][$month] = $beneficiairesCumulative;

            // Calculer A1 = A / nombre de mois déjà écoulés
            $data['Nombre moyen de bénéficiaire (A1)'][$month] = floor($beneficiairesCumulative / ($index + 1));
            $data['Nombre moyen de bénéficiaire (A1)']['Total'] = $data['Nombre moyen de bénéficiaire (A1)'][$month];
        }

        // Calculer les statistiques à pfartir des prestations
        foreach ($prestations as $prestation) {
            $date = Carbon::parse($prestation->created_at);
            $month = $months[$date->month - 1];

            // Nombre d'analyses biomédicales (B)
            if ($prestation->acte == 'analyse_biomedicale') {
                $data['Nombre d’analyses biomédicales (B)'][$month]++;
                $data['Nombre d’analyses biomédicales (B)']['Total']++;

                // Cumul des analyses biomédicales (B1)
                $analysesBiomedicalesCumulative++;
                $data['Nombre d’analyses biomédicales Cumulée (B1)'][$month] = $analysesBiomedicalesCumulative;
                $data['Nombre d’analyses biomédicales Cumulée (B1)']['Total'] = $analysesBiomedicalesCumulative;

                // Coût total des analyses biomédicales (E)
                if (!isset($data['Coût total des analyses biomédicales (E)'][$month])) {
                    $data['Coût total des analyses biomédicales (E)'][$month] = 0;
                }
                $data['Coût total des analyses biomédicales (E)'][$month] += $prestation->montant;
                $data['Coût total des analyses biomédicales (E)']['Total'] += $prestation->montant;


            }
        }

        // Calculer le cumul par mois pour B1
        foreach ($months as $index => $month) {
            if ($index > 0) {
                $data['Nombre d’analyses biomédicales Cumulée (B1)'][$month] = $data['Nombre d’analyses biomédicales Cumulée (B1)'][$months[$index - 1]] + $data['Nombre d’analyses biomédicales (B)'][$month];
            }

            // Cumul du coût total des analyses biomédicales (E1)
            if ($index > 0) {
                $data['Coût Cumulé total des analyses biomédicales (E1)'][$month] = $data['Coût Cumulé total des analyses biomédicales (E1)'][$months[$index - 1]] + $data['Coût total des analyses biomédicales (E)'][$month];
            } else {
                $data['Coût Cumulé total des analyses biomédicales (E1)'][$month] = $data['Coût total des analyses biomédicales (E)'][$month];
            }
            $data['Coût Cumulé total des analyses biomédicales (E1)']['Total'] = $data['Coût Cumulé total des analyses biomédicales (E1)'][$month] ;

            // Coût moyen cumulé d’une analyse biomédicale (G)
            if ($data['Nombre d’analyses biomédicales Cumulée (B1)'][$month] > 0) {
                $data['Coût moyen cumulé d’une analyse biomédicale (G)'][$month] = $data['Coût Cumulé total des analyses biomédicales (E1)'][$month] / $data['Nombre d’analyses biomédicales Cumulée (B1)'][$month];
            }
        }
        if ($data['Nombre d’analyses biomédicales Cumulée (B1)']['Total'] > 0) {
            $data['Coût moyen cumulé d’une analyse biomédicale (G)']['Total'] = $data['Coût Cumulé total des analyses biomédicales (E1)']['Total']  / $data['Nombre d’analyses biomédicales Cumulée (B1)']['Total'];
        } else {
            $data['Coût moyen cumulé d’une analyse biomédicale (G)']['Total'] = 0;
        }

        // Calcul des moyennes et taux d'utilisation
        foreach ($months as $index => $month) {
            $previousMonths = $index + 1;

            // Taux d’utilisation mensuel % (C)
            if ($data['Nombre de bénéficiaires (A)'][$month] > 0) {
                $data['Taux d’utilisation mensuel % C (C)'][$month] = number_format(($data['Nombre d’analyses biomédicales (B)'][$month] / $data['Nombre de bénéficiaires (A)'][$month])*$previousMonths * 100, 2);
            }
            if ($beneficiairesCumulative > 0) {
                $data['Taux d’utilisation mensuel % C (C)']['Total'] = number_format(($analysesBiomedicalesCumulative / $beneficiairesCumulative)*12 * 100, 2);
            } else {
                $data['Taux d’utilisation mensuel % C (C)']['Total'] = 0;
            }
            // Taux d’utilisation cumulée % (D)
            if ($data['Nombre moyen de bénéficiaire (A1)'][$month] > 0) {
                $data['Taux d’utilisation cumulée %(D)'][$month] = number_format(($data['Nombre d’analyses biomédicales Cumulée (B1)'][$month] / $data['Nombre moyen de bénéficiaire (A1)'][$month])*$previousMonths * 100, 2);

            }
            if ($data['Nombre moyen de bénéficiaire (A1)']['Total'] > 0) {
                $data['Taux d’utilisation cumulée %(D)']['Total'] = number_format(($analysesBiomedicalesCumulative / $data['Nombre moyen de bénéficiaire (A1)']['Total'])*12 * 100, 2);
            } else {
                $data['Taux d’utilisation cumulée %(D)']['Total'] = 0;
            }

            // Coût moyen mensuel d’une analyse biomédicale (F)
            if ($data['Nombre d’analyses biomédicales (B)'][$month] > 0) {
                $data['Coût moyen mensuel d’une analyse biomédicale (F)'][$month] = $data['Coût total des analyses biomédicales (E)'][$month] / $data['Nombre d’analyses biomédicales (B)'][$month];
            }



        }
        if ($data['Nombre d’analyses biomédicales (B)']['Total'] > 0) {
            $data['Coût moyen mensuel d’une analyse biomédicale (F)']['Total'] = $data['Coût total des analyses biomédicales (E)']['Total']  / $data['Nombre d’analyses biomédicales (B)']['Total'];
        } else {
            $data['Coût moyen mensuel d’une analyse biomédicale (F)']['Total'] = 0;
        }

		// Calcul des moyennes totales pour chaque catégorie
        foreach ($categories as $category) {
            $data[$category]['Moyenne'] = (float) ($data[$category]['Total'] ?? 0) / max(count($months), 1);
        }

        // Convertir les données pour Tabulator
        // Catégories nécessitant un affichage avec deux décimales (taux et coûts moyens)
        $categoriesWithDecimals = [
            'Taux d’utilisation mensuel % C (C)',
            'Taux d’utilisation cumulée %(D)',
            'Coût moyen mensuel d’une analyse biomédicale (F)',
            'Coût moyen cumulé d’une analyse biomédicale (G)',
        ];

        // Convertion
        $tabulatorData = [];
        foreach ($categories as $category) {
            $row = ['Category' => $category];
            foreach ($months as $month) {
                $value = $data[$category][$month];

                if (in_array($category, $categoriesWithDecimals) && is_numeric($value)) {
                    $row[$month] = number_format($value, 2, ',', ' ');
                } else {
                    $row[$month] = is_numeric($value) ? number_format($value, 0, ',', ' ') : $value;
                }
            }

            $totalValue = $data[$category]['Total'];
            $row['Total'] = in_array($category, $categoriesWithDecimals) && is_numeric($totalValue)
                ? number_format($totalValue, 2, ',', ' ')
                : (is_numeric($totalValue) ? number_format($totalValue, 0, ',', ' ') : $totalValue);

            $moyenneValue = $data[$category]['Moyenne'];
            $row['Moyenne'] = in_array($category, $categoriesWithDecimals) && is_numeric($moyenneValue)
                ? number_format($moyenneValue, 2, ',', ' ')
                : (is_numeric($moyenneValue) ? number_format($moyenneValue, 0, ',', ' ') : $moyenneValue);

            $row['Référence'] = $data[$category]['Référence'];
            $tabulatorData[] = $row;
        }

        $viewData = [
            'tabulatorData' => $tabulatorData,
            'currentYear' => $currentYear,
        ];

        return view('pages.backend.prestations.suivi-analyse-biomedicale', compact('tabulatorData', 'prestationsGroupedByAdherent', 'currentYear', 'prestationsAll', 'months' , 'data', 'pageTitle'));
    }

    public function suiviPharmacie(Request $request)
    {
        $pageTitle = 'Suivi des prestations';
        $currentYear = $request->input('year', Carbon::now()->year);
        $adherentCodes = Adherent::pluck('code_carte')->toArray();
        $prestationsAdherents = Prestation::join('adherents', 'prestations.adherentCode', '=', 'adherents.code_carte')
            ->whereYear('prestations.created_at', $currentYear)
            ->select('prestations.*', 'adherents.id as adherent_id')
            ->get();

        $prestationsAyantsDroit = Prestation::join('ayant_droits', 'prestations.adherentCode', '=', 'ayant_droits.code')
            ->join('adherents', 'ayant_droits.adherent_id', '=', 'adherents.id')
            ->whereYear('prestations.created_at', $currentYear)
            ->select('prestations.*', 'adherents.id as adherent_id')
            ->distinct()
            ->get();

        $prestationsAll = $prestationsAdherents->merge($prestationsAyantsDroit);

        $prestationsGroupedByAdherent = $prestationsAll->groupBy('adherent_id');

        $adherents = Adherent::whereYear('date_enregistrement', $currentYear)->get();
        $ayantsDroit = AyantDroit::join('adherents', 'ayant_droits.adherent_id', '=', 'adherents.id')
            ->whereYear('adherents.date_enregistrement', $currentYear)
            ->select('ayant_droits.*')
            ->get();
        $prestations = Prestation::whereYear('created_at', $currentYear)->get();
        $categories = [
            'Nombre de nouveaux bénéficiaires',
            'Nombre de bénéficiaires (A)',
            'Nombre moyen de bénéficiaire (A1)',
            'Nombre de pharmacies (B)',
            'Nombre de pharmacies Cumulée (B1)',
            'Taux d’utilisation mensuel % C (C)',
            'Taux d’utilisation cumulée %(D)',
            'Coût total des pharmacies (E)',
            'Coût Cumulé total des pharmacies (E1)',
            'Coût moyen mensuel d’une pharmacie (F)',
            'Coût moyen cumulé d’une pharmacie (G)'
        ];

        $months = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];

        $data = [];
        $pharmaciesCumulative = 0;
        $coutCumulative = 0;
        $beneficiairesCumulative = 0;
        $totalCoutCumulative = 0;

        foreach ($categories as $category) {
            foreach ($months as $month) {
                $data[$category][$month] = 0;
            }
            $data[$category]['Total'] = 0;
            $data[$category]['Moyenne'] = 0;
            $data[$category]['Référence'] = '';
        }

        // Nombre de bénéficiaires (adhérents + ayants droit)
        foreach ($adherents as $adherent) {
            $date = Carbon::parse($adherent->date_enregistrement);
            $month = $months[$date->month - 1];

            $data['Nombre de nouveaux bénéficiaires'][$month]++;
            $data['Nombre de nouveaux bénéficiaires']['Total']++;

            $data['Nombre de bénéficiaires (A)'][$month]++;
            $data['Nombre de bénéficiaires (A)']['Total']++;
        }

        foreach ($ayantsDroit as $ayantDroit) {
            $date = Carbon::parse($ayantDroit->adherent->date_enregistrement);
            $month = $months[$date->month - 1];

            // Nombre de bénéficiaires (A) par mois
            $data['Nombre de nouveaux bénéficiaires'][$month]++;
            $data['Nombre de nouveaux bénéficiaires']['Total']++;

            $data['Nombre de bénéficiaires (A)'][$month]++;
            $data['Nombre de bénéficiaires (A)']['Total']++;
        }

        // Calcul du cumul des bénéficiaires pour chaque mois
        foreach ($months as $index => $month) {
            $beneficiairesCumulative += $data['Nombre de bénéficiaires (A)'][$month];
            $data['Nombre de bénéficiaires (A)'][$month] = $beneficiairesCumulative;

            // Calculer A1 = A / nombre de mois déjà écoulés
            $data['Nombre moyen de bénéficiaire (A1)'][$month] = floor($beneficiairesCumulative / ($index + 1));
            $data['Nombre moyen de bénéficiaire (A1)']['Total'] = $data['Nombre moyen de bénéficiaire (A1)'][$month];
        }

        // Calculer les statistiques à pfartir des prestations
        foreach ($prestations as $prestation) {
            $date = Carbon::parse($prestation->created_at);
            $month = $months[$date->month - 1];

            // Nombre de pharmacies (B)
            if ($prestation->acte == 'pharmacie') {
                $data['Nombre de pharmacies (B)'][$month]++;
                $data['Nombre de pharmacies (B)']['Total']++;

                // Cumul des pharmacies (B1)
                $pharmaciesCumulative++;
                $data['Nombre de pharmacies Cumulée (B1)'][$month] = $pharmaciesCumulative;
                $data['Nombre de pharmacies Cumulée (B1)']['Total'] = $pharmaciesCumulative;

                // Coût total des pharmacies (E)
                if (!isset($data['Coût total des pharmacies (E)'][$month])) {
                    $data['Coût total des pharmacies (E)'][$month] = 0;
                }
                $data['Coût total des pharmacies (E)'][$month] += $prestation->montant;
                $data['Coût total des pharmacies (E)']['Total'] += $prestation->montant;


            }
        }

        // Calculer le cumul par mois pour B1
        foreach ($months as $index => $month) {
            if ($index > 0) {
                $data['Nombre de pharmacies Cumulée (B1)'][$month] = $data['Nombre de pharmacies Cumulée (B1)'][$months[$index - 1]] + $data['Nombre de pharmacies (B)'][$month];
            }

            // Cumul du coût total des pharmacies (E1)
            if ($index > 0) {
                $data['Coût Cumulé total des pharmacies (E1)'][$month] = $data['Coût Cumulé total des pharmacies (E1)'][$months[$index - 1]] + $data['Coût total des pharmacies (E)'][$month];
            } else {
                $data['Coût Cumulé total des pharmacies (E1)'][$month] = $data['Coût total des pharmacies (E)'][$month];
            }
            $data['Coût Cumulé total des pharmacies (E1)']['Total'] = $data['Coût Cumulé total des pharmacies (E1)'][$month] ;

            // Coût moyen cumulé d’une pharmacie (G)
            if ($data['Nombre de pharmacies Cumulée (B1)'][$month] > 0) {
                $data['Coût moyen cumulé d’une pharmacie (G)'][$month] = $data['Coût Cumulé total des pharmacies (E1)'][$month] / $data['Nombre de pharmacies Cumulée (B1)'][$month];
            }
        }
        if ($data['Nombre de pharmacies Cumulée (B1)']['Total'] > 0) {
            $data['Coût moyen cumulé d’une pharmacie (G)']['Total'] = $data['Coût Cumulé total des pharmacies (E1)']['Total']  / $data['Nombre de pharmacies Cumulée (B1)']['Total'];
        } else {
            $data['Coût moyen cumulé d’une pharmacie (G)']['Total'] = 0;
        }

        // Calcul des moyennes et taux d'utilisation
        foreach ($months as $index => $month) {
            $previousMonths = $index + 1;

            // Taux d’utilisation mensuel % (C)
            if ($data['Nombre de bénéficiaires (A)'][$month] > 0) {
                $data['Taux d’utilisation mensuel % C (C)'][$month] = number_format(($data['Nombre de pharmacies (B)'][$month] / $data['Nombre de bénéficiaires (A)'][$month])*$previousMonths * 100, 2);
            }
            if ($beneficiairesCumulative > 0) {
                $data['Taux d’utilisation mensuel % C (C)']['Total'] = number_format(($pharmaciesCumulative / $beneficiairesCumulative)*12 * 100, 2);
            } else {
                $data['Taux d’utilisation mensuel % C (C)']['Total'] = 0;
            }
            // Taux d’utilisation cumulée % (D)
            if ($data['Nombre moyen de bénéficiaire (A1)'][$month] > 0) {
                $data['Taux d’utilisation cumulée %(D)'][$month] = number_format(($data['Nombre de pharmacies Cumulée (B1)'][$month] / $data['Nombre moyen de bénéficiaire (A1)'][$month])*$previousMonths * 100, 2);

            }
            if ($data['Nombre moyen de bénéficiaire (A1)']['Total'] > 0) {
                $data['Taux d’utilisation cumulée %(D)']['Total'] = number_format(($pharmaciesCumulative / $data['Nombre moyen de bénéficiaire (A1)']['Total'])*12 * 100, 2);
            } else {
                $data['Taux d’utilisation cumulée %(D)']['Total'] = 0;
            }

            // Coût moyen mensuel d’une pharmacie (F)
            if ($data['Nombre de pharmacies (B)'][$month] > 0) {
                $data['Coût moyen mensuel d’une pharmacie (F)'][$month] = $data['Coût total des pharmacies (E)'][$month] / $data['Nombre de pharmacies (B)'][$month];
            }



        }
        if ($data['Nombre de pharmacies (B)']['Total'] > 0) {
            $data['Coût moyen mensuel d’une pharmacie (F)']['Total'] = $data['Coût total des pharmacies (E)']['Total']  / $data['Nombre de pharmacies (B)']['Total'];
        } else {
            $data['Coût moyen mensuel d’une pharmacie (F)']['Total'] = 0;
        }

		// Calcul des moyennes totales pour chaque catégorie
        foreach ($categories as $category) {
            $data[$category]['Moyenne'] = (float) ($data[$category]['Total'] ?? 0) / max(count($months), 1);
        }

        // Convertir les données pour Tabulator
        // Catégories nécessitant un affichage avec deux décimales (taux et coûts moyens)
        $categoriesWithDecimals = [
            'Taux d’utilisation mensuel % C (C)',
            'Taux d’utilisation cumulée %(D)',
            'Coût moyen mensuel d’une pharmacie (F)',
            'Coût moyen cumulé d’une pharmacie (G)',
        ];

        // Convertion
        $tabulatorData = [];
        foreach ($categories as $category) {
            $row = ['Category' => $category];
            foreach ($months as $month) {
                $value = $data[$category][$month];

                if (in_array($category, $categoriesWithDecimals) && is_numeric($value)) {
                    $row[$month] = number_format($value, 2, ',', ' ');
                } else {
                    $row[$month] = is_numeric($value) ? number_format($value, 0, ',', ' ') : $value;
                }
            }

            $totalValue = $data[$category]['Total'];
            $row['Total'] = in_array($category, $categoriesWithDecimals) && is_numeric($totalValue)
                ? number_format($totalValue, 2, ',', ' ')
                : (is_numeric($totalValue) ? number_format($totalValue, 0, ',', ' ') : $totalValue);

            $moyenneValue = $data[$category]['Moyenne'];
            $row['Moyenne'] = in_array($category, $categoriesWithDecimals) && is_numeric($moyenneValue)
                ? number_format($moyenneValue, 2, ',', ' ')
                : (is_numeric($moyenneValue) ? number_format($moyenneValue, 0, ',', ' ') : $moyenneValue);

            $row['Référence'] = $data[$category]['Référence'];
            $tabulatorData[] = $row;
        }

        $viewData = [
            'tabulatorData' => $tabulatorData,
            'currentYear' => $currentYear,
        ];

        return view('pages.backend.prestations.suivi-pharmacie', compact('tabulatorData', 'prestationsGroupedByAdherent', 'currentYear', 'prestationsAll', 'months' , 'data', 'pageTitle'));
    }

    public function suiviOptique(Request $request)
    {
        $pageTitle = 'Suivi des prestations';
        $currentYear = $request->input('year', Carbon::now()->year);
        $adherentCodes = Adherent::pluck('code_carte')->toArray();
        $prestationsAdherents = Prestation::join('adherents', 'prestations.adherentCode', '=', 'adherents.code_carte')
            ->whereYear('prestations.created_at', $currentYear)
            ->select('prestations.*', 'adherents.id as adherent_id')
            ->get();

        $prestationsAyantsDroit = Prestation::join('ayant_droits', 'prestations.adherentCode', '=', 'ayant_droits.code')
            ->join('adherents', 'ayant_droits.adherent_id', '=', 'adherents.id')
            ->whereYear('prestations.created_at', $currentYear)
            ->select('prestations.*', 'adherents.id as adherent_id')
            ->distinct()
            ->get();



        $prestationsAll = $prestationsAdherents->merge($prestationsAyantsDroit);


        $prestationsGroupedByAdherent = $prestationsAll->groupBy('adherent_id');

        $adherents = Adherent::whereYear('date_enregistrement', $currentYear)->get();
        $ayantsDroit = AyantDroit::join('adherents', 'ayant_droits.adherent_id', '=', 'adherents.id')
            ->whereYear('adherents.date_enregistrement', $currentYear)
            ->select('ayant_droits.*')
            ->get();
        $prestations = Prestation::whereYear('created_at', $currentYear)->get();
        $categories = [
            'Nombre de nouveaux bénéficiaires',
            'Nombre de bénéficiaires (A)',
            'Nombre moyen de bénéficiaire (A1)',
            'Nombre d’optiques (B)',
            'Nombre d’optiques Cumulée (B1)',
            'Taux d’utilisation mensuel % C (C)',
            'Taux d’utilisation cumulée %(D)',
            'Coût total des optiques (E)',
            'Coût Cumulé total des optiques (E1)',
            'Coût moyen mensuel d’une optique (F)',
            'Coût moyen cumulé d’une optique (G)'
        ];

        $months = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];

        $data = [];
        $optiquesCumulative = 0;
        $coutCumulative = 0;
        $beneficiairesCumulative = 0;
        $totalCoutCumulative = 0;

        foreach ($categories as $category) {
            foreach ($months as $month) {
                $data[$category][$month] = 0;
            }
            $data[$category]['Total'] = 0;
            $data[$category]['Moyenne'] = 0;
            $data[$category]['Référence'] = '';
        }

        // Nombre de bénéficiaires (adhérents + ayants droit)
        foreach ($adherents as $adherent) {
            $date = Carbon::parse($adherent->date_enregistrement);
            $month = $months[$date->month - 1];

            $data['Nombre de nouveaux bénéficiaires'][$month]++;
            $data['Nombre de nouveaux bénéficiaires']['Total']++;

            $data['Nombre de bénéficiaires (A)'][$month]++;
            $data['Nombre de bénéficiaires (A)']['Total']++;
        }

        foreach ($ayantsDroit as $ayantDroit) {
            $date = Carbon::parse($ayantDroit->adherent->date_enregistrement);
            $month = $months[$date->month - 1];

            // Nombre de bénéficiaires (A) par mois
            $data['Nombre de nouveaux bénéficiaires'][$month]++;
            $data['Nombre de nouveaux bénéficiaires']['Total']++;

            $data['Nombre de bénéficiaires (A)'][$month]++;
            $data['Nombre de bénéficiaires (A)']['Total']++;
        }

        // Calcul du cumul des bénéficiaires pour chaque mois
        foreach ($months as $index => $month) {
            $beneficiairesCumulative += $data['Nombre de bénéficiaires (A)'][$month];
            $data['Nombre de bénéficiaires (A)'][$month] = $beneficiairesCumulative;

            // Calculer A1 = A / nombre de mois déjà écoulés
            $data['Nombre moyen de bénéficiaire (A1)'][$month] = floor($beneficiairesCumulative / ($index + 1));
            $data['Nombre moyen de bénéficiaire (A1)']['Total'] = $data['Nombre moyen de bénéficiaire (A1)'][$month];
        }

        // Calculer les statistiques à pfartir des prestations
        foreach ($prestations as $prestation) {
            $date = Carbon::parse($prestation->created_at);
            $month = $months[$date->month - 1];

            // Nombre d’optiques (B)
            if ($prestation->acte == 'optique') {
                $data['Nombre d’optiques (B)'][$month]++;
                $data['Nombre d’optiques (B)']['Total']++;

                // Cumul des optiques (B1)
                $optiquesCumulative++;
                $data['Nombre d’optiques Cumulée (B1)'][$month] = $optiquesCumulative;
                $data['Nombre d’optiques Cumulée (B1)']['Total'] = $optiquesCumulative;

                // Coût total des optiques (E)
                if (!isset($data['Coût total des optiques (E)'][$month])) {
                    $data['Coût total des optiques (E)'][$month] = 0;
                }
                $data['Coût total des optiques (E)'][$month] += $prestation->montant;
                $data['Coût total des optiques (E)']['Total'] += $prestation->montant;


            }
        }

        // Calculer le cumul par mois pour B1
        foreach ($months as $index => $month) {
            if ($index > 0) {
                $data['Nombre d’optiques Cumulée (B1)'][$month] = $data['Nombre d’optiques Cumulée (B1)'][$months[$index - 1]] + $data['Nombre d’optiques (B)'][$month];
            }

            // Cumul du coût total des optiques (E1)
            if ($index > 0) {
                $data['Coût Cumulé total des optiques (E1)'][$month] = $data['Coût Cumulé total des optiques (E1)'][$months[$index - 1]] + $data['Coût total des optiques (E)'][$month];
            } else {
                $data['Coût Cumulé total des optiques (E1)'][$month] = $data['Coût total des optiques (E)'][$month];
            }
            $data['Coût Cumulé total des optiques (E1)']['Total'] = $data['Coût Cumulé total des optiques (E1)'][$month] ;

            // Coût moyen cumulé d’une optique (G)
            if ($data['Nombre d’optiques Cumulée (B1)'][$month] > 0) {
                $data['Coût moyen cumulé d’une optique (G)'][$month] = $data['Coût Cumulé total des optiques (E1)'][$month] / $data['Nombre d’optiques Cumulée (B1)'][$month];
            }
        }
        if ($data['Nombre d’optiques Cumulée (B1)']['Total'] > 0) {
            $data['Coût moyen cumulé d’une optique (G)']['Total'] = $data['Coût Cumulé total des optiques (E1)']['Total']  / $data['Nombre d’optiques Cumulée (B1)']['Total'];
        } else {
            $data['Coût moyen cumulé d’une optique (G)']['Total'] = 0;
        }

        // Calcul des moyennes et taux d'utilisation
        foreach ($months as $index => $month) {
            $previousMonths = $index + 1;

            // Taux d’utilisation mensuel % (C)
            if ($data['Nombre de bénéficiaires (A)'][$month] > 0) {
                $data['Taux d’utilisation mensuel % C (C)'][$month] = number_format(($data['Nombre d’optiques (B)'][$month] / $data['Nombre de bénéficiaires (A)'][$month])*$previousMonths * 100, 2);
            }
            if ($beneficiairesCumulative > 0) {
                $data['Taux d’utilisation mensuel % C (C)']['Total'] = number_format(($optiquesCumulative / $beneficiairesCumulative)*12 * 100, 2);
            } else {
                $data['Taux d’utilisation mensuel % C (C)']['Total'] = 0;
            }
            // Taux d’utilisation cumulée % (D)
            if ($data['Nombre moyen de bénéficiaire (A1)'][$month] > 0) {
                $data['Taux d’utilisation cumulée %(D)'][$month] = number_format(($data['Nombre d’optiques Cumulée (B1)'][$month] / $data['Nombre moyen de bénéficiaire (A1)'][$month])*$previousMonths * 100, 2);

            }
            if ($data['Nombre moyen de bénéficiaire (A1)']['Total'] > 0) {
                $data['Taux d’utilisation cumulée %(D)']['Total'] = number_format(($optiquesCumulative / $data['Nombre moyen de bénéficiaire (A1)']['Total'])*12 * 100, 2);
            } else {
                $data['Taux d’utilisation cumulée %(D)']['Total'] = 0;
            }

            // Coût moyen mensuel d’une optique (F)
            if ($data['Nombre d’optiques (B)'][$month] > 0) {
                $data['Coût moyen mensuel d’une optique (F)'][$month] = $data['Coût total des optiques (E)'][$month] / $data['Nombre d’optiques (B)'][$month];
            }



        }
        if ($data['Nombre d’optiques (B)']['Total'] > 0) {
            $data['Coût moyen mensuel d’une optique (F)']['Total'] = $data['Coût total des optiques (E)']['Total']  / $data['Nombre d’optiques (B)']['Total'];
        } else {
            $data['Coût moyen mensuel d’une optique (F)']['Total'] = 0;
        }

		// Calcul des moyennes totales pour chaque catégorie
        foreach ($categories as $category) {
            $data[$category]['Moyenne'] = (float) ($data[$category]['Total'] ?? 0) / max(count($months), 1);
        }

        // Convertir les données pour Tabulator
        // Catégories nécessitant un affichage avec deux décimales (taux et coûts moyens)
        $categoriesWithDecimals = [
            'Taux d’utilisation mensuel % C (C)',
            'Taux d’utilisation cumulée %(D)',
            'Coût moyen mensuel d’une optique (F)',
            'Coût moyen cumulé d’une optique (G)',
        ];

        // Convertion
        $tabulatorData = [];
        foreach ($categories as $category) {
            $row = ['Category' => $category];
            foreach ($months as $month) {
                $value = $data[$category][$month];

                if (in_array($category, $categoriesWithDecimals) && is_numeric($value)) {
                    $row[$month] = number_format($value, 2, ',', ' ');
                } else {
                    $row[$month] = is_numeric($value) ? number_format($value, 0, ',', ' ') : $value;
                }
            }

            $totalValue = $data[$category]['Total'];
            $row['Total'] = in_array($category, $categoriesWithDecimals) && is_numeric($totalValue)
                ? number_format($totalValue, 2, ',', ' ')
                : (is_numeric($totalValue) ? number_format($totalValue, 0, ',', ' ') : $totalValue);

            $moyenneValue = $data[$category]['Moyenne'];
            $row['Moyenne'] = in_array($category, $categoriesWithDecimals) && is_numeric($moyenneValue)
                ? number_format($moyenneValue, 2, ',', ' ')
                : (is_numeric($moyenneValue) ? number_format($moyenneValue, 0, ',', ' ') : $moyenneValue);

            $row['Référence'] = $data[$category]['Référence'];
            $tabulatorData[] = $row;
        }

        $viewData = [
            'tabulatorData' => $tabulatorData,
            'currentYear' => $currentYear,
        ];

        return view('pages.backend.prestations.suivi-optique', compact('tabulatorData', 'prestationsGroupedByAdherent', 'currentYear', 'prestationsAll', 'months' , 'data', 'pageTitle'));
    }

    public function suiviDentaireAuditif(Request $request)
    {
        $pageTitle = 'Suivi des prestations';
        $currentYear = $request->input('year', Carbon::now()->year);
        $adherentCodes = Adherent::pluck('code_carte')->toArray();
        $prestationsAdherents = Prestation::join('adherents', 'prestations.adherentCode', '=', 'adherents.code_carte')
            ->whereYear('prestations.created_at', $currentYear)
            ->select('prestations.*', 'adherents.id as adherent_id')
            ->get();

        $prestationsAyantsDroit = Prestation::join('ayant_droits', 'prestations.adherentCode', '=', 'ayant_droits.code')
            ->join('adherents', 'ayant_droits.adherent_id', '=', 'adherents.id')
            ->whereYear('prestations.created_at', $currentYear)
            ->select('prestations.*', 'adherents.id as adherent_id')
            ->distinct()
            ->get();



        $prestationsAll = $prestationsAdherents->merge($prestationsAyantsDroit);


        $prestationsGroupedByAdherent = $prestationsAll->groupBy('adherent_id');

        $adherents = Adherent::whereYear('date_enregistrement', $currentYear)->get();
        $ayantsDroit = AyantDroit::join('adherents', 'ayant_droits.adherent_id', '=', 'adherents.id')
            ->whereYear('adherents.date_enregistrement', $currentYear)
            ->select('ayant_droits.*')
            ->get();
        $prestations = Prestation::whereYear('created_at', $currentYear)->get();
        $categories = [
            'Nombre de nouveaux bénéficiaires',
            'Nombre de bénéficiaires (A)',
            'Nombre moyen de bénéficiaire (A1)',
            'Nombre de dentaires et auditifs (B)',
            'Nombre de dentaires et auditifs Cumulée (B1)',
            'Taux d’utilisation mensuel % C (C)',
            'Taux d’utilisation cumulée %(D)',
            'Coût total des dentaires et auditifs (E)',
            'Coût Cumulé total des dentaires et auditifs (E1)',
            'Coût moyen mensuel d’une dentaire et auditif (F)',
            'Coût moyen cumulé d’une dentaire et auditif (G)'
        ];

        $months = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];

        $data = [];
        $dentairesAuditifsCumulative = 0;
        $coutCumulative = 0;
        $beneficiairesCumulative = 0;
        $totalCoutCumulative = 0;

        foreach ($categories as $category) {
            foreach ($months as $month) {
                $data[$category][$month] = 0;
            }
            $data[$category]['Total'] = 0;
            $data[$category]['Moyenne'] = 0;
            $data[$category]['Référence'] = '';
        }

        // Nombre de bénéficiaires (adhérents + ayants droit)
        foreach ($adherents as $adherent) {
            $date = Carbon::parse($adherent->date_enregistrement);
            $month = $months[$date->month - 1];

            $data['Nombre de nouveaux bénéficiaires'][$month]++;
            $data['Nombre de nouveaux bénéficiaires']['Total']++;

            $data['Nombre de bénéficiaires (A)'][$month]++;
            $data['Nombre de bénéficiaires (A)']['Total']++;
        }

        foreach ($ayantsDroit as $ayantDroit) {
            $date = Carbon::parse($ayantDroit->adherent->date_enregistrement);
            $month = $months[$date->month - 1];

            // Nombre de bénéficiaires (A) par mois
            $data['Nombre de nouveaux bénéficiaires'][$month]++;
            $data['Nombre de nouveaux bénéficiaires']['Total']++;

            $data['Nombre de bénéficiaires (A)'][$month]++;
            $data['Nombre de bénéficiaires (A)']['Total']++;
        }

        // Calcul du cumul des bénéficiaires pour chaque mois
        foreach ($months as $index => $month) {
            $beneficiairesCumulative += $data['Nombre de bénéficiaires (A)'][$month];
            $data['Nombre de bénéficiaires (A)'][$month] = $beneficiairesCumulative;

            // Calculer A1 = A / nombre de mois déjà écoulés
            $data['Nombre moyen de bénéficiaire (A1)'][$month] = floor($beneficiairesCumulative / ($index + 1));
            $data['Nombre moyen de bénéficiaire (A1)']['Total'] = $data['Nombre moyen de bénéficiaire (A1)'][$month];
        }

        // Calculer les statistiques à pfartir des prestations
        foreach ($prestations as $prestation) {
            $date = Carbon::parse($prestation->created_at);
            $month = $months[$date->month - 1];

            // Nombre de dentaires et auditifs (B)
            if ($prestation->acte == 'dentaire_auditif') {
                $data['Nombre de dentaires et auditifs (B)'][$month]++;
                $data['Nombre de dentaires et auditifs (B)']['Total']++;

                // Cumul des dentaires et auditifs (B1)
                $dentairesAuditifsCumulative++;
                $data['Nombre de dentaires et auditifs Cumulée (B1)'][$month] = $dentairesAuditifsCumulative;
                $data['Nombre de dentaires et auditifs Cumulée (B1)']['Total'] = $dentairesAuditifsCumulative;

                // Coût total des dentaires et auditifs (E)
                if (!isset($data['Coût total des dentaires et auditifs (E)'][$month])) {
                    $data['Coût total des dentaires et auditifs (E)'][$month] = 0;
                }
                $data['Coût total des dentaires et auditifs (E)'][$month] += $prestation->montant;
                $data['Coût total des dentaires et auditifs (E)']['Total'] += $prestation->montant;


            }
        }

        // Calculer le cumul par mois pour B1
        foreach ($months as $index => $month) {
            if ($index > 0) {
                $data['Nombre de dentaires et auditifs Cumulée (B1)'][$month] = $data['Nombre de dentaires et auditifs Cumulée (B1)'][$months[$index - 1]] + $data['Nombre de dentaires et auditifs (B)'][$month];
            }

            // Cumul du coût total des dentaires et auditifs (E1)
            if ($index > 0) {
                $data['Coût Cumulé total des dentaires et auditifs (E1)'][$month] = $data['Coût Cumulé total des dentaires et auditifs (E1)'][$months[$index - 1]] + $data['Coût total des dentaires et auditifs (E)'][$month];
            } else {
                $data['Coût Cumulé total des dentaires et auditifs (E1)'][$month] = $data['Coût total des dentaires et auditifs (E)'][$month];
            }
            $data['Coût Cumulé total des dentaires et auditifs (E1)']['Total'] = $data['Coût Cumulé total des dentaires et auditifs (E1)'][$month] ;

            // Coût moyen cumulé d’une dentaire et auditif (G)
            if ($data['Nombre de dentaires et auditifs Cumulée (B1)'][$month] > 0) {
                $data['Coût moyen cumulé d’une dentaire et auditif (G)'][$month] = $data['Coût Cumulé total des dentaires et auditifs (E1)'][$month] / $data['Nombre de dentaires et auditifs Cumulée (B1)'][$month];
            }
        }
        if ($data['Nombre de dentaires et auditifs Cumulée (B1)']['Total'] > 0) {
            $data['Coût moyen cumulé d’une dentaire et auditif (G)']['Total'] = $data['Coût Cumulé total des dentaires et auditifs (E1)']['Total']  / $data['Nombre de dentaires et auditifs Cumulée (B1)']['Total'];
        } else {
            $data['Coût moyen cumulé d’une dentaire et auditif (G)']['Total'] = 0;
        }

        // Calcul des moyennes et taux d'utilisation
        foreach ($months as $index => $month) {
            $previousMonths = $index + 1;

            // Taux d’utilisation mensuel % (C)
            if ($data['Nombre de bénéficiaires (A)'][$month] > 0) {
                $data['Taux d’utilisation mensuel % C (C)'][$month] = number_format(($data['Nombre de dentaires et auditifs (B)'][$month] / $data['Nombre de bénéficiaires (A)'][$month])*$previousMonths * 100, 2);
            }
            if ($beneficiairesCumulative > 0) {
                $data['Taux d’utilisation mensuel % C (C)']['Total'] = number_format(($dentairesAuditifsCumulative / $beneficiairesCumulative)*12 * 100, 2);
            } else {
                $data['Taux d’utilisation mensuel % C (C)']['Total'] = 0;
            }
            // Taux d’utilisation cumulée % (D)
            if ($data['Nombre moyen de bénéficiaire (A1)'][$month] > 0) {
                $data['Taux d’utilisation cumulée %(D)'][$month] = number_format(($data['Nombre de dentaires et auditifs Cumulée (B1)'][$month] / $data['Nombre moyen de bénéficiaire (A1)'][$month])*$previousMonths * 100, 2);

            }
            if ($data['Nombre moyen de bénéficiaire (A1)']['Total'] > 0) {
                $data['Taux d’utilisation cumulée %(D)']['Total'] = number_format(($dentairesAuditifsCumulative / $data['Nombre moyen de bénéficiaire (A1)']['Total'])*12 * 100, 2);
            } else {
                $data['Taux d’utilisation cumulée %(D)']['Total'] = 0;
            }

            // Coût moyen mensuel d’une dentaire et auditif (F)
            if ($data['Nombre de dentaires et auditifs (B)'][$month] > 0) {
                $data['Coût moyen mensuel d’une dentaire et auditif (F)'][$month] = $data['Coût total des dentaires et auditifs (E)'][$month] / $data['Nombre de dentaires et auditifs (B)'][$month];
            }



        }
        if ($data['Nombre de dentaires et auditifs (B)']['Total'] > 0) {
            $data['Coût moyen mensuel d’une dentaire et auditif (F)']['Total'] = $data['Coût total des dentaires et auditifs (E)']['Total']  / $data['Nombre de dentaires et auditifs (B)']['Total'];
        } else {
            $data['Coût moyen mensuel d’une dentaire et auditif (F)']['Total'] = 0;
        }

		// Calcul des moyennes totales pour chaque catégorie
        foreach ($categories as $category) {
            $data[$category]['Moyenne'] = (float) ($data[$category]['Total'] ?? 0) / max(count($months), 1);
        }

        // Convertir les données pour Tabulator
        // Catégories nécessitant un affichage avec deux décimales (taux et coûts moyens)
        $categoriesWithDecimals = [
            'Taux d’utilisation mensuel % C (C)',
            'Taux d’utilisation cumulée %(D)',
            'Coût moyen mensuel d’une dentaire et auditif (F)',
            'Coût moyen cumulé d’une dentaire et auditif (G)',
        ];

        // Convertion
        $tabulatorData = [];
        foreach ($categories as $category) {
            $row = ['Category' => $category];
            foreach ($months as $month) {
                $value = $data[$category][$month];

                if (in_array($category, $categoriesWithDecimals) && is_numeric($value)) {
                    $row[$month] = number_format($value, 2, ',', ' ');
                } else {
                    $row[$month] = is_numeric($value) ? number_format($value, 0, ',', ' ') : $value;
                }
            }

            $totalValue = $data[$category]['Total'];
            $row['Total'] = in_array($category, $categoriesWithDecimals) && is_numeric($totalValue)
                ? number_format($totalValue, 2, ',', ' ')
                : (is_numeric($totalValue) ? number_format($totalValue, 0, ',', ' ') : $totalValue);

            $moyenneValue = $data[$category]['Moyenne'];
            $row['Moyenne'] = in_array($category, $categoriesWithDecimals) && is_numeric($moyenneValue)
                ? number_format($moyenneValue, 2, ',', ' ')
                : (is_numeric($moyenneValue) ? number_format($moyenneValue, 0, ',', ' ') : $moyenneValue);

            $row['Référence'] = $data[$category]['Référence'];
            $tabulatorData[] = $row;
        }

        $viewData = [
            'tabulatorData' => $tabulatorData,
            'currentYear' => $currentYear,
        ];

        return view('pages.backend.prestations.suivi-dentaire-auditif', compact('tabulatorData', 'prestationsGroupedByAdherent', 'currentYear', 'prestationsAll', 'months' , 'data', 'pageTitle'));
    }

    public function suiviAutre(Request $request)
    {
        $pageTitle = 'Suivi des prestations';
        $currentYear = $request->input('year', Carbon::now()->year);
        $adherentCodes = Adherent::pluck('code_carte')->toArray();
        $prestationsAdherents = Prestation::join('adherents', 'prestations.adherentCode', '=', 'adherents.code_carte')
            ->whereYear('prestations.created_at', $currentYear)
            ->select('prestations.*', 'adherents.id as adherent_id')
            ->get();

        $prestationsAyantsDroit = Prestation::join('ayant_droits', 'prestations.adherentCode', '=', 'ayant_droits.code')
            ->join('adherents', 'ayant_droits.adherent_id', '=', 'adherents.id')
            ->whereYear('prestations.created_at', $currentYear)
            ->select('prestations.*', 'adherents.id as adherent_id')
            ->distinct()
            ->get();



        $prestationsAll = $prestationsAdherents->merge($prestationsAyantsDroit);


        $prestationsGroupedByAdherent = $prestationsAll->groupBy('adherent_id');

        $adherents = Adherent::whereYear('date_enregistrement', $currentYear)->get();
        $ayantsDroit = AyantDroit::join('adherents', 'ayant_droits.adherent_id', '=', 'adherents.id')
            ->whereYear('adherents.date_enregistrement', $currentYear)
            ->select('ayant_droits.*')
            ->get();
        $prestations = Prestation::whereYear('created_at', $currentYear)->get();
        $categories = [
            'Nombre de nouveaux bénéficiaires',
            'Nombre de bénéficiaires (A)',
            'Nombre moyen de bénéficiaire (A1)',
            'Nombre autres (B)',
            'Nombre autres Cumulée (B1)',
            'Taux d’utilisation mensuel % C (C)',
            'Taux d’utilisation cumulée %(D)',
            'Coût total des autres (E)',
            'Coût Cumulé total des autres (E1)',
            'Coût moyen mensuel d’un autre (F)',
            'Coût moyen cumulé d’un autre (G)'
        ];

        $months = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];

        $data = [];
        $autresCumulative = 0;
        $coutCumulative = 0;
        $beneficiairesCumulative = 0;
        $totalCoutCumulative = 0;

        foreach ($categories as $category) {
            foreach ($months as $month) {
                $data[$category][$month] = 0;
            }
            $data[$category]['Total'] = 0;
            $data[$category]['Moyenne'] = 0;
            $data[$category]['Référence'] = '';
        }

        // Nombre de bénéficiaires (adhérents + ayants droit)
        foreach ($adherents as $adherent) {
            $date = Carbon::parse($adherent->date_enregistrement);
            $month = $months[$date->month - 1];

            $data['Nombre de nouveaux bénéficiaires'][$month]++;
            $data['Nombre de nouveaux bénéficiaires']['Total']++;

            $data['Nombre de bénéficiaires (A)'][$month]++;
            $data['Nombre de bénéficiaires (A)']['Total']++;
        }

        foreach ($ayantsDroit as $ayantDroit) {
            $date = Carbon::parse($ayantDroit->adherent->date_enregistrement);
            $month = $months[$date->month - 1];

            // Nombre de bénéficiaires (A) par mois
            $data['Nombre de nouveaux bénéficiaires'][$month]++;
            $data['Nombre de nouveaux bénéficiaires']['Total']++;

            $data['Nombre de bénéficiaires (A)'][$month]++;
            $data['Nombre de bénéficiaires (A)']['Total']++;
        }

        // Calcul du cumul des bénéficiaires pour chaque mois
        foreach ($months as $index => $month) {
            $beneficiairesCumulative += $data['Nombre de bénéficiaires (A)'][$month];
            $data['Nombre de bénéficiaires (A)'][$month] = $beneficiairesCumulative;

            // Calculer A1 = A / nombre de mois déjà écoulés
            $data['Nombre moyen de bénéficiaire (A1)'][$month] = floor($beneficiairesCumulative / ($index + 1));
            $data['Nombre moyen de bénéficiaire (A1)']['Total'] = $data['Nombre moyen de bénéficiaire (A1)'][$month];
        }

        // Calculer les statistiques à pfartir des prestations
        foreach ($prestations as $prestation) {
            $date = Carbon::parse($prestation->created_at);
            $month = $months[$date->month - 1];

            // Nombre autres (B)
            if ($prestation->acte == 'autre') {
                $data['Nombre autres (B)'][$month]++;
                $data['Nombre autres (B)']['Total']++;

                // Cumul des autre (B1)
                $autresCumulative++;
                $data['Nombre autres Cumulée (B1)'][$month] = $autresCumulative;
                $data['Nombre autres Cumulée (B1)']['Total'] = $autresCumulative;

                // Coût total des autres (E)
                if (!isset($data['Coût total des autres (E)'][$month])) {
                    $data['Coût total des autres (E)'][$month] = 0;
                }
                $data['Coût total des autres (E)'][$month] += $prestation->montant;
                $data['Coût total des autres (E)']['Total'] += $prestation->montant;


            }
        }

        // Calculer le cumul par mois pour B1
        foreach ($months as $index => $month) {
            if ($index > 0) {
                $data['Nombre autres Cumulée (B1)'][$month] = $data['Nombre autres Cumulée (B1)'][$months[$index - 1]] + $data['Nombre autres (B)'][$month];
            }

            // Cumul du coût total des autres (E1)
            if ($index > 0) {
                $data['Coût Cumulé total des autres (E1)'][$month] = $data['Coût Cumulé total des autres (E1)'][$months[$index - 1]] + $data['Coût total des autres (E)'][$month];
            } else {
                $data['Coût Cumulé total des autres (E1)'][$month] = $data['Coût total des autres (E)'][$month];
            }
            $data['Coût Cumulé total des autres (E1)']['Total'] = $data['Coût Cumulé total des autres (E1)'][$month] ;

            // Coût moyen cumulé d’un autre (G)
            if ($data['Nombre autres Cumulée (B1)'][$month] > 0) {
                $data['Coût moyen cumulé d’un autre (G)'][$month] = $data['Coût Cumulé total des autres (E1)'][$month] / $data['Nombre autres Cumulée (B1)'][$month];
            }
        }
        if ($data['Nombre autres Cumulée (B1)']['Total'] > 0) {
            $data['Coût moyen cumulé d’un autre (G)']['Total'] = $data['Coût Cumulé total des autres (E1)']['Total']  / $data['Nombre autres Cumulée (B1)']['Total'];
        } else {
            $data['Coût moyen cumulé d’un autre (G)']['Total'] = 0;
        }

        // Calcul des moyennes et taux d'utilisation
        foreach ($months as $index => $month) {
            $previousMonths = $index + 1;

            // Taux d’utilisation mensuel % (C)
            if ($data['Nombre de bénéficiaires (A)'][$month] > 0) {
                $data['Taux d’utilisation mensuel % C (C)'][$month] = number_format(($data['Nombre autres (B)'][$month] / $data['Nombre de bénéficiaires (A)'][$month])*$previousMonths * 100, 2);
            }
            if ($beneficiairesCumulative > 0) {
                $data['Taux d’utilisation mensuel % C (C)']['Total'] = number_format(($autresCumulative / $beneficiairesCumulative)*12 * 100, 2);
            } else {
                $data['Taux d’utilisation mensuel % C (C)']['Total'] = 0;
            }
            // Taux d’utilisation cumulée % (D)
            if ($data['Nombre moyen de bénéficiaire (A1)'][$month] > 0) {
                $data['Taux d’utilisation cumulée %(D)'][$month] = number_format(($data['Nombre autres Cumulée (B1)'][$month] / $data['Nombre moyen de bénéficiaire (A1)'][$month])*$previousMonths * 100, 2);

            }
            if ($data['Nombre moyen de bénéficiaire (A1)']['Total'] > 0) {
                $data['Taux d’utilisation cumulée %(D)']['Total'] = number_format(($autresCumulative / $data['Nombre moyen de bénéficiaire (A1)']['Total'])*12 * 100, 2);
            } else {
                $data['Taux d’utilisation cumulée %(D)']['Total'] = 0;
            }

            // Coût moyen mensuel d’un autre (F)
            if ($data['Nombre autres (B)'][$month] > 0) {
                $data['Coût moyen mensuel d’un autre (F)'][$month] = $data['Coût total des autres (E)'][$month] / $data['Nombre autres (B)'][$month];
            }



        }
        if ($data['Nombre autres (B)']['Total'] > 0) {
            $data['Coût moyen mensuel d’un autre (F)']['Total'] = $data['Coût total des autres (E)']['Total']  / $data['Nombre autres (B)']['Total'];
        } else {
            $data['Coût moyen mensuel d’un autre (F)']['Total'] = 0;
        }

		// Calcul des moyennes totales pour chaque catégorie
        foreach ($categories as $category) {
            $data[$category]['Moyenne'] = (float) ($data[$category]['Total'] ?? 0) / max(count($months), 1);
        }

        // Convertir les données pour Tabulator
        // Catégories nécessitant un affichage avec deux décimales (taux et coûts moyens)
        $categoriesWithDecimals = [
            'Taux d’utilisation mensuel % C (C)',
            'Taux d’utilisation cumulée %(D)',
            'Coût moyen mensuel d’un autre (F)',
            'Coût moyen cumulé d’un autre (G)',
        ];

        // Convertion
        $tabulatorData = [];
        foreach ($categories as $category) {
            $row = ['Category' => $category];
            foreach ($months as $month) {
                $value = $data[$category][$month];

                if (in_array($category, $categoriesWithDecimals) && is_numeric($value)) {
                    $row[$month] = number_format($value, 2, ',', ' ');
                } else {
                    $row[$month] = is_numeric($value) ? number_format($value, 0, ',', ' ') : $value;
                }
            }

            $totalValue = $data[$category]['Total'];
            $row['Total'] = in_array($category, $categoriesWithDecimals) && is_numeric($totalValue)
                ? number_format($totalValue, 2, ',', ' ')
                : (is_numeric($totalValue) ? number_format($totalValue, 0, ',', ' ') : $totalValue);

            $moyenneValue = $data[$category]['Moyenne'];
            $row['Moyenne'] = in_array($category, $categoriesWithDecimals) && is_numeric($moyenneValue)
                ? number_format($moyenneValue, 2, ',', ' ')
                : (is_numeric($moyenneValue) ? number_format($moyenneValue, 0, ',', ' ') : $moyenneValue);

            $row['Référence'] = $data[$category]['Référence'];
            $tabulatorData[] = $row;
        }

        $viewData = [
            'tabulatorData' => $tabulatorData,
            'currentYear' => $currentYear,
        ];

        return view('pages.backend.prestations.suivi-autre', compact('tabulatorData', 'prestationsGroupedByAdherent', 'currentYear', 'prestationsAll', 'months' , 'data', 'pageTitle'));
    }

}

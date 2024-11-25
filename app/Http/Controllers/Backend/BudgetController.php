<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;

use App\Models\Categorie;
use App\Models\Recette;
use App\Models\Depense;
use App\Models\Estimatione;
use Illuminate\Http\Request;

class BudgetController extends Controller
{
    public function index(Request $request)
    {
        $breadcrumbsItems = [
            [
                'name' => 'Suivi',
                'url' => route('budget-suivi.index'),
                'active' => true
            ],
        ];
        $pageTitle = 'Suivi du budget';

        // Année sélectionnée par défaut (année en cours si non spécifiée)
        $year = $request->get('year', date('Y'));

        // Récupération des catégories
        $categories = Categorie::with(['children'])->get();
        $categories = Categorie::with('children')->whereIn('type', ['recette', 'depense'])->get();

        // Récupération des estimations pour l'année en cours
        $estimations = Estimatione::where('annee', $year)->get();

        // Calculer les montants prévus par catégorie et sous-catégorie
        $categories = $categories->map(function ($categorie) use ($estimations) {
            $categorie->montant_prevu = $estimations->where('categorie_id', $categorie->uuid)->sum('montant');

            // Calculer pour les sous-catégories
            $categorie->children = $categorie->children->map(function ($sousCategorie) use ($estimations) {
                $sousCategorie->montant_prevu = $estimations->where('sous_categorie_id', $sousCategorie->uuid)->sum('montant');
                return $sousCategorie;
            });

            return $categorie;
        });

        // Filtrer les recettes et dépenses par année
        $recettes = Recette::whereYear('date', $year)->get();
        $depenses = Depense::whereYear('date', $year)->get();

        $montantsParTrimestre = $this->getMontantsParTrimestre($recettes, $depenses, $year);

        return view('pages.backend.comptabilite.budget-suivi.index', compact(
            'breadcrumbsItems', 'pageTitle', 'recettes', 'depenses', 'year', 'categories', 'montantsParTrimestre'
        ));
    }


    private function getMontantsParTrimestre($recettes, $depenses, $year)
    {
        $transactions = $recettes->merge($depenses);  
        return $transactions->groupBy(function ($item) {
            return ceil(date('n', strtotime($item->date)) / 3); // Regrouper par trimestre
        })->map(function ($group) {
            return $group->sum('montant');
        });
    }
}


<?php

namespace App\Http\Controllers;

use App\Models\Adherant;
use App\Models\Categorie;
use App\Models\Recette;
use Illuminate\Http\Request;

class CaisseController extends Controller
{
    public function index(Request $request)
    {
        $breadcrumbsItems = [
            [
                'name' => 'Caisse',
                'url' => route('caisse.index'),
                'active' => true
            ],
            
        ];
        $pageTitle = 'Ensembles des caisses ';

        $year = $request->input('year', date('Y')); 

        $categories = Categorie::where('type', 'recette')->get();

        $recettes = Recette::whereYear('date', $year)->get();

        $data = [];
        
        foreach ($categories as $categorie) {
            $total = $recettes->where('categorie_id', $categorie->id)->sum('montant');
            dd($total);

            foreach ($categorie->children as $child) {
                $total += $recettes->where('categorie_id', $child->id)->sum('montant');
            }
            $test = 
            $data[$categorie->nom] = $total;
        }
        
        // $test = []; // Initialisation du tableau test

        // foreach ($categories as $categorie) {
        //     // Récupération des recettes pour la catégorie actuelle
        //     $recettesPourCategorie = $recettes->where('categorie_id', $categorie->uuid);
            
        //     // Conversion des montants en float et calcul de la somme
        //     $total = $recettesPourCategorie->sum(function ($recette) {
        //         return (float) $recette->montant; // Conversion en float pour garantir des calculs corrects
        //     });

        //     // Ajout des montants individuels pour la catégorie principale dans le tableau test
        //     $test[$categorie->nom] = [
        //         'total' => $total,
        //         'montants' => $recettesPourCategorie->pluck('montant')->map(function ($montant) {
        //             return (float) $montant; // Conversion en float pour chaque montant individuel
        //         })->toArray() // Récupère les montants sous forme de tableau
        //     ];

        //     // Parcours des enfants de la catégorie
        //     foreach ($categorie->children as $child) {
        //         // Récupération des recettes pour l'enfant
        //         $recettesPourChild = $recettes->where('categorie_id', $child->id);
                
        //         // Conversion des montants en float et calcul de la somme pour l'enfant
        //         $childTotal = $recettesPourChild->sum(function ($recette) {
        //             return (float) $recette->montant; // Conversion en float
        //         });
                
        //         // Ajout des montants individuels pour chaque enfant dans le tableau test
        //         $test[$categorie->nom . ' - ' . $child->nom] = [
        //             'total' => $childTotal,
        //             'montants' => $recettesPourChild->pluck('montant')->map(function ($montant) {
        //                 return (float) $montant; // Conversion en float pour chaque montant individuel
        //             })->toArray() // Récupère les montants sous forme de tableau
        //         ];
        //     }

        //     // Ajout du total global pour la catégorie dans les données finales
        //     $data[$categorie->nom] = $total;
        // }

        // // Affichage du tableau test pour vérification
        // dd($test);



        




        $regionsPath = public_path('regions.json');
        $regions = json_decode(file_get_contents($regionsPath), true);

        $adherents = Adherant::all();

        $adherentsParRegion = $adherents->groupBy('region');

        $adherentsCountPerRegion = [];

        foreach ($regions as $regionName => $regionData) {
            $adherentsCountPerRegion[$regionName] = $adherentsParRegion->get($regionName, collect())->count();
        }

        return view('pages.backend.comptabilite.caisse.index', compact('pageTitle', 'breadcrumbsItems', 'data', 'year', 'categories' , 'adherents', 'adherentsCountPerRegion', 'regions'));


    }
}

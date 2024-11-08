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

        $categories = Categorie::where('type', 'recette')->whereNull('parent_id')->get();

        $recettes = Recette::whereYear('date', $year)->get();

        $data = [];
        foreach ($categories as $categorie) {
            $total = $recettes->where('categorie_id', $categorie->id)->sum('montant');
          

            foreach ($categorie->children as $child) {
                $total += $recettes->where('categorie_id', $child->id)->sum('montant');
            }

            $data[$categorie->nom] = $total;
        }

    
        dd($data);

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

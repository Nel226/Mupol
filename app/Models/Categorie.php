<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Categorie extends Model
{
    use HasUuids;

    protected $primaryKey = 'uuid';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['nom', 'type', 'parent_id'];


    public function recettes()
    {
        return $this->hasMany(Recette::class, 'categorie_id', 'uuid');
    }

    public function depenses()
    {
        return $this->hasMany(Depense::class, 'categorie_id', 'uuid');
    }

    public function sousCategories()
    {
        return $this->hasMany(Categorie::class, 'parent_id', 'uuid');
    }
    


    public function parent()
    {
        return $this->belongsTo(Categorie::class, 'parent_id', 'uuid');
    }
    public function children()
    {
        return $this->hasMany(Categorie::class, 'parent_id', 'uuid');
    }
    public function getSubcategoriesCountAttribute()
    {
        return $this->sousCategories()->count();
    }

    public function totalParTrimestre($type, $year)
    {
        $model = $type === 'recette' ? Recette::class : Depense::class;

        // Obtenez les montants totaux par trimestre pour cette catégorie en fonction de l'année
        return [
            'trimestre_1' => $model::where('categorie_id', $this->uuid)
                ->whereYear('date', $year)
                ->whereMonth('date', '<=', 3)
                ->sum('montant'),
            'trimestre_2' => $model::where('categorie_id', $this->uuid)
                ->whereYear('date', $year)
                ->whereMonth('date', '>', 3)
                ->whereMonth('date', '<=', 6)
                ->sum('montant'),
            'trimestre_3' => $model::where('categorie_id', $this->uuid)
                ->whereYear('date', $year)
                ->whereMonth('date', '>', 6)
                ->whereMonth('date', '<=', 9)
                ->sum('montant'),
            'trimestre_4' => $model::where('categorie_id', $this->uuid)
                ->whereYear('date', $year)
                ->whereMonth('date', '>', 9)
                ->sum('montant'),
        ];
    }


    // public function totalParTrimestre($type, $year)
    // {
    //     $model = $type === 'recette' ? Recette::class : Depense::class;

    //     // Obtenez les montants totaux par trimestre pour cette catégorie en fonction de l'année
    //     return [
    //         'trimestre_1' => $model::where('categorie_id', $this->uuid)
    //             ->whereYear('date', $year)
    //             ->whereMonth('date', '<=', 3)
    //             ->when($this->sous_categorie_id, function ($query) {
    //                 $query->where('sous_categorie_id', $this->sous_categorie_id);
    //             })
    //             ->sum('montant'),

    //         'trimestre_2' => $model::where('categorie_id', $this->uuid)
    //             ->whereYear('date', $year)
    //             ->whereMonth('date', '>', 3)
    //             ->whereMonth('date', '<=', 6)
    //             ->when($this->sous_categorie_id, function ($query) {
    //                 $query->where('sous_categorie_id', $this->sous_categorie_id);
    //             })
    //             ->sum('montant'),

    //         'trimestre_3' => $model::where('categorie_id', $this->uuid)
    //             ->whereYear('date', $year)
    //             ->whereMonth('date', '>', 6)
    //             ->whereMonth('date', '<=', 9)
    //             ->when($this->sous_categorie_id, function ($query) {
    //                 $query->where('sous_categorie_id', $this->sous_categorie_id);
    //             })
    //             ->sum('montant'),

    //         'trimestre_4' => $model::where('categorie_id', $this->uuid)
    //             ->whereYear('date', $year)
    //             ->whereMonth('date', '>', 9)
    //             ->when($this->sous_categorie_id, function ($query) {
    //                 $query->where('sous_categorie_id', $this->sous_categorie_id);
    //             })
    //             ->sum('montant'),
    //     ];
    // }


    public function getTotalRealise($type, $year)
    {
        if ($type == 'recette') {
            return $this->recettes()->whereYear('date', $year)->sum('montant');
        }
        
        if ($type == 'depense') {
            return $this->depenses()->whereYear('date', $year)->sum('montant');
        }
        
        return 0;
    }

    public function getEcart($type, $year)
    {
        $totalPrevu = $this->montant_prevu;
        $totalRealise = $this->getTotalRealise($type, $year);
        
        return $totalPrevu - $totalRealise;
    }

    public function getTauxRealisation($type, $year)
    {
        $totalPrevu = $this->montant_prevu;
        $totalRealise = $this->getTotalRealise($type, $year);
        $ecart = $this->getEcart($type, $year);


        if ($totalPrevu == 0) {
            return 0;
        }
        if ($ecart < 0) {
            return -($totalRealise * 100) / $totalPrevu;
        }

        return ($totalRealise * 100) / $totalPrevu;
    }


    
}


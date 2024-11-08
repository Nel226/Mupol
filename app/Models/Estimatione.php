<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Estimatione extends Model
{
    use HasFactory, HasUuids;

    protected $primaryKey = 'uuid';
    public $incrementing = false;
    protected $keyType = 'string';

protected $fillable = ['montant', 'description', 'categorie_id','sous_categorie_id', 'periode' , 'annee'];

    public function categorie()
    {
        return $this->belongsTo(Categorie::class, 'categorie_id', 'uuid');
    }

    public function sousCategorie()
    {
        return $this->belongsTo(Categorie::class, 'sous_categorie_id');
    }
}

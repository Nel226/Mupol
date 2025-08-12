<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Adherent;
use App\Models\DemandeAdhesion;
use Illuminate\Http\Request;

class DemandeController extends Controller
{
    use HasFactory, HasUuids;

    protected $keyType = 'string';
    public $incrementing = false;

    // Define the table if it's different from the default ('demande_adhesions')
    protected $table = 'demande_adhesions';

    // Allow mass assignment for these fields
    protected $fillable = [
        'matricule', 'nip', 'cnib', 'delivree', 'expire','email',
        'adresse', 'telephone', 'nom',
        'prenom', 'genre', 'departement', 'ville', 'pays',
        'nom_pere', 'nom_mere', 'situation_matrimoniale',
        'photo', 'nom_prenom_personne_besoin', 'lieu_residence',
        'telephone_personne_prevenir', 'nombreAyantsDroits', 'ayantsDroits', 'categorie',
        'statut', 'grade', 'departARetraite', 'numeroCARFO',
        'dateIntegration', 'dateDepartARetraite', 'direction', 'service',
        'region', 'province', 'localite','code_carte', 'signature',
        'etat', 'is_new',
    ];


    public function adherent()
    {
        return $this->hasOne(Adherent::class);
    }




}

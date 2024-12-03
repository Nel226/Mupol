<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class DemandeAdhesion extends Model
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
        'region', 'province', 'localité','code_carte',
        'etat',
    ];

    public function adherent()
    {
        return $this->hasOne(Adherent::class);
    }

    
}

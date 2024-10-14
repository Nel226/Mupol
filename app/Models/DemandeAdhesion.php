<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DemandeAdhesion extends Model
{
    use HasFactory;

    // Define the table if it's different from the default ('demande_adhesions')
    protected $table = 'demande_adhesions';

    // Allow mass assignment for these fields
    protected $fillable = [
        'matricule', 'nip', 'cnib', 'delivree', 'expire',
        'adresse', 'telephone', 'nom',
        'prenom', 'genre', 'departement', 'ville', 'pays',
        'nom_pere', 'nom_mere', 'situation_matrimoniale',
        'nom_prenom_personne_besoin', 'lieu_residence',
        'telephone_personne_prevenir', 'nombreAyantsDroits',
        'statut', 'grade', 'departARetraite', 'numeroCARFO',
        'dateIntegration', 'dateDepartARetraite', 'direction', 'service'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class Adherant extends Model implements AuthenticatableContract
{
    use HasFactory, Authenticatable;
    protected $fillable = [
        'ordre',
        'date_enregistrement',
        'nom',
        'prenom',
        'genre',
        'service',
        'no_matricule',
        'nip',
        'cnib',
        'delivree',
        'expire',
        'adresse',
        'telephone',
        'email',
        'departement',
        'ville',
        'pays',
        'nom_pere',
        'nom_mere',
        'situation_matrimoniale',
        'nom_prenom_personne_besoin',
        'lieu_residence',
        'telephone_personne_prevenir',
        'photo',
        'nombreAyantsDroits',
        'ayantsDroits',
        'categorie',
        'statut',
        'grade',
        'departARetraite',
        'numeroCARFO',
        'dateIntegration',
        'dateDepartARetraite',
        'password', 'cle', 'code_carte', 'telephone', 'charge', 'mensualite', 'adhesion', 'photo'
    ];

  
    public function ayantsDroits()
    {
        return $this->hasMany(AyantDroit::class);
    }
    public function prestations()
    {
        return $this->hasMany(Prestation::class, 'adherantCode', 'code_carte');
    }

}

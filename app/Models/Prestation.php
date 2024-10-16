<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestation extends Model
{
    use HasFactory;
    protected $fillable = [
        'adherantCode',
        'adherantNom',
        'adherantPrenom',
        'adherantSexe',
        'beneficiaire',
        'idPrestation',
        'contactPrestation',
        'acte',
        'type',
        'sous_type',
        'date',
        'centre',
        'montant',
        'validite',
        'etat_paiement',
        'preuve',
    ];
}

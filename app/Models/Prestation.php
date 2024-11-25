<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestation extends Model
{
    use HasFactory;
    protected $fillable = [
        'adherentCode',
        'adherentNom',
        'adherentPrenom',
        'adherentSexe',
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

    public function partenaire()
    {
        return $this->belongsTo(Partenaire::class); 
    }
    public function acteMedical()
    {
        return $this->belongsTo(ActeMedical::class, 'acte_medical_id');


    }

}

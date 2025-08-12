<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Prestation extends Model
{
    use HasFactory, HasUuids;

    protected $keyType = 'string'; 
    public $incrementing = false;
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

    // public function partenaire()
    // {
    //     return $this->belongsTo(Partenaire::class); 
    // }
    public function partenaire()
    {
        return $this->belongsTo(Partenaire::class, 'centre'); 
    }

    public function acteMedical()
    {
        return $this->belongsTo(ActeMedical::class, 'acte_medical_id');


    }

}

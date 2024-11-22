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

    public function partenaire()
    {
        return $this->belongsTo(Partenaire::class); 
<<<<<<< Updated upstream
    }
    public function acteMedical()
    {
        return $this->belongsTo(ActeMedical::class, 'acte_medical_id');
=======
>>>>>>> Stashed changes
    }

}

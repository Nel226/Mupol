<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AyantDroit extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom', 'prenom', 'sexe', 'date_naissance', 'relation', 'code', 'adherent_id'
    ];

    public function adherent()
    {
        return $this->belongsTo(Adherent::class);
    }
    public function prestations()
    {
        return $this->hasMany(Prestation::class, 'adherentCode', 'code_carte');
    }

}

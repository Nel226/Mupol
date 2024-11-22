<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AyantDroit extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom', 'prenom', 'sexe', 'date_naissance', 'relation', 'code', 'adherant_id'
    ];

    public function adherant()
    {
        return $this->belongsTo(Adherant::class);
    }
    public function prestations()
    {
        return $this->hasMany(Prestation::class, 'adherantCode', 'code_carte');
    }

}

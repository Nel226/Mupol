<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adherant extends Model
{
    use HasFactory;
    protected $fillable = [
        'ordre', 'date_enregistrement', 'nom', 'prenom', 'genre', 'service', 'no_matricule',
        'cle', 'code_carte', 'telephone', 'charge', 'mensualite', 'adhesion', 'photo'
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

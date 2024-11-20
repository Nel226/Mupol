<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Foundation\Auth\User as Authenticatable; // Change ici



class CentreSante  extends Authenticatable
{
    use HasFactory, HasUuids;
    protected $fillable = [
        'nom',
        'type',
        'adresse',
        'telephone',
        'email',
        'region',
        'province',
        'date_affiliation',
        'photo',
        'password',
    ];

    public function prestations()
    {
        return $this->hasMany(Prestation::class);
    }
}

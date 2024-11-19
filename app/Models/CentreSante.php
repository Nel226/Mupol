<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;


class CentreSante extends Model
{
    use HasFactory, HasUuids;
    // protected $table = 'centres_sante';
    protected $fillable = [
        'nom',
        'type',
        'adresse',
        'telephone',
        'email',
        'region',
        'province',
        'date_affiliation',
    ];
}

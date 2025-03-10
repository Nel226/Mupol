<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Auth\Passwords\CanResetPassword as CanResetPasswordTrait;
class Partenaire extends Authenticatable implements CanResetPassword
{
    use HasFactory, HasUuids, CanResetPasswordTrait;

    protected $keyType = 'string'; 
    public $incrementing = false;
    protected $fillable = [
        'nom',
        'type',
        'adresse',
        'telephone',
        'email',
        'region',
        'province',
        'photo',
        'geolocalisation',

        'password',
    ];

    public function prestations()
    {
        return $this->hasMany(Prestation::class);
    }
}

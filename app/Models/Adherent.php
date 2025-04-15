<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Auth\Passwords\CanResetPassword as CanResetPasswordTrait;

class Adherent extends Authenticatable implements CanResetPassword
{
    use HasFactory, Notifiable, HasUuids, CanResetPasswordTrait;
    protected $keyType = 'string'; 
    public $incrementing = false; 
    protected $fillable = [
        'date_enregistrement',
        'nom',
        'prenom',
        'genre',
        'service',
        'direction',

        'matricule',
        'nip',
        'cnib',
        'delivree',
        'expire',
        'adresse',
        'telephone',
        'email',
        'departement',
        'ville',
        'pays',
        'nom_pere',
        'nom_mere',
        'situation_matrimoniale',
        'nom_prenom_personne_besoin',
        'lieu_residence',
        'telephone_personne_prevenir',
        'photo',
        'nombreAyantsDroits',
        'ayantsDroits',
        'categorie',
        'signature',

        'statut',
        'grade',
        'departARetraite',
        'numeroCARFO',
        'dateIntegration',
        'dateDepartARetraite',
        'password', 'cle', 'code_carte', 'charge', 'mensualite', 'adhesion',
        'region', 'province', 'localite',
        'must_change_password', 'is_adherent','is_new', 'demande_id'
    ];

    /**
     * Boot method pour attacher des événements au modèle.
     */
    
    public function ayantsDroits()
    {
        return $this->hasMany(AyantDroit::class);
    }
    public function prestations()
    {
        return $this->hasMany(Prestation::class, 'adherentCode', 'code_carte');
    }

    // App\Models\Adherent.php

    public function demande()
    {
        return $this->belongsTo(DemandeAdhesion::class, 'demande_id'); // Assurez-vous que 'demande_id' est le bon nom de colonne dans votre base de données
    }

    public function setNombreAyantsDroitsAttribute($value)
    {
        $this->attributes['nombreAyantsDroits'] = $value;
        $this->attributes['charge'] = $value; // Met à jour automatiquement `charge`
    }

    // Mutateur pour charge
    public function setChargeAttribute($value)
    {
        $this->attributes['charge'] = $value;
        $this->attributes['nombreAyantsDroits'] = $value; // Met à jour automatiquement `nombreAyantsDroits`
    }

}

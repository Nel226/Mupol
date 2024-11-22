<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class ActeMedical extends Model
{
    use HasFactory;

    protected $table = 'acte_medicals';

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        
        'code',
        'designation',
        'plafond',
        'date_creation',
        'date_invalidite',
        'categorie',
        'type',
        'sous_type',
        'taux_remboursement',
        'plafond_remboursement',
        'frequence_plafond',
        'beneficiaire',
    ];

    public function prestations()
    {
        return $this->hasMany(Prestation::class, 'acte_medical_id');
    }

 

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) Str::uuid(); 
            }
        });
    }
}

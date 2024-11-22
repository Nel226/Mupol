<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActeMedical extends Model
{
    use HasFactory;

    protected $table = 'acte_medicals';

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'code',
        'designation',
        'cout',
        'plafond',
        'date_creation',
        'date_invalidite',
    ];

    public function prestations()
    {
        return $this->hasMany(Prestation::class, 'acte_medical_id');
    }

    protected static function boot()
    {
        parent::boot();

        // Générer automatiquement un UUID pour chaque nouveau modèle
        static::creating(function ($model) {
            $model->id = (string) \Illuminate\Support\Str::uuid();
        });
    }
}

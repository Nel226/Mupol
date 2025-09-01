<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Direction extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'code', 
        'description',
        'directeur_id',
        'statut',
        'ordre'
    ];

    protected $casts = [
        'statut' => 'string',
        'ordre' => 'integer',
    ];

    // Relations
    public function directeur()
    {
        return $this->belongsTo(User::class, 'directeur_id');
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    // Scopes
    public function scopeActif($query)
    {
        return $query->where('statut', 'actif');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('ordre');
    }
}
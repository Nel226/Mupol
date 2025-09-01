<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'code',
        'description',
        'direction_id',
        'chef_service_id',
        'statut',
        'ordre'
    ];

    protected $casts = [
        'statut' => 'string',
        'ordre' => 'integer',
    ];

    // Relations
    public function direction()
    {
        return $this->belongsTo(Direction::class);
    }

    public function chefService()
    {
        return $this->belongsTo(User::class, 'chef_service_id');
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
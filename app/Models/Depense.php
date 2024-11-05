<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Depense extends Model
{
    use HasUuids;

    protected $primaryKey = 'uuid';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['montant', 'description', 'categorie_id', 'date'];

    public function categorie()
    {
        return $this->belongsTo(Categorie::class, 'categorie_id', 'uuid');
    }
}

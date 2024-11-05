<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Categorie extends Model
{
    use HasUuids;

    protected $primaryKey = 'uuid';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['nom', 'type', 'parent_id'];

    public function sousCategories()
    {
        return $this->hasMany(Categorie::class, 'parent_id', 'uuid');
    }
    


    public function parent()
    {
        return $this->belongsTo(Categorie::class, 'parent_id', 'uuid');
    }
    public function children()
    {
        return $this->hasMany(Categorie::class, 'parent_id', 'uuid');
    }
    public function getSubcategoriesCountAttribute()
    {
        return $this->sousCategories()->count();
    }
    
}


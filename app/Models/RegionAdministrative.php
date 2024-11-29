<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegionAdministrative extends Model
{
    use HasFactory;

    /**
     * Les champs remplissables dans la table.
     */
    protected $fillable = [
        'region',
        'code',
    ];

    public function villes()
    {
        return $this->hasMany(Ville::class, 'region_id');
    }

}

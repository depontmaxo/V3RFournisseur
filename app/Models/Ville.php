<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ville extends Model
{
    use HasFactory;

    /**
     * Les champs remplissables dans la table.
     */
    protected $fillable = [
        'ville',
        'region_id',
    ];

    /**
     * Relation : une ville appartient à une région.
     */
    public function regionAdministrative()
    {
        return $this->belongsTo(RegionAdministrative::class, 'region_id');
    }
}

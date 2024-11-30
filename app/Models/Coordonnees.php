<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coordonnees extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'num_civique',
        'rue',
        'bureau',

        'ville',
        'region_administrative',
        'code_region',
        'province',
        'code_postal',

        'num_telephone',
        'poste',
        'type_contact',
        
        'siteweb',
        
        'utilisateur_id',
    ];

    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class, 'utilisateur_id');
    }

}

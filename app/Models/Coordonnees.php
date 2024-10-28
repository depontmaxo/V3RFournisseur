<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coordonnees extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'adresse',
        'bureau',
        'ville',
        'province',
        'code_postal',
        'pays',
        'siteweb',
        'num_telephone',
        'utilisateur_id',
    ];

    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class, 'utilisateur_id');
    }

}

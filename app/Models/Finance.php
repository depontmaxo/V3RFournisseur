<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Finance extends Model
{
    use HasFactory;

    protected $fillable = [
        'numeroTPS',
        'numeroTVQ',
        'conditionPaiement',
        'devise',
        'modeCommunication',
        'utilisateur_id', // Assurez-vous que cette clé est remplie
    ];

    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class, 'utilisateur_id');
    }
}

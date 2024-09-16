<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Utilisateur extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
    * The attributes that are mass assignable.
    *
    * @var array<int, string>
    */
    protected $table = "utilisateur";
    protected $fillable = [
        'neq',
        'email',
        'password',
        'nomFournisseur',
        'adresse',
        'noTelephone',
        'personneRessource',
        'emailPersonneRessource',
        'licenceRBQ',
        'posteOccupeEntreprise',
        'siteWeb',
        'produitOuService'
    ];


    // Mis en commentaire le temps de toute mettre en place
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
        protected $hidden = [
            'password',
            'remember_token',
        ];
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
        protected $casts = [
            'id' => 'string',
            'email_verified_at' => 'datetime',
            'password' => 'hashed',

            
        ];


        
}
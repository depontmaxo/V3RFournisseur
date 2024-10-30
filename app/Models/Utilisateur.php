<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
 
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

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'id' => 'string',
        'email_verified_at' => 'datetime',
        'password' => 'hashed',

        
    ];

    public function contacts()
    {
        return $this->hasMany(Contacts::class);
    }

}
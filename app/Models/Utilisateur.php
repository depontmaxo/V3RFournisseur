<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
 
class Utilisateur extends Authenticatable
{
    use HasFactory, Notifiable, Searchable;

    /**
    * The attributes that are mass assignable.
    *
    * @var array<int, string>
    */
    protected $table = "utilisateur";

    // Define your primary key if it's not the default 'id'
    protected $primaryKey = 'id'; // Or whatever your primary key is

    // If your primary key is not an auto-incrementing integer, set this
    protected $keyType = 'string';  // For UUID or non-integer primary keys
    public $incrementing = false;   // Disable auto-increment if using UUIDs


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

    public function searchableAs(): string
    {
        return 'posts_index';
    }
    
    /**
     * Get the indexable data array for the model.
     *
     * @return array<string, mixed>
     */
    public function toSearchableArray()
    {
        return [
            'neq' => $this->name,
            'email' => $this->email,
            'nomFournisseur' => $this->nomFournisseur,
            'adresse' => $this->adresse,
            'noTelephone' => $this->noTelephone,
            'personneRessource' => $this->personneRessource,
            'emailPersonneRessource' => $this->emailPersonneRessource,
            'licenceRBQ' => $this->licenceRBQ,
            'posteOccupeEntreprise' => $this->posteOccupeEntreprise,
            'siteWeb' => $this->siteWeb,
            'produitOuService' => $this->produitOuService
        ];
    }

    public function getScoutKey(): mixed
    {
        return $this->id;
    }
 
    /**
     * Get the key name used to index the model.
     */
    public function getScoutKeyName(): mixed
    {
        return 'id';
    }
}
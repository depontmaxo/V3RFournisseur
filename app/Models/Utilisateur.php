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

    // Define your primary key if it's not the default 'id'
    protected $primaryKey = 'id'; // Or whatever your primary key is

    // If your primary key is not an auto-incrementing integer, set this
    protected $keyType = 'string';  // For UUID or non-integer primary keys
    public $incrementing = false;   // Disable auto-increment if using UUIDs


    protected $fillable = [
        'id',
        'nom_entreprise',
        'neq',
        'email',
        'password',
        'statut',
        'rbq'
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

     
    public function contacts()
    {
        return $this->hasMany(Contacts::class, 'utilisateur_id');
    }

    public function documents()
    {
        return $this->hasMany(Document::class, 'utilisateur_id');
    }

    public function coordonnees()
    {
        return $this->hasOne(Coordonnees::class, 'utilisateur_id');
    }

    public function finance()
    {
        return $this->hasOne(Finance::class, 'utilisateur_id');
    }
    
    public function codeUSCPSC()
    {
        return $this->hasMany(Coordonnees::class, 'utilisateur_id');
    }
}
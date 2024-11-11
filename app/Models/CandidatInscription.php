<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class CandidatInscription extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
    * The attributes that are mass assignable.
    *
    * @var array<int, string>
    */

    protected $table = "inscriptions";

    // Define your primary key if it's not the default 'id'
    protected $primaryKey = 'id'; // Or whatever your primary key is

    // If your primary key is not an auto-incrementing integer, set this
    protected $keyType = 'string';  // For UUID or non-integer primary keys
    public $incrementing = false;   // Disable auto-increment if using UUIDs

    protected $fillable = [
        'id',
        'entreprise',
        'neq',
        'courrielConnexion',
        'password',
        'services',
        'adresse',
        'bureau',
        'ville',
        'province',
        'codePostal',
        'pays',
        'site',
        'numTel',
        'rbq'
    ];

    public function contacts()
    {
        return $this->hasMany(Contacts::class, 'inscription_id');
    }

    public function documents()
    {
        return $this->hasMany(Document::class, 'inscription_id');
    }


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected $casts = [
        'id' => 'string',
        'password' => 'hashed',
    ];

}
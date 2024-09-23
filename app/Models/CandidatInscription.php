<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidatInscription extends Model
{
    use HasFactory, Notifiable;

    /**
    * The attributes that are mass assignable.
    *
    * @var array<int, string>
    */
    protected $table = "candidat";
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
        'produitOuService',
        'fichiers'
    ];
}
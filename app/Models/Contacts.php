<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contacts extends Model
{
    use HasFactory;

    protected $fillable = [
        'inscription_id',
        'prenom',
        'nom',
        'poste',
        'courrielContact',
        'numContact',
        //'candidat_id', // Assurez-vous que cette clé est remplie
    ];

    public function candidat()
    {
        return $this->belongsTo(CandidatInscription::class, 'inscription_id');
    }

    public function utilisateurs()
    {
        return $this->belongsTo(Utilisateur::class);
    }

}

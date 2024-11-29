<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contacts extends Model
{
    use HasFactory;

    protected $fillable = [
        'prenom',
        'nom',
        'fonction',
        'email_contact',
        
        'num_contact',
        'poste_tel',
        'type_contact',

        'utilisateur_id'
    ];
    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class, 'utilisateur_id');
    }
}


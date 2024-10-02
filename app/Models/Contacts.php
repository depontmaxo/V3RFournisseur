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
        'numContact'
    ];

    public function inscription()
    {
        return $this->belongsTo(CandidatInscription::class, 'inscription_id');
    }

}

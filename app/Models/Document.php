<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_name',
        'file_size',
        'file_type',
        'file_stream',
        'candidat_id', // Assurez-vous que cette clé est remplie
    ];

    public function candidat()
    {
        return $this->belongsTo(CandidatInscription::class, 'inscription_id');
    }
}

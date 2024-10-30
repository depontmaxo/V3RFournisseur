<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CodeUNSPSC extends Model
{
    use HasFactory;

    protected $table = "code_unspsc";

    protected $fillable = [
        'nature_contrat',
        'code_cat',
        'desc_cat',
        'code_usnpsc',
        'desc_unspsc',
        'desc_det_unspsc',
        'code_full_cat',
    ];
}

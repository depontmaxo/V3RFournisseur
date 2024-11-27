<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{

    use HasFactory;

    protected $fillable = ['appro_email', 'revision_delai', 'max_file_size', 'email_finance'];


}

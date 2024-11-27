<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
//use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str; // Import correct de la classe Str



class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
    * The attributes that are mass assignable.
    *
    * @var array<int, string>
    */
    protected $table = "users";

    // Define your primary key if it's not the default 'id'
    protected $primaryKey = 'id'; // Or whatever your primary key is

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
        'role',
        'is_admin',
    ];

    public $incrementing = false; // Indique que l'identifiant n'est pas auto-incrémenté
    protected $keyType = 'string'; // Type de clé primaire

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) Str::uuid(); // Générer un UUID
            }
        });
    }
}

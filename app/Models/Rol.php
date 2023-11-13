<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Notifications\Notifiable;
// use Laravel\Sanctum\HasApiTokens;

class Rol extends Model
{
    // use HasApiTokens, HasFactory, Notifiable;
    use HasFactory;

    protected $table = 'roles';

    protected $fillable = [
        'tipo',
        'descripcion',
    ];

    public function users()
    {
        return $this->hasMany('App\Models\User', 'role');
    }
}

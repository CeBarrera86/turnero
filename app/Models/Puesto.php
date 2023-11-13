<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Puesto extends Model
{
    use HasFactory;
    protected $table = 'puestos';

    public $timestamps = false;

    protected $fillable = [
        'mostrador',
        'user',
        'login',
        'logout',
    ];

    public function turnos()
    {
        return $this->hasMany('App\Models\Turno', 'puesto');
    }

    public function mostradores()
    {
        return $this->belongsTo('App\Models\Mostrador', 'mostrador');
    }

    public function users()
    {
        return $this->belongsTo('App\Models\User', 'user');
    }
}

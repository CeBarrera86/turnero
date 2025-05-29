<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historial extends Model
{
    use HasFactory;
    protected $table = 'historiales';

    protected $fillable = [
        'turno',
        'puesto',
        'estado',
        'der_para',
    ];

    public function turnos()
    {
        return $this->belongsTo('App\Models\Turno', 'turno');
    }

    public function users()
    {
        return $this->belongsTo('App\Models\User', 'der_para');
    }
}

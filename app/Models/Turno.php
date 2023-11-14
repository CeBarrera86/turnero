<?php

namespace App\Models;

use App\Events\nuevoTurno;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Turno extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'turnos';

    protected $fillable = [
        'puesto',
        'ticket',
        'updated_at',
    ];

    protected $dispatchesEvents = [
        'created' => nuevoTurno::class, // Se dispara cuando el USUARIO llama a atender a un nuevo ticket
        'updated' => nuevoTurno::class, // Se dispara cuando el USUARIO llama a atender a un nuevo ticket
    ];

    public function puestos()
    {
        return $this->belongsTo('App\Models\Puesto', 'puesto');
    }

    public function tickets()
    {
        return $this->belongsTo('App\Models\Ticket', 'ticket');
    }

    public function historiales()
    {
        return $this->hasMany('App\Models\Historial', 'turno');
    }
}

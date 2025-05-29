<?php

namespace App\Models;

use App\Events\nuevoTicket;
use App\Events\eliminarTicket;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Ticket extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'tickets';

    protected $fillable = [
        'letra',
        'numero',
        'cliente',
        'sector',
        'estado',
    ];

    protected $dispatchesEvents = [
        'created' => nuevoTicket::class, // Ticket creado por TOTEM
        'updated' => eliminarTicket::class, // Ticket eliminado por USUARIOS
    ];

    public function turnos()
    {
        return $this->hasOne('App\Models\Turno', 'ticket');
    }

    public function clientes()
    {
        return $this->belongsTo('App\Models\Cliente', 'cliente');
    }

    public function sectores()
    {
        return $this->belongsTo('App\Models\Sector', 'sector');
    }

    public function estados()
    {
        return $this->belongsTo('App\Models\Estado', 'estado');
    }
}

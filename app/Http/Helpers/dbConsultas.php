<?php

use Carbon\Carbon;
use App\Models\User;
use App\Models\Ticket;
use App\Models\Historial;

class Consultas
{
    public static function tickets($sector, $estado, $cantidad, $incluirUsuarios = false)
    {
        $today = Carbon::today();
        $consulta = Ticket::with('clientes')
            ->where('sector', $sector)
            ->where('estado', $estado)
            ->whereDate('created_at', $today)
            ->orderBy('created_at', 'asc');
        // Agregar relaciones adicionales
        if ($incluirUsuarios && $estado == 3) {
            $consulta->with(['turnos', 'turnos.puestos.users']);
        }
        $tickets = $consulta->take($cantidad)->get();
        // Añadir la información de usuarios
        if ($incluirUsuarios && $estado == 3) {
            $tickets->each(function ($ticket) {
                // Obtener el historial más reciente con estado 3
                $historial = Historial::where('turno', $ticket->turnos?->id)
                        ->where('estado', 3)
                        ->latest('created_at')
                        ->first();
                if ($historial) {
                    $ticket->userDe = $historial->turnos?->puestos?->users?->username;
                    $ticket->userPara = $historial->users?->username;
                }
            });
        }
        return $tickets;
    }

    public static function ticketSolicitado($puestoId)
    {
        $today = Carbon::today();
        return Ticket::with('clientes')
            ->whereHas('turnos', function ($query) use ($puestoId) {
                $query->where('puesto', $puestoId);
            })->where('estado', 1)
            ->whereDate('tickets.created_at', $today)
            ->first();
    }

    public static function ultimosTickets()
    {
        $today = Carbon::today();
        return Ticket::with(['turnos', 'turnos.puestos.mostradores'])
            ->where('estado', 1)
            ->whereDate('created_at', $today)
            ->orderBy('updated_at', 'desc')
            ->take(8)
            ->get();
    }

    public static function buscarTicket($letra, $numero)
    {
        $today = Carbon::today();
        return Ticket::with('clientes')
            ->where('letra', $letra)
            ->where('numero', $numero)
            ->whereIn('estado', [2, 3, 4, 5])
            ->whereDate('created_at', $today)
            ->first();
    }

    public static function usuarios($sectorId)
    {
        return User::select('users.id', 'users.username')
            ->leftJoin('puestos', 'puestos.user', '=', 'users.id')
            ->leftJoin('mostradores', 'puestos.mostrador', '=', 'mostradores.id')
            ->where('mostradores.sector', $sectorId)
            ->get();
    }
}

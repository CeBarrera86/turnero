<?php

use App\Models\Historial;
use App\Models\Ticket;
use Illuminate\Support\Facades\DB;

class Consultas
{
    public static function historiales()
    {
        $historiales = Historial::groupBY('turno')
            ->select('turno', DB::raw('MAX(historiales.created_at) as created_at'));

        return $historiales;
    }

    public static function turnos()
    {
        $historiales = self::historiales();

        $turnos = Historial::select('turnos.id', 'tickets.alfa', 'mostradores.numero', 'mostradores.tipo', 'tickets.sector', 'historiales.estado', 'users.username', 'clientes.titular')
            ->leftjoin('turnos', 'turnos.id', 'historiales.turno')
            ->leftjoin('tickets', 'tickets.id', 'turnos.ticket')
            ->leftjoin('puestos', 'puestos.id', 'historiales.puesto')
            ->leftjoin('mostradores', 'mostradores.id', 'puestos.mostrador')
            ->leftjoin('users', 'puestos.user', 'users.id')
            ->leftjoin('clientes', 'tickets.cliente', 'clientes.id')
            ->joinSub($historiales, 'historial', function ($join) {
                $join->on('historiales.created_at', '=', 'historial.created_at');
                $join->on('historiales.turno', '=', 'historial.turno');
            })
            ->wheredate('historiales.created_at', today()) // Sólo Tickets del día
            ->whereNotIn('historiales.estado', [2, 4]) // Excepto Estados Culminados y Eliminados
            ->orderBy('historiales.created_at', 'DESC');

        return $turnos;
    }

    public static function tickets($der = 0)
    {
        $tickets = Ticket::select('tickets.id', 'tickets.alfa', 'clientes.titular')
            ->leftjoin('clientes', 'clientes.id', 'tickets.cliente')
            ->where('tickets.llamado', 0)
            ->where('tickets.derivado', $der)
            ->where('tickets.eliminado', 0)
            ->wheredate('tickets.created_at', today());

        return $tickets;
    }

    public static function controlRetorno($turno, $turnoSidebar, $nuevoTurno, $nuevoTurnoSidebar)
    {
        if (count($turno) == 0 and count($nuevoTurno) == 0) {
            if (count($turnoSidebar) == 0 and count($nuevoTurnoSidebar) == 0) {
                $pantalla = "noRefresh";
            } else {
                foreach ($turnoSidebar as $item) {
                    if (!in_array($item, $nuevoTurnoSidebar)) {
                        $pantalla = "refresh";
                        break;
                    } else {
                        $pantalla = "noRefresh";
                    }
                }
            }
        } elseif (count($turno) == 0 and count($nuevoTurno) > 0) {
            $pantalla = "refreshSonar";
        } elseif (count($turno) > 0 and count($nuevoTurno) == 0) {
            $pantalla = "refresh";
        } else {
            foreach ($nuevoTurno as $item) {
                if (!in_array($item, $turno)) {
                    $pantalla = "refreshSonar";
                    break;
                } else {
                    if (count($nuevoTurno) < count($turno)) {
                        $pantalla = "refresh";
                    } else {
                        $pantalla = "noRefresh";
                    }
                }
            }
        }
        return $pantalla;
    }
}

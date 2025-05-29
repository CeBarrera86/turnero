<?php

namespace App\Services;

use App\Models\Sector;
use App\Models\Ticket;
use App\Models\Tarea;
use Impresion;

class TicketService
{
    public function crearTicket($cliId, $secId)
    {
        $sector = Sector::findOrFail($secId);
        $ticket = Ticket::where('letra', $sector->letra)
            ->where('created_at', '>=', today())
            ->latest()
            ->first();

        $num = $ticket ? ($ticket->numero + 1) % 1000 : 0;
        $cantidad = Ticket::where('sector', $sector->id)
            ->where('estado', 4)
            ->where('created_at', '>=', today())
            ->where('letra', $sector->letra)
            ->count();

        Ticket::create([
            'letra' => $sector->letra,
            'numero' => $num,
            'cliente' => $cliId,
            'sector' => $sector->id,
            'estado' => 4,
        ]);

        Impresion::ticket($sector->letra, $num, $cantidad);
    }

    public function obtenerTareasAgrupadasPorSector()
    {
        $tareas = Tarea::select('id', 'sector', 'descripcion')->get();
        $tareasPorSector = [];
        foreach ($tareas as $tarea) {
            $tareasPorSector[$tarea->sector][] = $tarea;
        }
        return $tareasPorSector;
    }
}

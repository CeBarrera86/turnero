<?php

namespace App\Http\Controllers;

use App\Events\ventanaTicket;
use Illuminate\Support\Collection;
use App\Events\listarTickets;
use Illuminate\Http\Request;
use App\Models\Ticket;
use Consultas;

class TicketController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function update(Request $request, $id)
    {
        $ticket = Ticket::find($id);
        if (!$ticket) {
            return response()->json(['success' => false]);
        }
        if ($request->llamar) {
            $ticket->touch();
            // Evento para la ventana emergente de la pantalla
            $ticket = Ticket::with(['turnos', 'turnos.puestos', 'turnos.puestos.mostradores'])
                ->find($id);
            event(new ventanaTicket($ticket));
            // Evento que actualiza el listado de Tickets
            $ultimosTickets = Consultas::ultimosTickets();
            $coleccionTickets = new Collection($ultimosTickets);
            event(new listarTickets($coleccionTickets));
        } else {
            $ticket->update(['estado' => 5, 'updated_at' => now()]);
            return response()->json(['success' => true]);
        }
    }

    public function verificarDisponibles(Request $request)
    {
        try {
            $tickets = Consultas::tickets($request->sectorId, 4, 3, false);
            if (!$tickets->isEmpty()) {
                return response()->json(['status' => true, 'tickets' => $tickets]);
            }
            return response()->json(['status' => false, 'message' => 'No se encontraron tickets disponibles.']);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Error al consultar los tickets disponibles.'], 500);
        }
    }

    public function verificarDerivados(Request $request)
    {
        try {
            $tickets = Consultas::tickets($request->sectorId, 3, 3, true);
            if (!$tickets->isEmpty()) {
                return response()->json(['status' => true, 'tickets' => $tickets]);
            }
            return response()->json(['status' => false, 'message' => 'No se encontraron tickets derivados.']);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Error al consultar los tickets derivados.'], 500);
        }
    }

    public function searchTicket(Request $request)
    {
        $ticket = Consultas::buscarTicket($request->letra, $request->numero);
        return response()->json([
            'status' => (bool) $ticket,
            'ticket' => $ticket,
        ]);
    }
}

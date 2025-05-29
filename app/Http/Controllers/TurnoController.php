<?php

namespace App\Http\Controllers;

use Illuminate\Support\Collection;
use App\Events\listarTickets;
use App\Models\Historial;
use App\Models\Puesto;
use App\Models\Ticket;
use App\Models\Turno;
use App\Models\User;
use App\Events\ventanaTicket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Consultas;

class TurnoController extends Controller
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

    public function verificarSolicitado(Request $request)
    {
        try {
            $ticketSolicitado = Consultas::ticketSolicitado($request->puestoId);
            if ($ticketSolicitado) {
                return response()->json(['status' => true, 'ticket' => $ticketSolicitado]);
            }
            return response()->json(['status' => false, 'message' => 'No se encontró ticket solicitado.']);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Error al consultar el ticket solicitado.'], 500);
        }
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $puestoId = Puesto::where('user', $user->id)->orderByDesc('id')->value('id');
        $turno = Turno::where('ticket', $request->id)->first();
        if (empty($turno)) {
            $turno = Turno::create([
                'puesto' => $puestoId,
                'ticket' => $request->id
            ]);
        } else {
            // Verificar si el usuario cambió de puesto
            if ($turno->puesto != $user->puesto) {
                $turno->update(['puesto' => $puestoId]);
            }
        }
        $turno->touch(); // Forzar la actualización del modelo
        // Crear Historial
        Historial::create([
            'turno' => $turno->id,
            'puesto' => $turno->puesto,
            'estado' => 1
        ]);
        // Evento para la ventana emergente de la pantalla
        $ticket = Ticket::with(['turnos', 'turnos.puestos', 'turnos.puestos.mostradores'])
            ->find($request->id);
        $ticket->update(['estado' => 1, 'updated_at' => now()]);
        event(new ventanaTicket($ticket));
        // Evento que actualiza el listado de Tickets
        $ultimosTickets = Consultas::ultimosTickets();
        $coleccionTickets = new Collection($ultimosTickets);
        event(new listarTickets($coleccionTickets));

        return response()->json(['success' => true]);
    }

    public function update(Request $request, $id)
    {
        try {
            $turno = Turno::where('ticket', $id)->latest('id')->first();
            if (!$turno) {
                return response()->json(['success' => false, 'message' => 'Turno no encontrado.'], 404);
            }
            // Actualizo valores del ticket
            $ticketData = ['estado' => $request->estado];
            if ($request->estado == 3) {
                $ticketData['sector'] = $request->sector;
            }
            Ticket::find($turno->ticket)->update($ticketData);
            // Actualizo valores del Turno
            $turno->update(['updated_at' => now()]);
            // Registro el historial
            Historial::create([
                'turno' => $turno->id,
                'puesto' => $turno->puesto,
                'estado' => $request->estado,
                'der_para' => $request->userPara
            ]);
            // Evento de actualización de tickets
            $ultimosTickets = Consultas::ultimosTickets();
            $coleccionTickets = new Collection($ultimosTickets);
            event(new listarTickets($coleccionTickets));
            // Respuesta específica para el estado 3
            if ($request->estado == 3) {
                return response()->json([
                    'success' => true,
                    'ticketId' => $turno->ticket,
                    'userDe' => User::find($request->userDe)->username,
                    'userPara' => $request->userPara ? User::find($request->userPara)->username : null,
                ]);
            }
            // return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    public function usuarios(Request $request)
    {
        $usuarios = Consultas::usuarios($request->sectorId);
        if ($usuarios) {
            return response()->json(['status' => true, 'usuarios' => $usuarios]);
        }
        return response()->json(['status' => false]);
    }
}

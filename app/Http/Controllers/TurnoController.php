<?php

namespace App\Http\Controllers;

use App\Models\Estado;
use App\Models\Historial;
use App\Models\Puesto;
use App\Models\Ticket;
use App\Models\Turno;
use App\Events\mostrarEnPantalla;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Consultas;

class TurnoController extends Controller
{
    public function index()
    {
        return view('pantalla.index');
    }

    public function checkTurno(Request $request)
    {
        $turno = Consultas::turnos()
            ->where('tickets.id', $request->id)
            ->first();

        if ($turno && $turno->estado != 6 && $turno->estado != 3) {
            $data = ['status' => true, 'turno' => $turno];
        } else {
            $data = ['status' => false, 'turno' => null];
        }

        return response()->json($data);
    }

    public function checkDataCaja()
    {
        $turnos = Consultas::turnos()
            ->where('tickets.sector', 1) // Para las CAJAS
            ->where('historiales.estado', 5) // En estado llamando
            ->get();

        $data = ($turnos->isEmpty()) ? array('status' => false, 'turnos' => null) : array('status' => true, 'turnos' => $turnos);

        return response()->json($data);
    }

    public function checkDataBox()
    {
        $turnos = Consultas::turnos()
            ->where('tickets.sector', '!=', 1) // Para los BOX
            ->where('historiales.estado', 5) // En estado llamando
            ->get();

        $data = ($turnos->isEmpty()) ? array('status' => false, 'turnos' => null) : array('status' => true, 'turnos' => $turnos);

        return response()->json($data);
    }

    public function checkSidebar()
    {
        $turnos = Consultas::turnos()
            ->where('historiales.estado', 1) // Todos los turnos en estado Atendido
            ->get();

        $data = ($turnos->isEmpty()) ? array('status' => false, 'turnos' => null) : array('status' => true, 'turnos' => $turnos);

        return response()->json($data);
    }

    public function store(Request $request)
    {
        // Buscar el turno por el ticket
        $turno = Turno::where('ticket', $request->id)->first();
        if (empty($turno)) {
            // Obtener el puesto de trabajo correspondiente
            $puestoId = Puesto::select('puestos.id')
                ->leftJoin('users', 'users.id', 'puestos.user')
                ->where('users.username', Auth::user()->username)
                ->orderByDesc('puestos.id')
                ->value('id');

            // Crear el turno en la base de datos
            $turno = Turno::create([
                'puesto' => $puestoId,
                'ticket' => $request->id
            ]);
        } else {
            // Verificar si el usuario cambió de puesto
            if ($turno->puestos->user != Auth::user()->puestos->user) {
                // Obtener el nuevo puesto de trabajo correspondiente
                $puestoId = Puesto::select('puestos.id')
                    ->leftJoin('users', 'users.id', 'puestos.user')
                    ->where('users.username', Auth::user()->username)
                    ->orderByDesc('puestos.id')
                    ->value('id');

                // Actualizar el turno en la base de datos
                $turno->update(['puesto' => $puestoId]);
            }
        }
        // Actualizar la variable "llamado" = 1 => El ticket está siendo llamado
        Ticket::find($request->id)->update([
            'derivado' => 0,
            'llamado' => 1
        ]);
        // Crear Historial
        $estado = $request->buscar ? 1 : 5;
        Historial::create([
            'turno' => $turno->id,
            'puesto' => $turno->puesto,
            'estado' => $estado
        ]);
        // Evento para la pantalla
        if ($request->llamar) {
            $ticket = Ticket::with(['turnos', 'turnos.puestos', 'turnos.puestos.mostradores'])
                ->where('tickets.id', $request->id)
                ->first();

            event(new mostrarEnPantalla($ticket));
        }
        return response()->json(['success' => true]);
    }

    public function update(Request $request, $id)
    {
        // Obtengo datos del turno
        $turno = Turno::find($id);
        // Obtengo el id del estado según el valor de $request->estado
        $estadoId = Estado::where('letra', $request->estado)->value('id');
        // Crear Historial
        Historial::create([
            'turno' => $id,
            'puesto' => $turno->puesto,
            'estado' => $estadoId
        ]);
        if ($request->estado == 'D') {
            // Actualizo valor "llamado" del ticket
            Ticket::find($turno->ticket)->update([
                'sector' => $request->sector,
                'derivado' => 1,
                'llamado' => 0
            ]);
        } elseif ($request->estado == 'P') {
            // Actualizo valor "llamado" del ticket
            Ticket::find($turno->ticket)->update([
                'llamado' => 0
            ]);
        }
        // Fecha de actualización en Turno
        $turno->update(['updated_at' => now()]);

        return response()->json(['success' => true]);
    }
}

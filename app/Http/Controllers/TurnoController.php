<?php

namespace App\Http\Controllers;

use App\Models\Estado;
use App\Models\Historial;
use App\Models\Puesto;
use App\Models\Ticket;
use App\Models\Turno;
use App\Events\llamarTicket;
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

    // public function checkNewData(Request $request)
    // {
    //     $cajaDOM = (isset($request->cajaDOM)) ? $request->cajaDOM : [];
    //     $cajaDOMSide = (isset($request->cajaDOMSide)) ? $request->cajaDOMSide : [];
    //     $boxDOM = (isset($request->boxDOM)) ? $request->boxDOM : [];
    //     $boxDOMSide = (isset($request->boxDOMSide)) ? $request->boxDOMSide : [];

    //     function crearArreglo($array)
    //     {
    //         foreach ($array as $item) {
    //             $arreglo[] = $item->alfa;
    //         }
    //         return $arreglo;
    //     }

    //     $caja = Consultas::turnos()
    //         ->where('tickets.sector', 1) // Para las CAJAS
    //         ->where('historiales.estado', 1) // En estado llamando
    //         ->get();
    //     $turnosCaja = (count($caja) > 0) ? crearArreglo($caja) : [];

    //     $cajaSidebar = Consultas::turnos()
    //         ->where('tickets.sector', 1) // Para las CAJAS
    //         ->where('historiales.estado', 3) // En estado Atendido
    //         ->get();
    //     $turnosCajaSidebar = (count($cajaSidebar) > 0) ? crearArreglo($cajaSidebar) : [];

    //     $box = Consultas::turnos()
    //         ->where('tickets.sector', '!=', 1) // Para los BOX
    //         ->where('historiales.estado', 1) // En estado llamando
    //         ->get();
    //     $turnosBox = (count($box) > 0) ? crearArreglo($box) : [];

    //     $boxSidebar = Consultas::turnos()
    //         ->where('tickets.sector', '!=', 1) // Para los BOX
    //         ->where('historiales.estado', 3) // En estado Atendido
    //         ->get();
    //     $turnosBoxSidebar = (count($boxSidebar) > 0) ? crearArreglo($boxSidebar) : [];

    //     $turno = (count($cajaDOM) != 0 or count($boxDOM) != 0) ? array_merge($cajaDOM, $boxDOM) : []; // Vienen del DOM
    //     $turnoSidebar = (count($cajaDOMSide) != 0 or count($boxDOMSide) != 0) ? array_merge($cajaDOMSide, $boxDOMSide) : []; // Vienen del DOM
    //     $nuevoTurno = (count($turnosCaja) != 0 or count($turnosBox) != 0) ? array_merge($turnosCaja, $turnosBox) : []; // Vienen de la DB
    //     $nuevoTurnoSidebar = (count($turnosCajaSidebar) != 0 or count($turnosBoxSidebar) != 0) ? array_merge($turnosCajaSidebar, $turnosBoxSidebar) : []; // Vienen de la DB

    //     $consulta = Consultas::controlRetorno($turno, $turnoSidebar, $nuevoTurno, $nuevoTurnoSidebar);

    //     return response()->json([
    //         'pantalla' => $consulta,
    //         'caja' => $caja,
    //         'cajaSidebar' => $cajaSidebar->items(),
    //         'box' => $box,
    //         'boxSidebar' => $boxSidebar->items(),
    //     ]);
    // }

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
        $turno = Turno::where('ticket', $request->id)->first();
        if (empty($turno)) {
            // Solicito a la DB el puesto de trabajo correspondiente
            $puesto = Puesto::select('puestos.id')
                ->leftjoin('users', 'users.id', 'puestos.user')
                ->where('users.username', Auth::user()->username)
                ->orderBy('puestos.id', 'DESC')
                ->first();
            // Se genera el turno en la DB
            $turno = Turno::create([
                'puesto' => $puesto->id,
                'ticket' => $request->id
            ]);
        } else {
            if ($turno->puestos->user != Auth::user()->puestos->user) {
                // Solicito a la DB el puesto de trabajo correspondiente
                $puesto = Puesto::select('puestos.id')
                    ->leftjoin('users', 'users.id', 'puestos.user')
                    ->where('users.username', Auth::user()->username)
                    ->orderBy('puestos.id', 'DESC')
                    ->first();
                // Actualizo el turno de la base de dato
                $turno->update(['puesto' => $puesto->id]);
            }
        }
        // Actualizo la variable "llamado" = 1 => El ticket está siendo llamado
        Ticket::find($request->id)->update([
            'derivado' => 0,
            'llamado' => 1
        ]);
        // Crear Historial
        if ($request->buscar) {
            Historial::create([
                'turno' => $turno->id,
                'puesto' => $turno->puesto,
                'estado' => 1
            ]);
        } else {
            Historial::create([
                'turno' => $turno->id,
                'puesto' => $turno->puesto,
                'estado' => 5
            ]);
        }
        // Evento para pantalla
        if ($request->llamar) {
            $ticket = Ticket::with(['turnos', 'turnos.puestos', 'turnos.puestos.mostradores'])
                ->where('tickets.id', $request->id)
                ->first();
            event(new llamarTicket($ticket));
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

<?php

namespace App\Http\Controllers;

use App\Events\newTicket;
use App\Models\Cliente;
use App\Models\Sector;
use App\Models\Ticket;
use Illuminate\Support\Facades\URL;

use Illuminate\Http\Request;
use App\Http\Requests\UpdateTicketRequest;
use Illuminate\Support\Facades\DB;
use Impresion;
use Consultas;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('totem.index');
    }

    /**
     * Búsqueda de clientes en la DB
     *
     * @param  \App\Http\Requests\UpdateTicketRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function search(UpdateTicketRequest $request)
    {
        $dato = $request->all();
        $cliente = Cliente::where('dni', $dato['dni'])->first();
        if (is_null($cliente)) {
            // Busco el cliente en la Base de Datos de GeaCorpico
            $cliente = DB::connection('sqlsrv')
                ->table('GeaCorpico.dbo.CLIENTE_DOCUMENTO')
                ->leftjoin('GeaCorpico.dbo.CLIENTE', 'CLI_ID', '=', 'CLD_CLIENTE')
                ->select('CLD_CLIENTE', 'CLD_NUMERO_DOCUMENTO', 'CLI_TITULAR', 'CLI_E_MAIL', 'CLI_TELEFONO_CELULAR')
                ->where('CLD_NUMERO_DOCUMENTO', $dato['dni'])
                ->first();
            // Si existe, lo agrego a la Base de Datos local
            if (!is_null($cliente)) {
                $cli_DB = array(
                    "id" => null,
                    "suministro" => $cliente->CLD_CLIENTE,
                    "dni" => $cliente->CLD_NUMERO_DOCUMENTO,
                    "titular" => $cliente->CLI_TITULAR,
                    "email" => $cliente->CLI_E_MAIL,
                    "celular" => $cliente->CLI_TELEFONO_CELULAR
                );
                Cliente::create($cli_DB);
                $cliente = Cliente::where('dni', $cliente->CLD_NUMERO_DOCUMENTO)->first();;
            } else {
                // Si NO existe, solicito a la Base de Datos local el "id = 1" => INVITADO
                $cliente = Cliente::where('id', 1)->first();
            }
        }
        $sectores = Sector::all();

        return view('totem/opciones', compact('cliente', 'sectores'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datos = $request->all();
        $sector = Sector::find($datos['sec_id']);
        $ticket = Ticket::all()->where('sector', $sector->id)->last();
        $cantidad = Ticket::all()
            ->where('sector', $sector->id)
            ->where('llamado', 0)
            ->where('eliminado', 0)
            ->where('created_at', '>=', date(today()))
            ->count();

        if (($ticket != null) && ($ticket->created_at->format('d-m') == today()->format('d-m'))) {
            $num = $ticket->numero + 1;
        } else {
            $num = 1;
        }

        Ticket::create([
            'alfa' => $sector->letra . $num,
            'cliente' => $datos['cli_id'],
            'sector' => $sector->id,
            'numero' => $num,
            'llamado' => 0,
            'derivado' => 0,
            'eliminado' => 0,
        ]);

        // Impresion::ticket($sector->letra, $num, $cantidad);

        // broadcast(new newTicket($sector->id));
        // event(new newTicket($sector->id));
        // newTicket::dispatch($sector->id);

        return redirect()->route('totem.index')->with('create', 'ok');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        // Actualizo valor "eliminado" del ticket
        $data = Ticket::find($id)->update([
            'eliminado' => 1,
            'updated_at' => now()
        ]);
        if ($data) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    public function verificarDisponibles(Request $request)
    {
        $sector = $request->sector;
        $paginate = 3;

        $tickets = Consultas::tickets()
        ->where('tickets.sector', $sector)
        ->paginate($paginate);

        if ($tickets->isEmpty()) {
            $arrResponse = array('status' => false, 'tickets' => null);
        } else {
            $arrResponse = array('status' => true, 'tickets' => $tickets->items());
        }

        return response()->json($arrResponse);
    }

    public function verificarDerivados(Request $request)
    {
        $sector = $request->sector;
        $paginate = 3;

        $tickets = Consultas::tickets(1)
        ->where('tickets.sector', $sector)
        ->paginate($paginate);

        if ($tickets->isEmpty()) {
            $arrResponse = array('status' => false, 'tickets' => null);
        } else {
            $arrResponse = array('status' => true, 'tickets' => $tickets->items());
        }

        return response()->json($arrResponse);
    }

    public function searchTicket(Request $request)
    {
        $alfa = $request->alfa;

        $ticket = Consultas::tickets()
        ->where('tickets.alfa', $alfa)
        ->first();

        if ($ticket) {
            $arrResponse = array('status' => true, 'ticket' => $ticket);
        } else {
            $arrResponse = array('status' => false, 'ticket' => null);
        }

        return response()->json($arrResponse);
    }
}

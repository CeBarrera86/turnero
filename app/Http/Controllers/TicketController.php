<?php

namespace App\Http\Controllers;

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
        // Buscar el cliente en la base de datos local
        $cliente = Cliente::where('dni', $dato['dni'])->first();
        if (is_null($cliente)) {
            // Buscar el cliente en la base de datos GeaCorpico
            $clienteGeaCorpico = DB::connection('sqlsrv')
                ->table('GeaCorpico.dbo.CLIENTE_DOCUMENTO')
                ->leftjoin('GeaCorpico.dbo.CLIENTE', 'CLI_ID', '=', 'CLD_CLIENTE')
                ->select('CLD_CLIENTE', 'CLD_NUMERO_DOCUMENTO', 'CLI_TITULAR', 'CLI_E_MAIL', 'CLI_TELEFONO_CELULAR')
                ->where('CLD_NUMERO_DOCUMENTO', $dato['dni'])
                ->first();
            if (!is_null($clienteGeaCorpico)) {
                // Si existe en GeaCorpico, agregarlo a la base de datos local
                $clienteDB = Cliente::create([
                    "suministro" => $clienteGeaCorpico->CLD_CLIENTE,
                    "dni" => $clienteGeaCorpico->CLD_NUMERO_DOCUMENTO,
                    "titular" => $clienteGeaCorpico->CLI_TITULAR,
                    "email" => $clienteGeaCorpico->CLI_E_MAIL,
                    "celular" => $clienteGeaCorpico->CLI_TELEFONO_CELULAR,
                ]);
                // Actualizar la variable $cliente para que contenga la instancia de Cliente creada
                $cliente = $clienteDB;
            } else {
                // Si NO existe en GeaCorpico, obtener el cliente "INVITADO" de la base de datos local
                $cliente = Cliente::find(1);
            }
        }
        // Obtener todos los sectores
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

        Impresion::ticket($sector->letra, $num, $cantidad);

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
        $ticket = Ticket::find($id);
        if ($ticket) {
            $ticket->update([
                'eliminado' => 1,
                'updated_at' => now()
            ]);
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }

    public function verificarDisponibles(Request $request)
    {
        $sector = $request->sector;
        $paginate = 3;
        $tickets = Consultas::tickets()
            ->where('tickets.sector', $sector)
            ->paginate($paginate);
        $status = $tickets->isNotEmpty();
        return response()->json([
            'status' => $status,
            'tickets' => $status ? $tickets->items() : null,
        ]);
    }

    public function verificarDerivados(Request $request)
    {
        $sector = $request->sector;
        $paginate = 3;
        $tickets = Consultas::tickets(1)
            ->where('tickets.sector', $sector)
            ->paginate($paginate);
        $status = $tickets->isNotEmpty();

        return response()->json([
            'status' => $status,
            'tickets' => $status ? $tickets->items() : null,
        ]);
    }

    public function searchTicket(Request $request)
    {
        $alfa = $request->alfa;
        $ticket = Consultas::tickets()
            ->where('tickets.alfa', $alfa)
            ->first();

        return response()->json([
            'status' => (bool) $ticket,
            'ticket' => $ticket,
        ]);
    }
}

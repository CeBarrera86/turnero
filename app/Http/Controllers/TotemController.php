<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateTicketRequest;
use App\Services\ClienteService;
use App\Services\TicketService;
use App\Models\Sector;

class TotemController extends Controller
{
    protected $clienteService;
    protected $ticketService;

    public function __construct(ClienteService $clienteService, TicketService $ticketService)
    {
        $this->clienteService = $clienteService;
        $this->ticketService = $ticketService;
    }

    public function index()
    {
        session()->forget(['cliente']);
        $message = session('message');
        session()->forget('message');
        return view('totem.index', compact('message'));
    }

    public function store(Request $request)
    {
        try {
            $data = $request->only('cli_id', 'sec_id');
            $this->ticketService->crearTicket($data['cli_id'], $data['sec_id']);
            $request->session()->flash('message', 'ok');
            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    public function search(UpdateTicketRequest $request)
    {
        try {
            $dni = $request->input('dni');
            $cliente = $this->clienteService->buscarOCrearCliente($dni);
            session(['cliente' => $cliente]);
            return response()->json(['cliente' => $cliente]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'trace' => env('APP_DEBUG') ? $e->getTrace() : null,
            ], 500);
        }
    }

    public function opciones(Request $request)
    {
        $cliente = json_decode(session('cliente'));
        $sectores = Cache::remember('sectores', 240, function () {
            return Sector::whereNotIn('id', [2, 3])->get();
        });
        return view('totem.opciones', compact('cliente', 'sectores'));
    }

    public function tareas(Request $request)
    {
        $cliente = json_decode(session('cliente'));
        $tareasPorSector = $this->ticketService->obtenerTareasAgrupadasPorSector();
        return view('totem.tareas', compact('cliente', 'tareasPorSector'));
    }
}

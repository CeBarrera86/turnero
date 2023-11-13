<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Turno;
use Illuminate\Http\Request;

class ReclamoController extends Controller
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paginate = 3;
        // Tickets que pertenecen a la Caja (sector = 1)
        $tickets = Ticket::where('tickets.sector', 3)
            ->where('tickets.llamado', 0)
            ->where('tickets.eliminado', 0)
            ->wheredate('tickets.created_at', today())
            ->paginate($paginate);
        // Todos los turnos del día
        $turnos = Turno::wheredate('turnos.created_at', today())
            ->get();

        return response(view('secciones.reclamos.index', compact('tickets', 'turnos')));
    }
}

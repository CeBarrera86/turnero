<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Turno;
use Illuminate\Http\Request;
use App\Http\Requests\BuscarTicketRequest;
use Facade\FlareClient\Http\Response;

use function PHPUnit\Framework\isNull;

class CajaController extends Controller
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
        return view('secciones.cajas.index');
    }
}

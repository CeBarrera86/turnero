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
        return view('secciones.reclamos.index');
    }
}

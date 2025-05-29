<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

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
        $userData = [
            'userId' => Auth::id(),
            'puestoId' => Auth::user()->puestos->id,
            'sectorId' => Auth::user()->puestos->mostradores->sector,
        ];

        return view('secciones.cajas.index', compact('userData'));
    }
}

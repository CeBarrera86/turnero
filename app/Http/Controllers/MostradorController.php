<?php

namespace App\Http\Controllers;

use App\Models\Mostrador;
use App\Models\Sector;
use App\Http\Requests\StoreMostradorRequest;
use App\Http\Requests\UpdateMostradorRequest;

class MostradorController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:1');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mostradores = Mostrador::paginate(6);
        return view('mostradores.index', compact('mostradores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sectores = Sector::all();
        return view('mostradores.create', compact('sectores'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMostradorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMostradorRequest $request)
    {
        Mostrador::create($request->all());

        session()->flash('success', '¡Mostrador creado correctamente!');
        return redirect()->route('mostradores.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mostrador  $mostrador
     * @return \Illuminate\Http\Response
     */
    public function edit(Mostrador $mostradore)
    {
        $sectores = Sector::all();
        return view('mostradores.edit', compact('mostradore', 'sectores'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMostradorRequest  $request
     * @param  \App\Models\Mostrador  $mostrador
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMostradorRequest $request, Mostrador $mostradore)
    {
        $data = $request->all();
        $mostradore->update($data);

        session()->flash('success', 'Mostrador modificado correctamente!');
        return redirect()->route('mostradores.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mostrador  $mostrador
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mostrador $mostradore)
    {
        $mostradore->delete();
        session()->flash('success', '¡Mostrador eliminado correctamente!');
        return redirect()->back();
    }
}

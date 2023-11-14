<?php

namespace App\Http\Controllers;

use App\Models\Mostrador;
use App\Models\Puesto;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\DB;

class PuestoController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePuestoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(int $id)
    {
        // Obtengo mostrador según IP del usuario que se conecta
        $ip = Request::ip();
        $mostrador = Mostrador::where('ip', $ip)->first();
        // Verifico si ya existe un login para un usuario en particular. Si no existe, creo el puesto.
        $puestoExists = Puesto::where('user', $id)
            ->whereDate('login', '>=', today())
            ->exists();

        if (!$puestoExists) {
            Puesto::create([
                'mostrador' => optional($mostrador)->id ?? 100, // 100 = 127.0.0.1 (PRUEBA)
                'user' => $id,
                'login' => now(),
                'logout' => null,
            ]);
        }

        return;
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePuestoRequest  $request
     * @param  \App\Models\Puesto  $puesto
     * @return \Illuminate\Http\Response
     */
    public function update(int $id)
    {
        DB::table('puestos')
            ->where('user', $id)
            ->whereDate('login', '>=', now()->today())
            ->update(['logout' => now()]);

        return;
    }
}

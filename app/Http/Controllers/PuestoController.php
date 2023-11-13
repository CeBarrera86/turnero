<?php

namespace App\Http\Controllers;

use App\Models\Mostrador;
use App\Models\Puesto;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StorePuestoRequest;
use App\Http\Requests\UpdatePuestoRequest;

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
        $ip = $_SERVER['REMOTE_ADDR'];
        $mostrador = Mostrador::where('ip', $ip)->first();
        // Verifico si ya existe un login para un usuario en particular. Si no existe, creo el puesto.
        $puesto = Puesto::where('user', $id)->wheredate('puestos.login', '>=', date(today()))->get();

        if ($puesto->isEmpty()) {
            Puesto::create([
                'mostrador' => isset($mostrador) ? $mostrador['id'] : 1000, // 100 = 127.0.0.1 (PRUEBA)
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
        $datos = DB::table('puestos')
            ->where('user', $id)
            ->wheredate('puestos.login', '>=', date(today()))
            ->update(['logout' => now()]);

        return;
    }
}

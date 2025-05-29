<?php

namespace App\Http\Controllers;

use App\Models\Mostrador;
use App\Models\Puesto;
use App\Models\User;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PuestoController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePuestoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store($usuario)
    {
        // Obtengo mostrador según IP del usuario que se conecta
        $ip = Request::ip();
        $mostrador = Mostrador::where('ip', $ip)->first();
        $userId = User::where('username', $usuario)->first()->id;
        $puesto = Puesto::where('user', $userId)->first();
        if (!$puesto) {
            // Si no existe un puesto, creo uno nuevo
            Puesto::create([
                'mostrador' => optional($mostrador)->id ?? 100, // 100 = 127.0.0.1 (PRUEBA)
                'user' => $userId,
                'login' => now(),
                'logout' => null,
            ]);
        } else {
            // Si el usuario ya tiene un puesto
            $loginDate = Carbon::parse($puesto->login); // Convertir la cadena de texto a un objeto Carbon
            if (!$loginDate->isToday()) {
                // Si cambió de día
                if ($mostrador && $puesto->mostrador != $mostrador->id) {
                    // Si cambió de mostrador y $mostrador no es nulo, actualizo el mostrador
                    $puesto->update([
                        'mostrador' => $mostrador->id,
                        'login' => now(),
                    ]);
                } elseif ($mostrador && $puesto->mostrador == $mostrador->id) {
                    // Si no cambió de mostrador y $mostrador no es nulo, solo actualizo el login
                    $puesto->update([
                        'login' => now(),
                    ]);
                }
            } elseif ($mostrador && $puesto->mostrador != $mostrador->id) {
                // Si no cambió de día pero cambió de mostrador y $mostrador no es nulo, solo actualizo el mostrador
                $puesto->update([
                    'mostrador' => $mostrador->id,
                ]);
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePuestoRequest  $request
     * @param  \App\Models\Puesto  $puesto
     * @return \Illuminate\Http\Response
     */
    public function update($usuario)
    {
        $userId = User::where('username', $usuario)->first()->id;
        if (!$userId) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }
        Puesto::where('user', $userId)
            ->whereDate('login', '>=', now()->today())
            ->update(['logout' => now()]);

        return response()->json(['message' => 'Actualización realizada con éxito'], 200);
    }
}

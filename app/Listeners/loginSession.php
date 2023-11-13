<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use App\Http\Controllers\PuestoController;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class loginSession
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(Login $event)
    {
        // Se generan los datos para el control de los diferentes Puestos
        $puesto = new PuestoController();
        $puesto->store($event->user->id);

        return;
    }
}

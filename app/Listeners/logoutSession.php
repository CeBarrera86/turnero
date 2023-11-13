<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Logout;
use App\Http\Controllers\PuestoController;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class logoutSession
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
    public function handle(Logout $event)
    {
        // Se generan los datos para actualizar los Puestos
        $puesto = new PuestoController();
        $puesto->update($event->user->id);

        return;
    }
}

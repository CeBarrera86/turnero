<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(
    function () {
        // CRUD Administradores
        Route::resource('estados', App\Http\Controllers\EstadoController::class);
        Route::resource('mostradores', App\Http\Controllers\MostradorController::class);
        Route::resource('publicidades', App\Http\Controllers\PublicidadController::class);
        Route::resource('roles', App\Http\Controllers\RolController::class);
        Route::get('sector/sectores', [App\Http\Controllers\SectorController::class, 'sectores'])->name('sector.sectores');
        Route::resource('sectores', App\Http\Controllers\SectorController::class);
        Route::resource('tareas', App\Http\Controllers\TareaController::class);
        Route::resource('users', App\Http\Controllers\UserController::class);

        // Rutas para Secciones
        Route::resource('secciones/cajas', App\Http\Controllers\CajaController::class);
        Route::resource('secciones/usuarios', App\Http\Controllers\UsuarioController::class);
        Route::resource('secciones/reclamos', App\Http\Controllers\ReclamoController::class);

        Route::get('ticket/verificarDisponibles', [App\Http\Controllers\TicketController::class, 'verificarDisponibles'])->name('ticket.verificarDisponibles');
        Route::get('ticket/verificarDerivados', [App\Http\Controllers\TicketController::class, 'verificarDerivados'])->name('ticket.verificarDerivados');
        Route::get('ticket/searchTicket', [App\Http\Controllers\TicketController::class, 'searchTicket'])->name('ticket.searchTicket');
        Route::resource('ticket', App\Http\Controllers\TicketController::class);

        Route::get('turno/verificarSolicitado', [App\Http\Controllers\TurnoController::class, 'verificarSolicitado'])->name('turno.verificarSolicitado');
        Route::get('turno/usuarios', [App\Http\Controllers\TurnoController::class, 'usuarios'])->name('turno.usuarios');
        Route::resource('turno', App\Http\Controllers\TurnoController::class);
    }
);

// Rutas para Totem
Route::post('totem/search', [App\Http\Controllers\TotemController::class, 'search'])->name('totem.search');
Route::get('totem/opciones', [App\Http\Controllers\TotemController::class, 'opciones'])->name('totem.opciones');
Route::get('totem/tareas', [App\Http\Controllers\TotemController::class, 'tareas'])->name('totem.tareas');
Route::resource('totem', App\Http\Controllers\TotemController::class);

// Rutas para Pantallas
Route::get('pantalla/publicidad', [App\Http\Controllers\PantallaController::class, 'publicidad'])->name('pantalla.publicidad');
Route::get('pantalla/ticketsAtendidos', [App\Http\Controllers\PantallaController::class, 'ticketsAtendidos'])->name('pantalla.ticketsAtendidos');
Route::resource('pantalla', App\Http\Controllers\PantallaController::class);

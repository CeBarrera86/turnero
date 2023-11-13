<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::group(
    ['middleware' => 'auth'],
    function () {
        // CRUD Administradores
        Route::resource('estados', App\Http\Controllers\EstadoController::class);
        Route::resource('mostradores', App\Http\Controllers\MostradorController::class);
        Route::resource('roles', App\Http\Controllers\RolController::class);
        Route::resource('sectores', App\Http\Controllers\SectorController::class);
        Route::resource('users', App\Http\Controllers\UserController::class);

        // Rutas para Secciones
        Route::resource('secciones/cajas', App\Http\Controllers\CajaController::class);
        Route::resource('secciones/usuarios', App\Http\Controllers\UsuarioController::class);
        Route::resource('secciones/reclamos', App\Http\Controllers\ReclamoController::class);

        Route::get('ticket/verificarDisponibles', [App\Http\Controllers\TicketController::class, 'verificarDisponibles'])->name('ticket.verificarDisponibles');
        Route::get('ticket/verificarDerivados', [App\Http\Controllers\TicketController::class, 'verificarDerivados'])->name('ticket.verificarDerivados');
        Route::get('ticket/searchTicket', [App\Http\Controllers\TicketController::class, 'searchTicket'])->name('ticket.searchTicket');
        Route::resource('ticket', App\Http\Controllers\TicketController::class)->except([
            'index', 'store'
        ]);
        Route::get('turno/checkTurno', [App\Http\Controllers\TurnoController::class, 'checkTurno'])->name('turno.checkTurno');
        Route::resource('turno', App\Http\Controllers\TurnoController::class)->except([
            'index'
        ]);
    }
);

// Rutas para Totem
Route::post('totem/opciones', [App\Http\Controllers\TicketController::class, 'search'])->name('totem.search');
Route::resource('totem', App\Http\Controllers\TicketController::class)->only([
    'index', 'store'
]);

// Rutas para TV
Route::get('pantalla/checkDataCaja', [App\Http\Controllers\TurnoController::class, 'checkDataCaja'])->name('pantalla.checkDataCaja');
Route::get('pantalla/checkDataBox', [App\Http\Controllers\TurnoController::class, 'checkDataBox'])->name('pantalla.checkDataBox');
Route::get('pantalla/checkSidebar', [App\Http\Controllers\TurnoController::class, 'checkSidebar'])->name('pantalla.checkSidebar');
Route::resource('pantalla', App\Http\Controllers\TurnoController::class)->only([
    'index'
]);

<?php

namespace App\Http\Controllers;

use Publicidades;
use Illuminate\Support\Facades\Storage;

class PantallaController extends Controller
{
    public function index()
    {
        return view('pantalla.index');
    }

    public function publicidad()
    {
        $archivos = Publicidades::mostrarArchivos();
        $archivosFormateados = array_values(array_map(function ($archivo) {
            $tipo = preg_match('/\.(mp4|webm|ogg|avi)$/', $archivo) ? 'video' : 'imagen';
            return [
                'tipo' => $tipo,
                'url' => Storage::url('publicidad/' . $archivo)
            ];
        }, $archivos));

        return response()->json(['archivos' => $archivosFormateados]);
    }
}

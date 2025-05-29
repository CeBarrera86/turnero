<?php

namespace App\Http\Controllers;

use App\Events\actualizarPublicidad;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Publicidades;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

class PublicidadController extends Controller
{
    private $disk = "public";

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:1|2');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $archivos = Publicidades::archivos();
        return view('publicidades.index', compact('archivos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('publicidades.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $archivos = $request->file('archivos');

        foreach ($archivos as $archivo) {
            $nombre = $archivo->getClientOriginalName();
            $archivo->storeAs('publicidad', $nombre, $this->disk);
            // Generar miniatura para imágenes
            if (in_array($archivo->getClientOriginalExtension(), ['jpg', 'jpeg', 'png', 'gif'])) {
                $rutaImagen = storage_path('app/public/publicidad/' . $nombre);
                $rutaMiniatura = storage_path('app/public/publicidad/miniatura/' . $nombre);
                // Copiar la imagen original como miniatura
                File::copy($rutaImagen, $rutaMiniatura);
            }
            // Generar miniatura para videos
            if (in_array($archivo->getClientOriginalExtension(), ['mp4', 'webm', 'ogg', 'avi'])) {
                FFMpeg::fromDisk('public')
                    ->open('publicidad/' . $nombre)
                    ->getFrameFromSeconds(10)
                    ->export()
                    ->toDisk('public')
                    ->save('publicidad/miniatura/' . pathinfo($nombre, PATHINFO_FILENAME) . '.jpg');
            }
        }
        event(new actualizarPublicidad());
        session()->flash('success', '¡Archivo(s) cargado(s) correctamente!');
        return redirect()->route('publicidades.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($archivo)
    {
        $rutaArchivo = 'public/publicidad/' . $archivo;
        $rutaMiniatura = 'public/publicidad/miniatura/' . pathinfo($archivo, PATHINFO_FILENAME) . '.jpg';

        if (Storage::exists($rutaArchivo)) {
            Storage::delete($rutaArchivo);
            // Eliminar la miniatura si existe
            if (Storage::exists($rutaMiniatura)) {
                Storage::delete($rutaMiniatura);
            }
            event(new actualizarPublicidad());
            session()->flash('success', '¡Publicidad eliminada correctamente!');
            return redirect()->back();
        } else {
            session()->flash('danger', '¡La publicidad no existe!');
            return redirect()->back();
        }
    }
}

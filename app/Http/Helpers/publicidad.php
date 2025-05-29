<?php

class Publicidades
{
    public static function mostrarArchivos()
    {
        $rutaCarpeta = storage_path('app/public/publicidad');
        $archivos = scandir($rutaCarpeta);
        // Filtrar archivos de imagen (jpg, jpeg, png, gif) y video (mp4, webm, ogg, avi)
        return array_filter($archivos, function ($archivo) {
            return preg_match('/\.(jpe?g|png|gif|mp4|webm|ogg|avi)$/', $archivo);
        });
    }

    public static function archivos()
    {
        $archivos = self::mostrarArchivos();
        // Crear una colección con los nombres de las imágenes
        $coleccionArchivos = collect($archivos);
        // Obtener el número de página actual (por defecto, página 1)
        $paginaActual = request('page', 1);
        // Elementos por página
        $elementosPorPagina = 5;
        // Calcular el índice de inicio para la página actual
        $indiceInicio = ($paginaActual - 1) * $elementosPorPagina;
        // Obtener una subcolección de imágenes para la página actual
        $archivosPaginadas = $coleccionArchivos->slice($indiceInicio, $elementosPorPagina);
        // Crear una instancia del Paginador
        $totalElementos = count($coleccionArchivos);

        return new \Illuminate\Pagination\LengthAwarePaginator(
            $archivosPaginadas,
            $totalElementos,
            $elementosPorPagina,
            $paginaActual,
            ['path' => request()->url()]
        );
    }
}

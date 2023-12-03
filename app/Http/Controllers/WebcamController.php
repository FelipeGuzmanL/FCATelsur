<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WebcamController extends Controller
{
    public function index()
    {
        return view('webcam.webcam');
    }
    public function capture()
    {
        //
    }
    public function procesarImagen(Request $request)
    {
        // Obtener la imagen de la solicitud
        $imagenDataURL = $request->input('imagen');

        // Decodificar la imagen base64
        $imagenDecodificada = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imagenDataURL));

        // Guardar la imagen en el sistema de archivos (puedes ajustar la ruta según tus necesidades)
        $rutaDeGuardado = public_path('imagenes/') . 'imagen' . '.png';
        file_put_contents($rutaDeGuardado, $imagenDecodificada);

    }
    public function verJson()
    {

        // Ruta de la imagen en el directorio public/imagenes
        $rutaImagen = public_path('imagenes/imagen.png');

        // Verificar si la imagen existe
        if (!file_exists($rutaImagen)) {
            return response()->json(['error' => 'La imagen no existe'], 404);
        }

        // Cargar el contenido de la imagen
        $contenidoImagen = file_get_contents($rutaImagen);

        // Codificar la imagen en Base64
        $imagenBase64 = base64_encode($contenidoImagen);

        // Enviar la solicitud a la API de Flask
        $response = Http::post('http://localhost:5000/procesar_imagen', [
            'imagen' => $imagenBase64,
            'otroDato' => 'valor', // Puedes enviar otros datos si es necesario
        ]);

        // Obtener la respuesta de la API de Flask
        $respuestaDeFlask = $response->json();

        // Redirigir a la ruta /verjson con la respuesta como parámetro
        return response()->json($respuestaDeFlask);
        //return redirect()->route('verjson')->with('respuestaDeFlask', $respuestaDeFlask);
    }

}

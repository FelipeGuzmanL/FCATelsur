<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        $rutaDeGuardado = public_path('imagenes/') . 'imagen_' . time() . '.png';
        file_put_contents($rutaDeGuardado, $imagenDecodificada);

        // Realizar cualquier procesamiento adicional aquí

        // Devolver una respuesta (puedes personalizar según tus necesidades)
        return response()->json(['mensaje' => 'Imagen procesada correctamente']);
    }
}

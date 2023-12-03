<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        $rutaDeGuardado = public_path('imagenes/') . 'imagen_' . time() . '.png';
        file_put_contents($rutaDeGuardado, $imagenDecodificada);

        // Realizar cualquier procesamiento adicional aquí

        // Devolver una respuesta (puedes personalizar según tus necesidades)
        return response()->json(['mensaje' => 'Imagen procesada correctamente']);
    }
    public function desdeflask(Request $request)
    {
        // Accede al JSON enviado desde Flask
        $jsonDesdeFlask = $request->json()->all();

        // Registra el contenido del JSON en el log
        Log::info('2121 JSON recibido desde Flask:', $jsonDesdeFlask);

        dd($request->json());

        //$this->verjsondesdeflask($jsonDesdeFlask);

        // Realiza cualquier acción que necesites con el JSON recibido
        // ...

        // Devuelve una respuesta (si es necesario)
        return response()->json(['message' => 'Datos procesados correctamente en Laravel', 'datos' => $jsonDesdeFlask]);
    }
    public function procesarImagenLaravel(Request $request)
    {
        // Procesar la solicitud y obtener los datos necesarios
        $data = $request->all();


        dd($data);
        // Realizar operaciones con la imagen o almacenarla según tus necesidades
        // ...

        // Devolver una respuesta, por ejemplo, un mensaje de éxito
        return response()->json(['status' => 'success', 'message' => 'Imagen recibida y procesada en Laravel']);
    }
    public function guardarImagen(Request $request)
    {
        $imagen = $request->file('imagen');
        $imagen->storeAs('public/imagenes', 'captura.png');

        return response()->json(['mensaje' => 'Imagen almacenada con éxito']);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Alerta;
use App\Models\Cable;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $alertastodas = Alerta::all();
        $cables = Cable::all();
        $porcentajes = [];
        foreach($cables as $cable){
            if($cable->id != 1){
                $contador_estados = 0;
                foreach($cable->detallecable as $filamento){
                    if($filamento->id_estado == 2){
                        $contador_estados += 1;
                    }
                }
                $calculo_porcentaje = (100 * $contador_estados)/count($cable->detallecable);
                if($calculo_porcentaje >= 75){
                    $porcentajes[] = $cable;
                }
            }
        }
        $alertas = Alerta::where('id_detallecable','!=',NULL)->orderBy('id_gravedad','desc')->paginate(5);
        $alertasolt = Alerta::whereNotNull('id_olt')->get();
        $alertasMufas = Alerta::whereNotNull('id_mufa')->get();
        return view('dashboard', compact('alertas','alertastodas','alertasolt','alertasMufas','contador_estados','porcentajes'));
    }
}

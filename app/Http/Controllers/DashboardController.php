<?php

namespace App\Http\Controllers;

use App\Models\Alerta;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $alertastodas = Alerta::all();
        $alertas = Alerta::where('id_detallecable','!=',NULL)->orderBy('id_gravedad','desc')->paginate(5);
        $alertasolt = Alerta::whereNotNull('id_olt')->get();
        return view('dashboard', compact('alertas','alertastodas','alertasolt'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Alerta;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $alertas = Alerta::paginate(5);
        return view('dashboard', compact('alertas'));
    }
}

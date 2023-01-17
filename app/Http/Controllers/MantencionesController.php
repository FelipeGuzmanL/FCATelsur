<?php

namespace App\Http\Controllers;

use App\Models\EquiposMSAN;
use App\Models\MantencionMsan;
use Illuminate\Http\Request;

class MantencionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('mantenciones.index');
    }

    public function index_msan()
    {
        $equipos = EquiposMSAN::all();
        return view('mantenciones.index_msan', compact('equipos'));
    }

    public function index_msan_mantencion(EquiposMSAN $equipo, MantencionMsan $mantenciones)
    {
        $mantenciones = MantencionMsan::all();
        return view('mantenciones.index_msan_mantencion', compact('equipo','mantenciones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(EquiposMSAN $equipo, MantencionMsan $mantenciones)
    {
        dd($equipo);
        return view('mantenciones.create', compact('equipo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

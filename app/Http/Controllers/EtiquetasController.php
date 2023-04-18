<?php

namespace App\Http\Controllers;

use App\Models\Cable;
use App\Models\Etiquetas;
use Illuminate\Http\Request;

class EtiquetasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $etiquetas = Etiquetas::all();
        return view('etiquetas.index', compact('etiquetas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cables = Cable::all();
        return view('etiquetas.create', compact('cables'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $etiquetas = Etiquetas::create(array_merge($request->only('etiqueta','id_cable'),['id_cable'=>$request->id_cable]));
        return redirect()->route('etiquetas.index')->with('success','etiqueta creada correctamente');
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
    public function edit(Etiquetas $etiqueta)
    {
        $cables = Cable::all();
        return view('etiquetas.edit', compact('etiqueta','cables'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Etiquetas $etiqueta)
    {
        $etiqueta->update(array_merge($request->only('etiqueta','id_cable'),['id_cable'=>$request->id_cable]));
        return redirect()->route('etiquetas.index')->with('success','etiqueta actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Etiquetas $etiqueta)
    {
        $etiqueta->delete();
        return redirect()->route('etiquetas.index')->with('warning','Etiqueta se ha eliminado correctamente.');
    }
}

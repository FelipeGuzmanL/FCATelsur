<?php

namespace App\Http\Controllers;

use App\Models\Cable;
use App\Models\DetalleCable;
use App\Models\Mufa;
use Illuminate\Http\Request;

class MufasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Cable $cable, Request $request)
    {
        if ($request) {
            $texto = trim($request->get('texto'));
            $mufas = Mufa::WhereRaw('UPPER(distancia_k) LIKE ?', ['%' . strtoupper($texto) . '%'])
            ->orWhereRaw('UPPER(ruta5_k) LIKE ?', ['%' . strtoupper($texto) . '%'])
            ->orWhereRaw('UPPER(ubicacion) LIKE ?', ['%' . strtoupper($texto) . '%'])
            ->orWhereRaw('UPPER(latitud) LIKE ?', ['%' . strtoupper($texto) . '%'])
            ->orWhereRaw('UPPER(longitud) LIKE ?', ['%' . strtoupper($texto) . '%'])
            ->orWhereRaw('UPPER(fecha) LIKE ?', ['%' . strtoupper($texto) . '%'])
            ->orWhere('item','LIKE','%'.$texto.'%')
            ->orderBy('id','asc')
            ->paginate(15);

            return view('mufas.index', compact('cable'), ['mufas' => $mufas, 'texto' => $texto]);
        }
        $mufas = Mufa::where('id_cable',$cable->id)->paginate(15);
        return view('mufas.index', compact('cable','mufas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Cable $cable)
    {
        return view('mufas.create', compact('cable'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Cable $cable)
    {
        $mufa = Mufa::create(array_merge($request->only('id_cable','item','distancia_k','ruta5_k','ubicacion','latitud','longitud','observaciones','link_gmaps','fecha'),['id_cable'=>$cable->id]));
        return redirect()->route('cable.mufas.index',$cable)->with('success','Mufa creada correctamente');
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
    public function edit(Cable $cable, Mufa $mufa)
    {
        return view ('mufas.edit', compact('cable','mufa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cable $cable, Mufa $mufa)
    {
        $mufa->update(array_merge($request->only('id_cable','item','distancia_k','ruta5_k','ubicacion','latitud','longitud','observaciones','link_gmaps','fecha'),['id_cable'=>$cable->id]));
        return redirect()->route('cable.mufas.index',$cable)->with('success','Mufa actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cable $cable, Mufa $mufa)
    {
        $mufa->delete();
        return redirect()->route('cable.mufas.index', $cable)->with('warning','Mufa eliminada correctamente.');
    }
}

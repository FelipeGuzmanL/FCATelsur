<?php

namespace App\Http\Controllers;

use App\Models\EquiposMSAN;
use App\Models\Sitio;
use App\Models\Ubicacion;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class EquiposMSANController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request) {
            $texto = trim($request->get('texto'));
            $equipos = EquiposMSAN::Where('numero','LIKE','%'.$texto.'%')
            ->orWhereHas('ubicacion', function (Builder $query) use ($texto){
                $query->whereRaw('UPPER(coordenadas) LIKE ?', ['%' . strtoupper($texto) . '%']);
            })
            ->orWhereHas('sitio', function (Builder $query) use ($texto){
                $query->whereRaw('UPPER(nombre) LIKE ?', ['%' . strtoupper($texto) . '%']);
            })
            ->orderBy('id','asc')
            ->get();

            return view('equiposmsan.index', ['equipos' => $equipos, 'texto' => $texto]);
        }
        $equipos = EquiposMSAN::all();
        return view('equiposmsan.index', compact('equipos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('equiposmsan.create', ['equiposmsan'=>EquiposMSAN::all(),'ubicacion'=>Ubicacion::all(),'sitio'=>Sitio::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ubicacion = Ubicacion::create(array_merge($request->only('id_ciudad','direccion','coordenadas','link_gmaps','sitio_fca','descripcion_sitio'),['id_ciudad'=>$request->id_ubicacion]));
        $msan = EquiposMSAN::create(array_merge($request->only('id_ubicacion','id_sitio','numero','tecnologia'),['id_ubicacion'=>$ubicacion->id,'id_sitio'=>$request->id_ubicacion]));
        return redirect()->route('equiposmsan.index')->with('success','Equipo MSAN guardado correctamente.');
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
    public function edit(EquiposMSAN $equipos)
    {   
        return view('equiposmsan.edit', compact('equipos'),['ubicacion'=>Ubicacion::all(),'sitio'=>Sitio::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EquiposMSAN $equipos)
    {
        $ubicacion = $equipos->Ubicacion;
        $ubicacion->update(array_merge($request->only('id_ciudad','direccion','coordenadas','link_gmaps','sitio_fca','descripcion_sitio'),['id_ciudad'=>$request->id_ubicacion]));
        $equipos->update(array_merge($request->only('id_ubicacion','id_sitio','numero','tecnologia'),['id_ubicacion'=>$ubicacion->id,'id_sitio'=>$request->id_ubicacion]));
        return redirect()->route('equiposmsan.index')->with('success', 'Equipo actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(EquiposMSAN $equipo, Request $request)
    {
        $equipo->delete();
        $equipo->ubicacion->delete();
        return redirect()->route('equiposmsan.index')->with('success','Equipo MSAN eliminado correctamente.');
    }
}

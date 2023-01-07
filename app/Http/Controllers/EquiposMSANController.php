<?php

namespace App\Http\Controllers;

use App\Models\EquiposMSAN;
use App\Models\Sitio;
use App\Models\Tecnologia;
use App\Models\Ubicacion;
use App\Models\SlotTecnologia;
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
            ->orWhereHas('sitio', function (Builder $query) use ($texto){
                $query->whereRaw('UPPER(nombre) LIKE ?', ['%' . strtoupper($texto) . '%']);
            })
            ->orderBy('numero','asc')
            ->paginate(10);

            return view('equiposmsan.index', ['equipos' => $equipos, 'texto' => $texto]);
        }
        $equipos = EquiposMSAN::all();
        return view('equiposmsan.index', compact('equipos'));
    }

    public function index_equipo(Sitio $sitio)
    {
        dd($sitio);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('equiposmsan.create', ['equiposmsan'=>EquiposMSAN::all(),'ubicacion'=>Ubicacion::all(),'sitio'=>Sitio::all(),'tecnologias'=>Tecnologia::all(),'slotstec'=>SlotTecnologia::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id_usuario = auth()->user()->id;
        $ubicacion = Ubicacion::create(array_merge($request->only('id_ciudad','direccion','link_gmaps','sitio_fca','descripcion_sitio'),['id_ciudad'=>$request->id_ubicacion]));
        $msan = EquiposMSAN::create(array_merge($request->only('id_ubicacion','id_usuario','id_sitio','id_tecnologia','id_slotec','numero'),[
            'id_ubicacion'=>$ubicacion->id,
            'id_sitio'=>$request->id_ubicacion,
            'id_tecnologia'=>$request->id_tecnologia,
            'id_slotec'=>$request->id_slotec,
            'id_usuario'=>$id_usuario
        ]));
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
        return view('equiposmsan.edit', compact('equipos'),['ubicacion'=>Ubicacion::all(),'sitio'=>Sitio::all(),'tecnologias'=>Tecnologia::all(),'slotstec'=>SlotTecnologia::all()]);
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
        $id_usuario = auth()->user();
        $ubicacion->update(array_merge($request->only('id_ciudad','direccion','link_gmaps','sitio_fca','descripcion_sitio'),['id_ciudad'=>$request->id_ubicacion]));
        $equipos->update(array_merge($request->only('id_ubicacion','id_usuario','id_sitio','id_tecnologia','id_slotec','numero'),[
            'id_ubicacion'=>$ubicacion->id,
            'id_sitio'=>$request->id_ubicacion,
            'id_tecnologia'=>$request->id_tecnologia,
            'id_slotec'=>$request->id_slotec,
            'id_usuario'=>$id_usuario->id,
        ]));
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
        $contador = $equipo->slot;
        for ($i=1; $i <= count($contador) ; $i++) {
            $contador2 = $equipo->slot[$i-1]->slotmsan;
            for ($i=1; $i <= count($contador2) ; $i++) {
                $contador2[$i-1]->delete();
            }
            $contador[$i-1]->delete();
        }
        $equipo->delete();
        $equipo->ubicacion->delete();
        return redirect()->route('equiposmsan.index')->with('success','Equipo MSAN eliminado correctamente.');
    }
}

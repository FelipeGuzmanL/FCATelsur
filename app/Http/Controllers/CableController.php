<?php

namespace App\Http\Controllers;

use App\Models\Cable;
use App\Models\DetalleCable;
use App\Models\EquiposMSAN;
use App\Models\Sitio;
use App\Models\Slot;
use App\Models\SlotMSAN;
use App\Models\TipoCable;
use App\Models\Ubicacion;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class CableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(EquiposMSAN $equipo, Slot $slot, SlotMSAN $olt, Cable $cables, Request $request)
    {
        if ($request) {
            $texto = trim($request->get('texto'));
            $cables = Cable::WhereRaw('UPPER(nombre_cable) LIKE ?', ['%' . strtoupper($texto) . '%'])
            ->orWhere('cant_filam','LIKE','%'.$texto.'%')
            ->orWhereHas('sitio', function (Builder $query) use ($texto){
                $query->whereRaw('UPPER(nombre) LIKE ?', ['%' . strtoupper($texto) . '%']);
            })
            ->orWhereHas('tipocable', function (Builder $query) use ($texto){
                $query->whereRaw('UPPER(tipo) LIKE ?', ['%' . strtoupper($texto) . '%']);
            })
            ->orderBy('id','asc')
            ->paginate(25);

            return view('cable.index', compact('cables'), ['olts' => $cables, 'texto' => $texto]);
        }

        $cables = Cable::all();
        return view('cable.index', ['cables'=> $cables->paginate(5)]);
    }

    public function index_cable(EquiposMSAN $equipo, Slot $slot, SlotMSAN $olt, Cable $cables, Request $request)
    {
        dd($equipo);
        return view('cable.index_cable', compact('cables'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cable.create',['cables'=>Cable::all(),'ubicacion'=>Ubicacion::all(),'sitio'=>Sitio::all(),'tipocable'=>TipoCable::all()]);
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
        $cable = Cable::create(array_merge($request->only('id_sitio','id_tipo_cable','nombre_cable','cant_filam','descripcion'),['id_sitio'=>$request->id_sitio,'id_tipo_cable'=>$request->id_tipo_cable]));
        for ($i=1; $i <= $request->cant_filam ; $i++) {
            $detalle = DetalleCable::create(array_merge($request->only('filamento','id_estado','id_usuario','id_cable'),[
                'filamento'=>$i,
                'id_estado'=>"1",
                'id_cable'=>$cable->id,
                'id_usuario'=>$id_usuario
            ]));
        }
        return redirect()->route('cable.index')->with('success','Cable creado correctamente.');
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
    public function edit(Cable $cable)
    {
        return view('cable.edit', compact('cable'),['sitio'=>Sitio::all(),'tipocable'=>TipoCable::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cable $cable)
    {
        $cable->update(array_merge($request->only('id_sitio','id_tipo_cable','nombre_cable','cant_filam','descripcion'),['id_sitio'=>$request->id_sitio,'id_tipo_cable'=>$request->id_tipo_cable]));
        if(count($cable->detallecable)==0){
            for ($i=1; $i <= $request->cant_filam ; $i++)
            {
                $detalle = DetalleCable::create(array_merge($request->only('filamento','id_estado','id_cable'),['filamento'=>$i,'id_estado'=>"1",'id_cable'=>$cable->id]));
            }
        }
        if(count($cable->detallecable)>0 && count($cable->detallecable)!=$request->cant_filam)
        {
            $detalles = $cable->detallecable;
            if (count($detalles)>0){
                for ($i=0;$i<=count($detalles)-1;$i++)
                {
                    $detalles[$i]->delete();
                }
            }
            for ($i=1; $i <= $request->cant_filam ; $i++)
            {
                $detalle = DetalleCable::create(array_merge($request->only('filamento','id_estado','id_cable'),['filamento'=>$i,'id_estado'=>"1",'id_cable'=>$cable->id]));
            }
        }
        return redirect()->route('cable.index')->with('success','Cable '.$cable->nombre_cable.' actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cable $cable)
    {
        $detalles = $cable->detallecable;
        if (count($detalles)>0){
            for ($i=0;$i<=count($detalles)-1;$i++)
            {
                $detalles[$i]->delete();
            }
        }
        $cable->delete();
        return redirect()->route('cable.index')->with('succes','Cable'.$cable->nombre_cable.'se ha eliminado correctamente.');
    }
}

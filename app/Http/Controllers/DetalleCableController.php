<?php

namespace App\Http\Controllers;

use App\Models\Cable;
use App\Models\DetalleCable;
use App\Models\Estado;
use App\Models\Slot;
use App\Models\SlotMSAN;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class DetalleCableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Cable $cable, DetalleCable $detalles,Slot $slot,Request $request    )
    {
        /*$contador = count($cable->slotmsan);
        $slot = Slot::all();
        $contador2 = count($slot);
        if ($contador > 0)
        {
            for ($i=0;$i<$contador2;$i++)
            {
                for ($j=0; $j<count($slot[$i]->slotmsan);$j++)
                {
                    $id_slots[$i][$j] = $slot[$i]->slotmsan[$j]->id_slot;
                    if ($slot[$i]->id == $id_slots[$i][$j])
                    {
                        echo($slot[$i]->slot_msan.'-'.$slot[$i]->slotmsan[$j]->olt.' ');
                    }
                    $slots[$j] = $id_slots;
                }
            }
        }
        dd($cable->slotmsan);*/
        if ($request) {
                $texto = trim($request->get('texto'));
                $detalles = DetalleCable::WhereRaw('UPPER(direccion) LIKE ?', ['%' . strtoupper($texto) . '%'])
                ->orWhere('filamento','LIKE','%'.$texto.'%')
                ->orWhere('longitud','LIKE','%'.$texto.'%')
                ->orWhereRaw('UPPER(servicio) LIKE ?', ['%' . strtoupper($texto) . '%'])
                ->orWhereRaw('UPPER(cruzada) LIKE ?', ['%' . strtoupper($texto) . '%'])
                ->orWhereRaw('UPPER(observaciones) LIKE ?', ['%' . strtoupper($texto) . '%'])
                ->orWhereHas('estado', function (Builder $query) use ($texto){
                    $query->whereRaw('UPPER(estado) LIKE ?', ['%' . strtoupper($texto) . '%']);
                })
                ->orderBy('filamento','asc')
                ->get();

                return view('cabledetalles.index', compact('cable','detalles'), ['detalles' => $detalles, 'texto' => $texto]);
        }
        $detalles = DetalleCable::all();
        return view('cabledetalles.index', compact('cable','detalles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Cable $cable)
    {
        return view('cabledetalles.create', compact('cable'),['estado'=>Estado::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Cable $cable, DetalleCable $detalle)
    {
        $detalle = DetalleCable::create(array_merge($request->only('id_cable','id_estado','filamento','direccion','servicio','cruzada','longitud','observaciones','gmaps'),[
            'id_cable'=>$cable->id,
            'id_estado'=>$request->id_estado]));
        return redirect()->route('cable.detallecable.index', $cable->id)->with('success','Detalles agregado correctamente.');
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
    public function edit(Cable $cable, DetalleCable $detalles)
    {
        return view('cabledetalles.edit', compact('cable','detalles'),['estado'=>Estado::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cable $cable, DetalleCable $detalle)
    {
        $id_usuario = auth()->user()->id;
        $detalle->update(array_merge($request->only('id_estado','id_usuario','filamento','direccion','servicio','cruzada','longitud','observaciones','gmaps'),[
            'id_estado'=>$request->id_estado,
            'id_usuario'=>$id_usuario
        ]));
        return redirect()->route('cable.detallecable.index', $cable->id)->with('success','Filamento '.$detalle->filamento.' actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Cable $cable, DetalleCable $detalle)
    {
        $null = NULL;
        $detalle->update(array_merge($request->only('id_estado','direccion','servicio','cruzada','longitud','observaciones','gmaps'),[
            'id_estado'=>'1',
            'direccion'=>$null,
            'servicio'=>$null,
            'cruzada'=>$null,
            'longitud'=>$null,
            'observaciones'=>$null,
            'gmaps'=>$null
        ]));
        return redirect()->route('cable.detallecable.index', $cable->id)->with('warning','Filamento '.$detalle->filamento.' eliminado correctamente.');
    }
}

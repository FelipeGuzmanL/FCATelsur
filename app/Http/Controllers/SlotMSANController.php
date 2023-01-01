<?php

namespace App\Http\Controllers;

use App\Models\Cable;
use App\Models\CableSlot;
use App\Models\EquiposMSAN;
use App\Models\Estado;
use App\Models\Slot;
use App\Models\SlotMSAN;
use Illuminate\Http\Request;

class SlotMSANController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(EquiposMSAN $equipo, Slot $slot, SlotMSAN $olt)
    {
        $olts = SlotMSAN::all();
        return view('olt.index', compact('equipo','slot','olts'));
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     *
     */
    public function create(EquiposMSAN $equipo, Slot $slot)
    {
        return view('olt.create', compact('equipo','slot'),['estado'=>Estado::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, EquiposMSAN $equipo, Slot $slot, CableSlot $cableslot)
    {
        $nombre_cable = $request->nombre_cable;
        $cable = Cable::create(array_merge($request->only('nombre_cable')));
        $olt = SlotMSAN::create(array_merge($request->only('id_slot','id_cable','id_estado','sitio_fca','descripcion_fca','olt','spl','filam'),[
            'id_slot'=>$slot->id,
            'id_cable'=>$cable->id,
            'id_estado'=>$request->id_estado
        ]));
        $cableslot = CableSlot::create(array_merge($request->only('id_slot','id_cable'),['id_slot'=>$olt->id,'id_cable'=>$cable->id]));
        return redirect()->route('equiposmsan.slots.olt.index', [$equipo,$slot])->with('success','OLT Guardada correctamente.');
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
    public function destroy(EquiposMSAN $equipo, Slot $slot, SlotMSAN $olt)
    {
        $olt->delete();
        return redirect()->route('equiposmsan.slots.olt.index', [$equipo,$slot]);
    }
}

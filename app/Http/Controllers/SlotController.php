<?php

namespace App\Http\Controllers;

use App\Models\EquiposMSAN;
use App\Models\Slot;
use App\Models\Estado;
use Illuminate\Http\Request;

class SlotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(EquiposMSAN $equipo, Slot $slots, Estado $estado)
    {
        $slots = Slot::all();
        $estado = Estado::all();
        return view('slots.index', compact('slots','equipo','estado'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, EquiposMSAN $equipo)
    {
        $slot_msan = $equipo->numero.'-'.$request->slot_msan;
        $slot = Slot::create(array_merge($request->only('id_msan','id_estado','slot_msan'),['id_msan'=>$equipo->id,'slot_msan'=>$slot_msan,'id_estado'=>$request->id_estado]));
        return redirect()->route('equiposmsan.slots.index', $equipo->id)->with('success','Slot guardado correctamente.');
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
    public function edit(EquiposMSAN $equipo, Slot $slot)
    {
        return view('slots.edit', compact('equipo','slot'),['estado'=>Estado::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EquiposMSAN $equipo, Slot $slot)
    {
        $slot->update(array_merge($request->only('slot_msan','id_estado'),['id_estado'=>$request->id_estado]));
        return redirect()->route('equiposmsan.slots.index', $equipo->id)->with('success','Slot actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(EquiposMSAN $equipo, Slot $slot, Request $request)
    {
        $slot->delete();
        return redirect()->route('equiposmsan.slots.index', $equipo->id);
    }
}

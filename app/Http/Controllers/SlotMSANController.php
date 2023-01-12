<?php

namespace App\Http\Controllers;

use App\Models\Cable;
use App\Models\CableSlot;
use App\Models\DetalleCable;
use App\Models\EquiposMSAN;
use App\Models\Estado;
use App\Models\Slot;
use App\Models\SlotMSAN;
use App\Models\Tecnologia;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class SlotMSANController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(EquiposMSAN $equipo, Slot $slot, SlotMSAN $olt, Request $request)
    {
        if ($request) {
            if ($slot->id_msan == $equipo->id){
                $texto = trim($request->get('texto'));
                $olts = SlotMSAN::WhereRaw('UPPER(sitio_fca) LIKE ?', ['%' . strtoupper($texto) . '%'])
                ->orWhere('olt','LIKE','%'.$texto.'%')
                ->orWhere('spl','LIKE','%'.$texto.'%')
                ->orWhere('filam','LIKE','%'.$texto.'%')
                ->orWhereRaw('UPPER(descripcion_fca) LIKE ?', ['%' . strtoupper($texto) . '%'])
                ->orWhereHas('estad', function (Builder $query) use ($texto){
                    $query->whereRaw('UPPER(estado) LIKE ?', ['%' . strtoupper($texto) . '%']);
                })
                ->orWhereHas('cable', function (Builder $query) use ($texto){
                    $query->whereRaw('UPPER(nombre_cable) LIKE ?', ['%' . strtoupper($texto) . '%']);
                })
                ->orderBy('id','asc')
                ->get();

                return view('olt.index', compact('equipo','slot','olts'), ['olts' => $olts, 'texto' => $texto]);
            }
        }
        $olts = SlotMSAN::all();
        return view('olt.index', compact('equipo','slot','olts'));
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     *
     */
    public function create(EquiposMSAN $equipo, Slot $slot, Cable $cables)
    {
        $slotstec = $equipo->tecnologia->slotstec;
        return view('olt.create', compact('equipo','slot','slotstec'),['estado'=>Estado::all(),'cables'=>Cable::all()]);
        //return redirect()->route('equiposmsan.slots.olt.store', [$equipo,$slot]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, EquiposMSAN $equipo, Slot $slot, SlotMSAN $olt)
    {
        $contador = $slot->slotmsan;
        $id_usuario = auth()->user()->id;

        if (count($contador)==0){
            for ($i=1; $i <= $request->id_slotec ; $i++) {
                $olt = SlotMSAN::create(array_merge($request->only('id_slot','id_cable','id_estado','olt','id_usuario'),[
                    'olt'=>$i,
                    'id_slot'=>$slot->id,
                    'id_cable'=>$request->id_cable,
                    'id_estado'=>$request->id_estado,
                    'id_usuario'=>$id_usuario
                ]));
            }
            return redirect()->route('equiposmsan.slots.olt.index', [$equipo,$slot])->with('success','OLT Guardada correctamente.');
        }
        else{
            return redirect()->route('equiposmsan.slots.olt.index', [$equipo,$slot])->with('failure','OLTs ya creadas.');
        }

    }
    public function generarolts(Request $request, EquiposMSAN $equipo, Slot $slot, CableSlot $cableslot)
    {
        dd($equipo);
        for ($i=1; $i <= $equipo->slotec->slots ; $i++) {
            $olt = SlotMSAN::create(array_merge($request->only('id_slot','id_cable','id_estado','olt'),[
                'olt'=>$i,
                'id_slot'=>$slot->id,
                'id_cable'=>$request->id_cable,
                'id_estado'=>$request->id_estado
            ]));
        }
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
    public function edit(EquiposMSAN $equipo, Slot $slot, SlotMSAN $olt)
    {
        return view('olt.edit', compact('equipo','slot','olt'),['cables'=>Cable::all(),'estados'=>Estado::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EquiposMSAN $equipo, Slot $slot, SlotMSAN $olt)
    {
        $idusuario = auth()->user()->id;
        $olts = $request->olt->olt;
        $filamento = $request->filam;
        $sin_filam = $olt->filam;

        //dd($sin_filam);
        if ($filamento != NULL && $sin_filam == NULL){
            $existe = DB::table('slot_msan')->where('id_cable',$request->id_cable)
            ->where('filam',$filamento)
            ->exists();
            if($existe == false)
            {
                $olt->update(array_merge($request->only('id_cable','id_usuario','id_estado','sitio_fca','link_sitio_fca','descripcion_fca','olt','spl','filam'),[
                    'id_cable'=>$request->id_cable,
                    'id_estado'=>'2',
                    'id_usuario'=>$idusuario
                ]));
                $detalle = $olt->cable->detallecable[$filamento-1];
                $slotolt = $slot->slot_msan.'-'.$olts;
                $detalle->update(array_merge($request->only('ocupacion','id_estado'),['ocupacion'=>$slotolt,'id_estado'=>'2']));
            }
            if($existe==true)
            {
                return redirect()->route('equiposmsan.slots.olt.index', [$equipo,$slot,$olt])->with('failure','Filamento ya ocupado.');
            }
        }
        if($filamento == NULL && $sin_filam != NULL){
            $olt->update(array_merge($request->only('id_cable','id_usuario','id_estado','sitio_fca','link_sitio_fca','descripcion_fca','olt','spl','filam'),[
                'id_cable'=>$request->id_cable,
                'id_estado'=>'1',
                'id_usuario'=>$idusuario
            ]));
            $detalle = $olt->cable->detallecable[$sin_filam-1];
            $slotolt = $slot->slot_msan.'-'.$olts;
            $detalle->update(array_merge($request->only('ocupacion','id_estado'),['ocupacion'=>'','id_estado'=>'1']));
        }
        if($filamento != NULL && $sin_filam != NULL && $filamento != $sin_filam)
        {
            $existe = DB::table('slot_msan')->where('id_cable',$request->id_cable)
            ->where('filam',$filamento)
            ->exists();
            if ($existe==false)
            {
                $detalle = $olt->cable->detallecable[$sin_filam-1];
                $detalle->update(array_merge($request->only('ocupacion','id_estado'),['ocupacion'=>'','id_estado'=>'1']));
                $olt->update(array_merge($request->only('id_cable','id_usuario','id_estado','sitio_fca','link_sitio_fca','descripcion_fca','olt','spl','filam'),[
                    'id_cable'=>$request->id_cable,
                    'id_estado'=>'2',
                    'id_usuario'=>$idusuario
                ]));
                $detalle = $olt->cable->detallecable[$filamento-1];
                $slotolt = $slot->slot_msan.'-'.$olts;
                $detalle->update(array_merge($request->only('ocupacion','id_estado'),['ocupacion'=>$slotolt,'id_estado'=>'2']));
            }
            if($existe==true)
            {
                return redirect()->route('equiposmsan.slots.olt.index', [$equipo,$slot,$olt])->with('failure','Filamento ya ocupado.');
            }
        }
        if ($filamento == $sin_filam)
        {
            $olt->update(array_merge($request->only('id_cable','id_usuario','id_estado','sitio_fca','link_sitio_fca','descripcion_fca','olt','spl','filam'),[
                'id_cable'=>$request->id_cable,
                'id_estado'=>'2',
                'id_usuario'=>$idusuario
            ]));
        }
        
        return redirect()->route('equiposmsan.slots.olt.index', [$equipo,$slot,$olt])->with('success','OLT actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, EquiposMSAN $equipo, Slot $slot, SlotMSAN $olt)
    {
        $cable = $olt->cable->id;
        $estado = $olt->estad->id;
        $filamento = $olt->filam;
        $detalle = $olt->cable->detallecable[$filamento-1];
        $detalle->update(array_merge($request->only('ocupacion','id_estado'),['ocupacion'=>'','id_estado'=>'1']));
        $null = NULL;
        $olt->update(array_merge($request->only('id_cable','id_estado','sitio_fca','link_sitio_fca','descripcion_fca','olt','spl','filam'),[
            'id_cable'=>'1',
            'id_estado'=>'1',
            'sitio_fca'=>$null,
            'descripcion_fca'=>$null,
            'spl'=>$null,
            'filam'=>$null
        ]));
        //$olt->delete();
        return redirect()->route('equiposmsan.slots.olt.index', [$equipo,$slot]);
    }
}

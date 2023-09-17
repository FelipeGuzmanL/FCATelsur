<?php

namespace App\Http\Controllers;

use App\Models\Alerta;
use App\Models\Cable;
use App\Models\DetalleCable;
use App\Models\EquiposMSAN;
use App\Models\GravedadAlerta;
use App\Models\Mufa;
use App\Models\Slot;
use App\Models\SlotMSAN;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class AlertaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(EquiposMSAN $equipo, Slot $slot, SlotMSAN $olt)
    {
        $gravedad = GravedadAlerta::all();
        return view('alertas.index', compact('equipo', 'slot', 'olt', 'gravedad'));
    }
    public function index_cable(DetalleCable $detalles, $id)
    {
        $gravedad = GravedadAlerta::all();
        $detalles = DetalleCable::find($id);
        return view('alertas.index_detallecable', compact('detalles','gravedad'));
    }
    public function index_mufas(Alerta $alerta)
    {
        $gravedad = GravedadAlerta::all();
        return view ('alertas.index_mufa', compact('alerta'));
    }
    public function create_mufas(Mufa $mufa)
    {
        $gravedad = GravedadAlerta::all();
        return view ('alertas.create_mufa', compact('mufa','gravedad'));
    }
    public function index_todaslasalertas(Request $request)
    {
        if ($request) {
            $texto = trim($request->get('texto'));
            $alertas = Alerta::whereRaw('UPPER(observacion) LIKE ?', ['%' . strtoupper($texto) . '%'])
            ->orWhereHas('detallecable', function (Builder $query) use ($texto){
                $query->where('filamento','LIKE','%'.$texto.'%')
                ->orWhereHas('cable', function (Builder $query) use ($texto){
                    $query->whereRaw('UPPER(nombre_cable) LIKE ?', ['%' . strtoupper($texto) . '%'])
                    ->orWhereHas('sitio', function (Builder $query) use ($texto){
                        $query->whereRaw('UPPER(abreviacion) LIKE ?', ['%' . strtoupper($texto) . '%']);
                    })
                    ->orWhereHas('tipocable', function (Builder $query) use ($texto){
                        $query->whereRaw('UPPER(tipo) LIKE ?', ['%' . strtoupper($texto) . '%']);
                    });
                });
            })
            ->orWhereHas('olt', function (Builder $query) use ($texto){
                $query->where('olt','LIKE','%'.$texto.'%')
                ->orWhereHas('msan', function (Builder $query) use ($texto){
                    $query->whereRaw('UPPER(slot_msan) LIKE ?', ['%' . strtoupper($texto) . '%'])
                    ->orWhereHas('equiposmsan', function (Builder $query) use ($texto){
                        $query->WhereHas('sitio', function (Builder $query) use ($texto){
                            $query->whereRaw('UPPER(abreviacion) LIKE ?', ['%' . strtoupper($texto) . '%']);
                        });
                    });
                });
            })
            ->orWhereHas('gravedad', function (Builder $query) use ($texto){
                $query->whereRaw('UPPER(gravedad) LIKE ?', ['%' . strtoupper($texto) . '%']);
            })
            ->orderBy('id','asc')
            ->paginate(10);

            return view('alertas.index_alertas', ['alertas' => $alertas, 'texto' => $texto]);
        }
        return view('alertas.index_alertas',['alertas'=>Alerta::paginate(10)]);
    }

    public function index_olt(Request $request)
    {
        $alertas = Alerta::whereNotNull('id_olt')->paginate(10);
        //dd($alertas);
        return view('alertas.index_olt',compact('alertas'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(EquiposMSAN $equiposMSAN, Slot $slot, SlotMSAN $olt)
    {
        dd($olt);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, EquiposMSAN $equipo, Slot $slot, SlotMSAN $olt)
    {
        $alerta = Alerta::create(array_merge($request->only('id_gravedad','observacion','id_olt'),['id_gravedad'=>$request->id_gravedad,
        'id_olt'=>$olt->id]));
        return redirect()->route('equiposmsan.slots.olt.index', [$equipo,$slot,$olt])->with('warning','Alerta de la OLT '.$olt->id.' creada correctamente.');
    }

    public function store_cable(Request $request, DetalleCable $detalles)
    {
        $alerta = Alerta::create(array_merge($request->only('id_gravedad','observacion','id_detallecable'),['id_gravedad'=>$request->id_gravedad,
        'id_detallecable'=>$detalles->id]));
        return redirect()->route('cable.detallecable.index', [$detalles->cable,$detalles])->with('warning','Alerta del filamento '.$detalles->filamento.' creada correctamente.');
    }
    public function store_mufas (Request $request, Mufa $mufa)
    {
        $cable = $mufa->cable;
        $alerta = Alerta::create(array_merge($request->only('id_mufa','id_gravedad','observacion'),['id_mufa'=>$mufa->id,'id_gravedad'=>$request->id_gravedad]));
        return redirect()->route('cable.mufas.index', [$cable, $mufa])->with('warning','Alerta de la mufa creada correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(EquiposMSAN $equipo, Slot $slot, SlotMSAN $olt)
    {
        $alerta = $olt->alerta;
        return view('alertas.show', compact('equipo','slot','olt','alerta'));
    }
    public function show_cable(DetalleCable $detalle, $alerta)
    {
        $alerta = Alerta::find($alerta);
        return view('alertas.show_detallecable', compact('alerta'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(EquiposMSAN $equipo, Slot $slot, SlotMSAN $olt)
    {
        $alerta = $olt->alerta;
        return view('alertas.edit', compact('equipo','slot','olt','alerta'),['gravedad'=>GravedadAlerta::all()]);
    }

    public function edit_cable(DetalleCable $detalles)
    {
        $alerta = $detalles->alerta;
        //dd($alerta);
        return view('alertas.edit_detallecable', compact('detalles','alerta'),['gravedad'=>GravedadAlerta::all()]);
    }

    public function edit_mufas(Request $request, Alerta $alerta)
    {
        $mufa = $alerta->mufa;
        return view('alertas.edit_mufa', compact('mufa','alerta'),['gravedad'=>GravedadAlerta::all()]);
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
        $alerta = $olt->alerta;
        $alerta->update(array_merge($request->only('id_gravedad','observacion'),['id_gravedad'=>$request->id_gravedad]));
        return redirect()->route('equiposmsan.slots.olt.alertas.show', [$equipo,$slot,$olt,$alerta])->with('warning','Alerta de la OLT '.$olt->id.' actualizada correctamente.');
    }
    public function update_cable(Request $request, DetalleCable $detalles)
    {
        $alerta = $detalles->alerta;
        $alerta->update(array_merge($request->only('id_gravedad','observacion'),['id_gravedad'=>$request->id_gravedad]));
        return redirect()->route('cables.show_cable', $alerta)->with('warning','Alerta del filamento '.$detalles->filamento.' actualizada correctamente.');
    }

    public function update_mufas(Request $request, Alerta $alerta)
    {
        $mufa = $alerta->mufa;
        $alerta->update(array_merge($request->only('observacion','id_gravedad'),['id_gravedad'=>$request->id_gravedad]));
        return redirect()->route('cable.mufas.index', $mufa)->with('warning','Alerta actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(EquiposMSAN $equipo, Slot $slot, SlotMSAN $olt)
    {
        $alerta = $olt->alerta;
        $alerta->delete();
        return redirect()->route('equiposmsan.slots.olt.index', [$equipo,$slot,$olt])->with('warning','Alerta de la OLT '.$olt->id.' eliminada correctamente.');
    }

    public function destroy_cable(DetalleCable $detalles)
    {
        $alerta = $detalles->alerta;
        $alerta->delete();
        return redirect()->route('cable.detallecable.index', [$detalles->cable,$detalles])->with('warning','Alerta del filamento '.$detalles->filamento.' eliminada correctamente.');
    }
    public function destroy_mufas(Mufa $mufa)
    {
        $cable = $mufa->cable;
        $alerta = $mufa->alerta;
        $alerta->delete();
        return redirect()->route('cable.mufas.index', [$cable, $mufa])->with('warning','Alerta de la mufa eliminada correctamente.');
    }
}

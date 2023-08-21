<?php

namespace App\Http\Controllers;

use App\Models\Cable;
use App\Models\Cruzada;
use App\Models\Cruzada1;
use App\Models\Cruzada2;
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
    public function index(Cable $cable, DetalleCable $detalles, Slot $slot, Request $request, Cruzada1 $cruzadas)
    {
        $texto = $request->get('texto');
        $detallesQuery = DetalleCable::query();

        if ($texto) {
            $detallesQuery->whereRaw('UPPER(direccion) LIKE ?', ['%' . strtoupper($texto) . '%'])
                ->orWhere('filamento', 'LIKE', '%' . $texto . '%')
                ->orWhere('longitud', 'LIKE', '%' . $texto . '%')
                ->orWhereRaw('UPPER(servicio) LIKE ?', ['%' . strtoupper($texto) . '%'])
                ->orWhereRaw('UPPER(cruzada) LIKE ?', ['%' . strtoupper($texto) . '%'])
                ->orWhereRaw('UPPER(observaciones) LIKE ?', ['%' . strtoupper($texto) . '%'])
                ->orWhereRaw('UPPER(ocupacion) LIKE ?', ['%' . strtoupper($texto) . '%'])
                ->orWhereHas('estado', function (Builder $query) use ($texto) {
                    $query->whereRaw('UPPER(estado) LIKE ?', ['%' . strtoupper($texto) . '%']);
                });
        }

        $detalles = $detallesQuery->orderBy('filamento', 'asc')
            ->with('cruzada1Fil1', 'cruzada1Fil2')
            ->where('id_cable', $cable->id)
            ->get();

        return view('cabledetalles.index', compact('cable', 'detalles', 'cruzadas'), ['texto' => $texto]);
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
        $cables = Cable::all();

        $existingCruzada = Cruzada1::where(function ($query) use ($detalles) {
            $query->where('id_fil1', $detalles->id);
        })->first();
        $existingCruzada2 = Cruzada1::where(function ($query) use ($detalles) {
            $query->where('id_fil2', $detalles->id);
        })->first();

        //dd($existingCruzada2);

        //$id_fil2 = $existingCruzada->id_fil2;

        if($existingCruzada && $existingCruzada2 == NULL)
        {
            $filamentos = DetalleCable::where('id_cable', $detalles->cruzada1Fil1->detalleFil2->cable->id)
            ->where('filamento', '!=', 'Sin cable')
            ->get();
            $filamentos2 = DetalleCable::where('id_cable', $cable->id)
            ->where('filamento', '!=', 'Sin cable')
            ->get();
            $estado = Estado::all();
            return view('cabledetalles.edit', compact('cable', 'detalles','filamentos' ,'filamentos2', 'cables', 'estado'));
        }
        if($existingCruzada2 && $existingCruzada == NULL)
        {
            $filamentos = DetalleCable::where('id_cable', $cable->id)
            ->where('filamento', '!=', 'Sin cable')
            ->get();
            $filamentos2 = DetalleCable::where('id_cable', $detalles->cruzada1Fil2->detalleFil1->cable->id)
            ->where('filamento', '!=', 'Sin cable')
            ->get();
            $estado = Estado::all();
            return view('cabledetalles.edit', compact('cable', 'detalles','filamentos' ,'filamentos2', 'cables', 'estado'));
        }
        if ($existingCruzada == NULL && $existingCruzada2 == NULL)
        {
            $filamentos = DetalleCable::where('id_cable', $cable->id)
            ->where('filamento', '!=', 'Sin cable')
            ->get();
            $filamentos2 = DetalleCable::where('id_cable', $cable->id)
            ->where('filamento', '!=', 'Sin cable')
            ->get();
        }
        if($existingCruzada && $existingCruzada2)
        {
            $filamentos = DetalleCable::where('id_cable', $detalles->cruzada1Fil1->detalleFil2->cable->id)
            ->where('filamento', '!=', 'Sin cable')
            ->get();
            $filamentos2 = DetalleCable::where('id_cable', $detalles->cruzada1Fil2->detalleFil1->cable->id)
            ->where('filamento', '!=', 'Sin cable')
            ->get();
            $estado = Estado::all();
            return view('cabledetalles.edit', compact('cable', 'detalles','filamentos' ,'filamentos2', 'cables', 'estado'));
        }

        // Obtén solo los filamentos correspondientes al cable seleccionado



        $estado = Estado::all();

        return view('cabledetalles.edit', compact('cable', 'detalles', 'filamentos','filamentos2', 'cables', 'estado'));
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
        $id_filamento = intval($request->id_filamento);
        $filamento = DetalleCable::find($id_filamento);
        $id_cable = intval($request->id_cable);
        $id_filamento2 = intval($request->id_filamento2);
        $filamento2 = DetalleCable::find($id_filamento2);
        $id_cable2 = intval($request->id_cable2);
        if ($id_cable != 1){
            // Verifica si ya existe una cruzada para el filamento en cuestión
            $existingCruzada = Cruzada1::where(function ($query) use ($detalle) {
                $query->where('id_fil1', $detalle->id);
            })->first();

            if ($existingCruzada) {
                // Actualiza la cruzada existente con los nuevos datos
                $existingCruzada->update(array_merge($request->only('id_fil1', 'id_fil2'),['id_fil2'=>$request->id_filamento]));
                $detalle->update(array_merge($request->only('id_estado','id_usuario','filamento','direccion','servicio','cruzada','longitud','observaciones','gmaps'),[
                    'id_estado'=>$request->id_estado,
                    'id_usuario'=>$id_usuario,
                    'cruzada'=>$existingCruzada->id
                ]));
                $filamento->update(array_merge($request->only('id_estado','id_usuario','servicio','cruzada','observaciones'),[
                    'id_estado'=>$request->id_estado,
                    'id_usuario'=>$id_usuario,
                    'cruzada'=>$existingCruzada->id
                ]));
                return redirect()->route('cable.detallecable.index', $cable->id)->with('success','Filamento '.$detalle->filamento.' actualizado correctamente.');
            } else {
                // Verifica la cantidad de cruzadas para el filamento
                $numCruzadas = Cruzada1::where('id_fil1', $detalle->id)
                                    ->orWhere('id_fil2', $detalle->id)
                                    ->count();

                if ($numCruzadas < 2) {
                    // Crea la cruzada ya que tiene menos de 2 cruzadas
                    $cruzada = Cruzada1::create(array_merge($request->only('id_fil1', 'id_fil2'), ['id_fil1' => $detalle->id, 'id_fil2' => $id_filamento]));
                    $detalle->update(array_merge($request->only('id_estado','id_usuario','filamento','direccion','servicio','cruzada','longitud','observaciones','gmaps'),[
                        'id_estado'=>$request->id_estado,
                        'id_usuario'=>$id_usuario,
                        'cruzada'=>$cruzada->id
                    ]));
                    $filamento->update(array_merge($request->only('id_estado','id_usuario','servicio','cruzada','observaciones'),[
                        'id_estado'=>$request->id_estado,
                        'id_usuario'=>$id_usuario,
                        'cruzada'=>$cruzada->id
                    ]));
                } else {
                    // Muestra un mensaje de error indicando que el filamento ya tiene 2 cruzadas
                    return redirect()->route('cable.detallecable.index', $cable->id)->with('danger','Filamento '.$detalle->filamento.' alcanzó el máximo de cruzadas.');
                }
            }
        }
        if ($id_cable2 != 1){
            // Verifica si ya existe una cruzada para el filamento en cuestión
            $existingCruzada = Cruzada2::where(function ($query) use ($detalle) {
                $query->where('id_fil1', $detalle->id);
            })->first();

            if ($existingCruzada) {
                // Actualiza la cruzada existente con los nuevos datos
                $existingCruzada->update(array_merge($request->only('id_fil1', 'id_fil2'),['id_fil2'=>$request->id_filamento]));
            } else {
                // Verifica la cantidad de cruzadas para el filamento
                $numCruzadas = Cruzada2::where('id_fil1', $detalle->id)
                                    ->orWhere('id_fil2', $detalle->id)
                                    ->count();

                if ($numCruzadas < 2) {
                    // Crea la cruzada ya que tiene menos de 2 cruzadas
                    $cruzada = Cruzada2::create(array_merge($request->only('id_fil1', 'id_fil2'), ['id_fil1' => $detalle->id, 'id_fil2' => $request->id_filamento]));
                    $detalle->update(array_merge($request->only('id_estado','id_usuario','filamento','direccion','servicio','cruzada','longitud','observaciones','gmaps'),[
                        'id_estado'=>$request->id_estado,
                        'id_usuario'=>$id_usuario,
                        'cruzada'=>$cruzada->id
                    ]));
                    $filamento->update(array_merge($request->only('id_estado','id_usuario','servicio','cruzada','observaciones'),[
                        'id_estado'=>$request->id_estado,
                        'id_usuario'=>$id_usuario,
                        'cruzada'=>$cruzada->id
                    ]));
                } else {
                    // Muestra un mensaje de error indicando que el filamento ya tiene 2 cruzadas
                    return redirect()->route('cable.detallecable.index', $cable->id)->with('danger','Filamento '.$detalle->filamento.' alcanzó el máximo de cruzadas.');
                }
            }
        }
        $detalle->update(array_merge($request->only('id_estado','id_usuario','filamento','direccion','servicio','cruzada','longitud','observaciones','gmaps'),[
            'id_estado'=>$request->id_estado,
            'id_usuario'=>$id_usuario,
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
    // ...

    public function getFilamentosByCable(Request $request)
    {
        $cableId = $request->input('cable_id');

        $filamentos = DetalleCable::where('id_cable', $cableId)
            ->where('filamento', '!=', 'Sin cable')
            ->get();

        // Modificar los filamentos para incluir el formato "id - servicio"
        $formattedFilamentos = $filamentos->map(function ($filamento) {
            return [
                'id' => $filamento->id,
                'text' => $filamento->filamento . ' - ' . $filamento->servicio
            ];
        });

        return response()->json($formattedFilamentos);
    }
    public function consultaCable($cableId)
    {
        $hasFilamentos = $cableId != 1; // Si el ID no es 1, entonces el cable tiene filamentos

        return response()->json([
            'hasFilamentos' => $hasFilamentos,
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Comprobar;
use App\Models\EquiposMSAN;
use App\Models\MantencionMsan;
use Illuminate\Http\Request;

class MantencionesMSANController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(EquiposMSAN $equipo)
    {
        $mantenciones = MantencionMsan::all();
        return view('mantencionesmsan.index', compact('equipo','mantenciones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(EquiposMSAN $equipo, MantencionMsan $mantencion)
    {
        return view('mantencionesmsan.create', compact('equipo'),['comprobacion'=>Comprobar::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, EquiposMSAN $equipo)
    {
        $id_usuario = auth()->user()->id;
        $mantencion = MantencionMsan::create(array_merge($request->only('id_msan',
        'id_usuario','comprobacion_1','comprobacion_2','comprobacion_3','comprobacion_4','comprobacion_5','comprobacion_6','comprobacion_7','comprobacion_8','comprobacion_9','comprobacion_10','comprobacion_11','fecha_mantencion','observaciones','numero_ticket',
        'coordenadas',),['id_usuario'=>$id_usuario,'id_msan'=>$equipo->id]));
        return redirect()->route('equiposmsan.mantencionesmsan.index', $equipo)->with('success','Mantención creada correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(EquiposMSAN $equipo, $id)
    {
        $mantencion = MantencionMsan::find($id);
        $comprobacion = ['1. Comprobar tarjetas energia insertadas en las ranuras correspondientes y comprobar si hay alarmas:',
        '2. Compruebe si los cables de conexión a tierra del gabinete, pdp y bastidores estan firmemente apretados:',
        '3. Compruebe si hay corrosión en las terminaciones de los cables y que los alambres de cobre no estén expuestos:',
        '4. Compruebe que la temperatura de la sala de equipos está en el rango de 10°-30°C. Humedad relativa recomendada entre 20% a 85%:',
        '5. Compruebe filtros de aire, filtro ubicado en parte inferior de OLT. Limpiar y extraer polvo:',
        '6. Verificar que no hay objetos que bloquean la entrada y salida de aure del equipo. La entrada de aire de la OLT es de abajo hacia arriba:',
        '7. Comprobar que SLOTS vacios se instalan con paneles ficticios. Verificar que SLOT no utilizados esten con tapas para evitar ingreso de polvo:',
        '8. Compruebe si los tornillos o los botones de la unidad de ventilación están bien cerradas:',
        '9. En el panel de la unidad de ventilación. El LED verde ACT debe estar encendido y el LED ALM apagado:',
        '10. El extractor de fibra óptica debe ser instalado vertucal en la parte lateral del borde del gabinete y colgado alrededor de 1.5MTS. del suelo. Utilizar para la correcta manipulación de fibra óptica:',
        '11. Suficiente espacio de instalación debe ser reservado en la parte superior inferior de los bastidores del equipo. (Recomendado 3U). Instalación cerca del equipo en la parte superior e inferior está prohibido:'];

        $comp = [$mantencion->comprobacion_1,
        $mantencion->comprobacion_2,
        $mantencion->comprobacion_3,
        $mantencion->comprobacion_4,
        $mantencion->comprobacion_5,
        $mantencion->comprobacion_6,
        $mantencion->comprobacion_7,
        $mantencion->comprobacion_8,
        $mantencion->comprobacion_9,
        $mantencion->comprobacion_10,
        $mantencion->comprobacion_11];

        return view ('mantencionesmsan.show', compact('equipo','comprobacion','mantencion','comp'));
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
    public function destroy($id)
    {
        //
    }
}

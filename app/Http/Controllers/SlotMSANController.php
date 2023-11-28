<?php

namespace App\Http\Controllers;

use App\Models\Cable;
use App\Models\CableSlot;
use App\Models\DetalleCable;
use App\Models\EquiposMSAN;
use App\Models\Estado;
use App\Models\Etiquetas;
use App\Models\Slot;
use App\Models\SlotMSAN;
use App\Models\Tecnologia;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Response;

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
                $etiqueta = Etiquetas::where('id_olt', $olt->id)->get();

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

                return view('olt.index', compact('equipo','slot','olts','etiqueta'), ['olts' => $olts, 'texto' => $texto, 'etiqueta'=> $etiqueta]);
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
                $olt = SlotMSAN::create(array_merge($request->only('id_slot','id_cable','id_estado','olt','id_usuario','etiquetado'),[
                    'olt'=>$i,
                    'id_slot'=>$slot->id,
                    'id_cable'=>$request->id_cable,
                    'id_estado'=>$request->id_estado,
                    'id_usuario'=>$id_usuario,
                    'etiquetado'=>0
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
            $olt = SlotMSAN::create(array_merge($request->only('id_slot','id_cable','id_estado','olt','etiquetado'),[
                'olt'=>$i,
                'id_slot'=>$slot->id,
                'id_cable'=>$request->id_cable,
                'id_estado'=>$request->id_estado,
                'etiquetado'=>0
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

    public function crear_etiqueta(EquiposMSAN $equipo, Slot $slot, SlotMSAN $olt, Request $request)
    {
        $mapeo = [
            1 => 'CE',
            2 => 'FOT',
            3 => 'Anillo',
            4 => 'CP',
            5 => 'CEMP',
        ];
        $id_cable = $olt->cable->tipocable->id;
        $verificar = Etiquetas::where('id_cable', $olt->id_cable)->where('filam', $olt->filam)->exists();
        $tipocable = isset($mapeo[$id_cable]) ? $mapeo[$id_cable] : '';

        $ultimo_caracter = substr($slot->slot_msan, strlen($slot->slot_msan) - 2);
        $ultimo_caracter = str_replace('-', '', $ultimo_caracter);

        //dd($olt->cable->sitio->abreviacion);

        if ($verificar == false)
        {
            $ladoMSANLEFT = $tipocable.' '.$olt->cable->nombre_cable.' FIL '.$olt->filam."\nFCA ".$olt->sitio_fca.' SPL-'.$olt->spl;
            $ladoMSANRIGHT = 'MSAN '.$equipo->numero.'-'.$olt->cable->sitio->abreviacion.' 1-'.$ultimo_caracter.'-'.$olt->olt;

            $ladoCabeceraLEFT = 'MSAN '.$equipo->numero.'-'.$olt->cable->sitio->abreviacion.' 1-'.$ultimo_caracter.'-'.$olt->olt."\nFCA ".$olt->sitio_fca.' SPL-'.$olt->spl;
            $ladoCabeceraRIGHT = $tipocable.' '.$olt->cable->nombre_cable.' FIL '.$olt->filam;

            $etiqueta = $ladoMSANLEFT.' '.$ladoMSANRIGHT;

            //dd($ladoMSANRIGHT);

            $etiquetas = Etiquetas::create(array_merge($request->only('ladoMSANLEFT','ladoMSANRIGHT','ladocabeceraLEFT','ladocabeceraRIGHT','id_cable','filam','spl','sitio_fca','id_olt'),[
                'ladoMSANLEFT'=>$ladoMSANLEFT,
                'ladoMSANRIGHT'=>$ladoMSANRIGHT,
                'ladocabeceraLEFT'=>$ladoCabeceraLEFT,
                'ladocabeceraRIGHT'=>$ladoCabeceraRIGHT,
                'id_cable'=>$olt->id_cable,
                'filam'=>$olt->filam,
                'spl'=>$olt->spl,
                'sitio_fca'=>$olt->sitio_fca,
                'id_olt'=>$olt->id
            ]));
            $olt->update(array_merge($request->only('etiquetado'),['etiquetado'=>1]));
            return redirect()->route('equiposmsan.slots.olt.index', [$equipo,$slot])->with('success','Etiqueta creada correctamente.');
        }
    }

    public function actualizar_etiqueta(EquiposMSAN $equipo, Slot $slot, SlotMSAN $olt, Request $request, Etiquetas $etiquetas)
    {
        //dd($etiquetas);
        $mapeo = [
            1 => 'CE',
            2 => 'FOT',
            3 => 'Anillo',
            4 => 'CP',
            5 => 'CEMP',
        ];
        $id_cable = $olt->cable->tipocable->id;
        $tipocable = isset($mapeo[$id_cable]) ? $mapeo[$id_cable] : '';

        $ultimo_caracter = substr($slot->slot_msan, strlen($slot->slot_msan) - 2);
        $ultimo_caracter = str_replace('-', '', $ultimo_caracter);


        $ladoMSANLEFT = $tipocable.' '.$olt->cable->nombre_cable.' FIL '.$olt->filam."\nFCA ".$olt->sitio_fca.' SPL-'.$olt->spl;
        $ladoMSANRIGHT = 'MSAN '.$equipo->numero.'-'.$olt->cable->sitio->abreviacion.' 1-'.$ultimo_caracter.'-'.$olt->olt;

        $ladoCabeceraLEFT = 'MSAN '.$equipo->numero.'-'.$olt->cable->sitio->abreviacion.' 1-'.$ultimo_caracter.'-'.$olt->olt."\nFCA ".$olt->sitio_fca.' SPL-'.$olt->spl;
        $ladoCabeceraRIGHT = $tipocable.' '.$olt->cable->nombre_cable.' FIL '.$olt->filam;

            $etiqueta = $ladoMSANLEFT.' '.$ladoMSANRIGHT;

            $etiquetas->update(array_merge($request->only('ladoMSANLEFT','ladoMSANRIGHT','ladocabeceraLEFT','ladocabeceraRIGHT','id_cable','filam','spl','sitio_fca','id_olt'),[
                'ladoMSANLEFT'=>$ladoMSANLEFT,
                'ladoMSANRIGHT'=>$ladoMSANRIGHT,
                'ladocabeceraLEFT'=>$ladoCabeceraLEFT,
                'ladocabeceraRIGHT'=>$ladoCabeceraRIGHT,
                'id_cable'=>$olt->id_cable,
                'filam'=>$olt->filam,
                'spl'=>$olt->spl,
                'sitio_fca'=>$olt->sitio_fca,
                'id_olt'=>$olt->id
            ]));

            //dd($etiquetas);
            return redirect()->route('equiposmsan.slots.olt.index', [$equipo,$slot])->with('success','Etiqueta actualizada correctamente.');

    }


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

        $existe_detalle = DB::table('detallecable')->where('id_cable',$request->id_cable)->exists();

        $cablee = Cable::find($request->id_cable);
        //dd($cablee->cant_filam);
        if ($existe_detalle == true || $filamento == NULL)
        {
            if($request->filam <= $cablee->cant_filam)
            {
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
                        $detalle->update(array_merge($request->only('ocupacion','id_estado','id_olt'),['ocupacion'=>$slotolt,'id_estado'=>'2','id_olt'=>$olt->id]));
                    }
                    if($existe==true)
                    {
                        return redirect()->route('equiposmsan.slots.olt.index', [$equipo,$slot,$olt])->with('failure','Filamento: '.$filamento.', ya ocupado.');
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
                    $detalle->update(array_merge($request->only('ocupacion','id_estado','id_olt'),['ocupacion'=>'','id_estado'=>'1','id_olt'=>$olt->id]));
                }
                if($filamento != NULL && $sin_filam != NULL && $filamento != $sin_filam)
                {
                    $existe = DB::table('slot_msan')->where('id_cable',$request->id_cable)
                    ->where('filam',$filamento)
                    ->exists();
                    if ($existe==false)
                    {
                        $detalle = $olt->cable->detallecable[$sin_filam-1];
                        $detalle->update(array_merge($request->only('ocupacion','id_estado','id_olt'),['ocupacion'=>'','id_estado'=>'1','id_olt'=>$olt->id]));
                        $olt->update(array_merge($request->only('id_cable','id_usuario','id_estado','sitio_fca','link_sitio_fca','descripcion_fca','olt','spl','filam'),[
                            'id_cable'=>$request->id_cable,
                            'id_estado'=>'2',
                            'id_usuario'=>$idusuario
                        ]));
                        $detalle = $olt->cable->detallecable[$filamento-1];
                        $slotolt = $slot->slot_msan.'-'.$olts;
                        $detalle->update(array_merge($request->only('ocupacion','id_estado','id_olt'),['ocupacion'=>$slotolt,'id_estado'=>'2','id_olt'=>$olt->id]));
                    }
                    if($existe==true)
                    {
                        return redirect()->route('equiposmsan.slots.olt.index', [$equipo,$slot,$olt])->with('failure','Filamento ya ocupado.');
                    }
                }
                if ($filamento == $sin_filam && $filamento != NULL && $sin_filam != NULL)
                {
                    $olt->update(array_merge($request->only('id_cable','id_usuario','id_estado','sitio_fca','link_sitio_fca','descripcion_fca','olt','spl','filam'),[
                        'id_cable'=>$request->id_cable,
                        'id_estado'=>'2',
                        'id_usuario'=>$idusuario
                    ]));
                }
                if ($filamento == $sin_filam && $filamento == NULL && $sin_filam == NULL)
                {
                    $olt->update(array_merge($request->only('id_cable','id_usuario','id_estado','sitio_fca','link_sitio_fca','descripcion_fca','olt','spl','filam'),[
                        'id_cable'=>$request->id_cable,
                        'id_estado'=>'1',
                        'id_usuario'=>$idusuario
                    ]));
                }

                return redirect()->route('equiposmsan.slots.olt.index', [$equipo,$slot,$olt])->with('success','OLT actualizada correctamente.');
            }
            else
            {
                return redirect()->route('equiposmsan.slots.olt.index', [$equipo,$slot,$olt])->with('failure','Excede máximo de filamentos.');
            }
        }
        if($existe_detalle == false)
        {
            return redirect()->route('equiposmsan.slots.olt.index', [$equipo,$slot,$olt])->with('failure','Cable no tiene filamentos creados.');
        }
    }
    public function imprimir(Etiquetas $etiqueta, Request $request)
    {
        $textoModificado = preg_replace('/\bFCA\b/', "\nFCA", $etiqueta->ladoMSANLEFT);

        //dd($etiqueta->ladoMSANLEFT,$textoModificado);

        $html = '<html><body>';
        $html .= '<pre>';
        $html .= $etiqueta->ladoMSANLEFT . '                         ' . $etiqueta->ladoMSANRIGHT . "\n\n";
        $html .= '...............................................................'."\n\n";
        $html .= $etiqueta->ladocabeceraLEFT . '                         ' . $etiqueta->ladocabeceraRIGHT. "\n\n";
        $html .= '...............................................................';
        $html .= '</pre>';
        $html .= '</body></html>';

        // Crea una respuesta de tipo PDF
        $pdf = \PDF::loadHTML($html);
        $pdf->setPaper('a4', 'portrait');

        // Descarga el PDF o abre una nueva ventana para imprimirlo
        return $pdf->stream('documento.pdf');

        //return view('etiquetas.show', compact('etiqueta','ladoMSANLEFT', 'ladoMSANRIGHT', 'ladoCabeceraLEFT', 'ladoCabeceraRIGHT'));
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
        $etiqueta = $olt->etiqueta;
        //dd($etiqueta);
        $existe_detalle = DB::table('detallecable')->where('id_cable',$olt->id_cable)->exists();
        if($existe_detalle == true)
        {
            $detalle = $olt->cable->detallecable[$filamento-1];
            $detalle->update(array_merge($request->only('ocupacion','id_estado'),['ocupacion'=>'','id_estado'=>'1']));
        }
        $null = NULL;
        $olt->update(array_merge($request->only('id_cable','id_estado','sitio_fca','link_sitio_fca','descripcion_fca','olt','spl','filam','etiquetado'),[
            'id_cable'=>'1',
            'id_estado'=>'1',
            'sitio_fca'=>$null,
            'descripcion_fca'=>$null,
            'spl'=>$null,
            'filam'=>$null,
            'etiquetado'=>0
        ]));
        if($olt->etiqueta){
            $etiqueta->delete();
        }
        //$olt->delete();
        return redirect()->route('equiposmsan.slots.olt.index', [$equipo,$slot]);
    }
}

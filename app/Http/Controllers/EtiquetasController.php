<?php

namespace App\Http\Controllers;

use App\Models\Cable;
use App\Models\DetalleCable;
use App\Models\Etiquetas;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EtiquetasExport;
use App\Models\SlotMSAN;
use League\Csv\Writer;


class EtiquetasController extends Controller
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
            $etiquetas = Etiquetas::WhereRaw('UPPER(ladoMSANLEFT) LIKE ?', ['%' . strtoupper($texto) . '%'])
            ->orWhereRaw('UPPER(ladoMSANRIGHT) LIKE ?', ['%' . strtoupper($texto) . '%'])
            ->orWhereHas('cable', function (Builder $query) use ($texto){
                $query->whereRaw('UPPER(nombre_cable) LIKE ?', ['%' . strtoupper($texto) . '%'])
                ->orWhereHas('sitio', function (Builder $query) use ($texto){
                    $query->whereRaw('UPPER(abreviacion) LIKE ?', ['%' . strtoupper($texto) . '%']);
                });
            })
            ->orderBy('id','asc')
            ->paginate(25);

            return view('etiquetas.index', ['etiquetas' => $etiquetas, 'texto' => $texto]);
        }
        $etiquetas = Etiquetas::all();
        return view('etiquetas.index', compact('etiquetas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cables = Cable::all();
        return view('etiquetas.create', compact('cables'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cable = Cable::find($request->id_cable);
        $verificar = Etiquetas::where('id_cable', $request->id_cable)->where('filam', $request->filam)->exists();

        if ($cable->cant_filam < $request->filam) {
            return redirect()->route('etiquetas.create')->with('danger','Numero de filamento invalido.');
        }

        if ($verificar == true) {
            return redirect()->route('etiquetas.create')->with('danger','Filamento ya etiquetado anteriormente.');
        }

        $etiquetas = Etiquetas::create(array_merge($request->only('etiqueta','id_cable','filam','spl','sitio_fca'),['id_cable'=>$request->id_cable]));

        return redirect()->route('etiquetas.index')->with('success','Etiqueta creada correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Etiquetas $etiqueta)
    {
        $cables = $etiqueta->cable;
        return view('etiquetas.show', compact('etiqueta','cables'));
    }

    public function export()
    {
        $etiquetas = Etiquetas::all();
        $csv = Writer::createFromString('');
        $csv->insertOne(['ID', 'ladoMSANLEFT','ladoMSANRIGHT','ladocabeceraLEFT','ladocabeceraRIGHT', 'Nombre del cable', 'Filamento']);

        foreach ($etiquetas as $etiqueta) {
            $csv->insertOne([
                $etiqueta->id,
                $etiqueta->ladoMSANLEFT,
                $etiqueta->ladoMSANRIGHT,
                $etiqueta->ladocabeceraLEFT,
                $etiqueta->ladocabeceraRIGHT,
                $etiqueta->cable->nombre_cable,
                $etiqueta->filam
            ]);
        }

        $csv->output('etiquetas.csv');
    }

    public function show_filamento(Etiquetas $etiqueta)
    {
        $id_cable = $etiqueta->cable->id;
        $detalle = DetalleCable::where('id_cable', $id_cable)->where('filamento',$etiqueta->filam)->get();
        return view('etiquetas.show_filamento', compact('etiqueta','detalle'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Etiquetas $etiqueta)
    {
        $cables = Cable::all();
        return view('etiquetas.edit', compact('etiqueta','cables'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Etiquetas $etiqueta)
    {
        $etiqueta->update(array_merge($request->only('etiqueta','id_cable','filam'),['id_cable'=>$request->id_cable]));
        return redirect()->route('etiquetas.index')->with('success','etiqueta actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Etiquetas $etiqueta, Request $request)
    {
        $olt = $etiqueta->olt;
        $olt->update(array_merge($request->only('etiquetado'),['etiquetado'=>0]));
        $etiqueta->delete();
        return redirect()->route('etiquetas.index')->with('warning','Etiqueta se ha eliminado correctamente.');
    }
    public function destroy_all(Request $request)
    {
        // Obtener todas las etiquetas
        $etiquetas = Etiquetas::all();

        // Obtener los OLTs asociados a las etiquetas
        $olts = $etiquetas->pluck('olt')->unique();

        // Actualizar todos los OLTs a 0
        $olts->each(function ($olt) {
            $olt->update(['etiquetado' => 0]);
        });

        // Eliminar todas las etiquetas
        Etiquetas::truncate();

        return redirect()->route('etiquetas.index')->with('warning', 'Etiquetas y OLTs asociados se han eliminado correctamente.');
    }
    public function create_all()
    {
        $olts = SlotMSAN::all();
        //dd($olts[0]->msan->equiposmsan);
        for ($i=0; $i<count($olts);$i++)
        {
            $mapeo = [
                1 => 'CE',
                2 => 'FOT',
                3 => 'Anillo',
                4 => 'CP',
                5 => 'CEMP',
            ];
            $id_cable = $olts[$i]->id_cable;
            $slot = $olts[$i]->msan;
            $equipo = $olts[$i]->msan->equiposmsan;
            $verificar = Etiquetas::where('id_cable', $olts[$i]->id_cable)->where('filam', $olts[$i]->filam)->exists();
            $tipocable = isset($mapeo[$id_cable]) ? $mapeo[$id_cable] : '';

            $ultimo_caracter = substr($slot->slot_msan, strlen($slot->slot_msan) - 2);
            $ultimo_caracter = str_replace('-', '', $ultimo_caracter);

            //dd($olts[$i]->cable->sitio->abreviacion);

            if ($verificar == false)
            {
                $ladoMSANLEFT = $tipocable.' '.$olts[$i]->cable->nombre_cable.' FIL '.$olts[$i]->filam."\nFCA ".$olts[$i]->sitio_fca.' SPL-'.$olts[$i]->spl;
                $ladoMSANRIGHT = 'MSAN '.$equipo->numero.'-'.$olts[$i]->cable->sitio->abreviacion.' 1-'.$ultimo_caracter.'-'.$olts[$i]->olt;

                $ladoCabeceraLEFT = 'MSAN '.$equipo->numero.'-'.$olts[$i]->cable->sitio->abreviacion.' 1-'.$ultimo_caracter.'-'.$olts[$i]->olt."\nFCA ".$olts[$i]->sitio_fca.' SPL-'.$olts[$i]->spl;
                $ladoCabeceraRIGHT = $tipocable.' '.$olts[$i]->cable->nombre_cable.' FIL '.$olts[$i]->filam;

                $etiqueta = $ladoMSANLEFT.' '.$ladoMSANRIGHT;

                //dd($ladoMSANRIGHT);

                $etiquetas = Etiquetas::create([
                    'ladoMSANLEFT'=>$ladoMSANLEFT,
                    'ladoMSANRIGHT'=>$ladoMSANRIGHT,
                    'ladocabeceraLEFT'=>$ladoCabeceraLEFT,
                    'ladocabeceraRIGHT'=>$ladoCabeceraRIGHT,
                    'id_cable'=>$olts[$i]->id_cable,
                    'filam'=>$olts[$i]->filam,
                    'spl'=>$olts[$i]->spl,
                    'sitio_fca'=>$olts[$i]->sitio_fca,
                    'id_olt'=>$olts[$i]->id
                ]);
                $olts[$i]->update(['etiquetado'=>1]);
            }
        }
        return redirect()->route('etiquetas.index')->with('success','Etiquetas creadas correctamente.');
    }

    public function ejecutarScript()
    {
        $scriptPath = base_path('python_scripts/etiqueta_scan.py');

        // Ejecutar el script de Python y capturar la salida
        $output = shell_exec("python $scriptPath");

        return view('etiquetas.ejecutar_script', ['output' => $output]);
    }
}

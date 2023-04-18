<?php

namespace App\Http\Controllers;

use App\Models\Cable;
use App\Models\DetalleCable;
use App\Models\Etiquetas;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

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
            $etiquetas = Etiquetas::WhereRaw('UPPER(etiqueta) LIKE ?', ['%' . strtoupper($texto) . '%'])
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
        $verificar = Etiquetas::where('filam',$request->filam)->exists();
        if ($cable->cant_filam < $request->filam)
        {
            return redirect()->route('etiquetas.create')->with('danger','Numero de filamento invalido.');
        }
        if ($verificar == true)
        {
            return redirect()->route('etiquetas.create')->with('danger','Filamento ya etiquetado anteriormente.');
        }
        $etiquetas = Etiquetas::create(array_merge($request->only('etiqueta','id_cable','filam'),['id_cable'=>$request->id_cable]));
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
    public function destroy(Etiquetas $etiqueta)
    {
        $etiqueta->delete();
        return redirect()->route('etiquetas.index')->with('warning','Etiqueta se ha eliminado correctamente.');
    }
}
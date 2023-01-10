<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Models\Sitio;
use App\Models\Cable;
use App\Models\EquiposMSAN;

class SitiosController extends Controller
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
            $sitios = Sitio::whereRaw('UPPER(nombre) LIKE ?', ['%' . strtoupper($texto) . '%'])
            ->orWhereRaw('UPPER(abreviacion) LIKE ?', ['%' . strtoupper($texto) . '%'])
            ->orWhereRaw('UPPER(direccion) LIKE ?', ['%' . strtoupper($texto) . '%'])
            ->orderBy('id','asc')
            ->paginate(20);

            return view('sitios.index', ['sitios' => $sitios, 'texto' => $texto]);
        }
        $sitios = Sitio::all();
        return view('sitios.index', compact('sitios'));
    }
    public function index_equipo(Sitio $sitio, EquiposMSAN $equipo)
    {
        $equipo = EquiposMSAN::all();
        return view('sitios.index_equipo', compact('sitio','equipo'));
    }
    public function index_cable(Sitio $sitio, Cable $cables, Request $request)
    {
        if ($request) {
            $texto = trim($request->get('texto'));
            $cables = Cable::WhereRaw('UPPER(nombre_cable) LIKE ?', ['%' . strtoupper($texto) . '%'])
            ->orWhere('cant_filam','LIKE','%'.$texto.'%')
            ->orWhereHas('sitio', function (Builder $query) use ($texto){
                $query->whereRaw('UPPER(nombre) LIKE ?', ['%' . strtoupper($texto) . '%']);
            })
            ->orWhereHas('tipocable', function (Builder $query) use ($texto){
                $query->whereRaw('UPPER(tipo) LIKE ?', ['%' . strtoupper($texto) . '%']);
            })
            ->orderBy('id','asc')
            ->paginate(10);

            $cables = Cable::all();
            return view('sitios.index_cable' ,compact('sitio'), ['cables' => $cables, 'texto' => $texto]);
        }
        $cables = Cable::all();
        return view('sitios.index_cable', compact('sitio','cables'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('sitios.create',['sitios'=>Sitio::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sitios = Sitio::create($request->only('nombre', 'abreviacion','direccion','descripcion','url'));
        return redirect()->route('sitios.index')->with('success', 'Sitio creado correctamente.');
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
    public function edit(Sitio $sitio, Request $request)
    {
        return view ('sitios.edit', compact('sitio'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sitio $sitio)
    {
        $sitio->update($request->only('nombre','abreviacion','direccion','descripcion','url'));
        return redirect()->route('sitios.index', $sitio->id)->with('success', 'Sitio actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sitio $sitio, Request $request)
    {
        $sitio = $request->sitio;
        $sitio->delete();
        return redirect()->route('sitios.index');
    }
}

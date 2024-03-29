@extends('layouts.app', ['activePage' => 'equiposmsan', 'titlePage' => 'Lista de Cables de Fribra'])
@section('content')
    <div class="content">
        <div class="container-fuid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header card-header-primary">
                                    <h4 class="card-tittle">Cable {{$cables->nombre_cable}} de Fibra Óptica</h4>
                                    <div class="row">
                                        <div class="col-7 text-right d-felx">
                                            <form action="{{route('equiposmsan.slots.olt.cables.index', [$equipo,$slot,$olt,$cables])}}" method="get">
                                                <div class="form-row">
                                                    <div class="col-sm-4 align-self-center" style="text-align: right">
                                                        <input type="text" class="form-control float-right" name="texto" value="{{$texto ?? ''}}" placeholder="Buscar...">
                                                    </div>
                                                    <div class="col-auto align-self-center">
                                                        <input type="submit" class="btn btn-primary float-right" value="Buscar">
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <p class="card-category">Datos de Cables de Fibra Óptica</p>
                                </div>
                                <div class="card-body">
                                    @if (session('success'))
                                        <div class="alert alert-success" role="success">
                                            {{ session('success') }}
                                        </div>
                                    @endif
                                    <div class="row">
                                        <div class="col-12 text-right">
                                            <a href="{{ route('equiposmsan.slots.olt.index', [$equipo,$slot])}}" class="btn btn-primary"><i class="material-icons">arrow_back</i></a>
                                        </div>
                                    </div>
                                    <div class="table-responsive text-center">
                                        <table class="table">
                                            <thead class="text-primary">
                                                <th>N° Cable</th>
                                                <th>Sitio</th>
                                                <th>Cantidad Filamentos</th>
                                                <th>Tipo de Cable</th>
                                                <th>Descripción</th>
                                                <th>Detalles</th>
                                                <th class="text-right">Acciones</th>
                                            </thead>
                                            <tbody>
                                                <tr class="text-center">
                                                    <td>{{ $cables->nombre_cable }}</td>
                                                    <td>{{ $cables->sitio->nombre}}</td>
                                                    <td>{{ $cables->cant_filam}}</td>
                                                    <td>{{ $cables->tipocable->tipo}}</td>
                                                    <td>{{ $cables->descripcion}}</td>
                                                    <td><a href="{{ route('cable.detallecable.index', $cables->id)}}">Ver Cable</a></td>
                                                    <td class="td-actions text-right">
                                                        @if ( $cables->sitio->url == NULL)
                                                            @elseif ( $cables->sitio->url != NULL)
                                                                <a href="{{ $cables->sitio->url }}" target="_blank" class="btn btn-success"><i class="material-icons">location_on</i></a>
                                                            @endif
                                                        <a href="{{ route('cable.edit', $cables->id) }}" class="btn btn-primary"><i class="material-icons">edit</i></a>
                                                        <form action="{{route('cable.destroy', $cables->id)}}" method="post" style="display: inline-block" onsubmit="return confirm('¿Estás seguro?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger" type="submit" rel="tooltip">
                                                            <i class="material-icons">close</i>
                                                        </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

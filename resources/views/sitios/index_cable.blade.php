@extends('layouts.app', ['activePage' => 'cable', 'titlePage' => 'Lista de Cables de Fibra'])
@section('content')
    <div class="content">
        <div class="container-fuid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header card-header-primary">
                                    <h4 class="card-tittle">Lista de Cables de Fibra Óptica de {{ $sitio->nombre}}</h4>
                                    <div class="row">
                                        <div class="col-7 text-right d-felx">
                                            <form action="{{route('sitios.index_cable', $sitio)}}" method="get">
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
                                            <a href="{{ url()->previous() }}" class="btn btn-primary"><i class="material-icons">arrow_back</i></a>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="text-primary">
                                                <th>N° Cable</th>
                                                <th>Sitio</th>
                                                <th>Cant. Filam</th>
                                                <th>Tipo de Cable</th>
                                                <th>Descripción</th>
                                                <th>Detalles</th>
                                                <th class="text-right">Acciones</th>
                                            </thead>
                                            <tbody>
                                            @if (count($cables)<=0)
                                                <div class="alert alert-danger" style="text-align:center" role="alert">
                                                    <h4>No se han encontrado cables</h4>
                                                </div>
                                            @endif
                                            @foreach ($cables as $cable)
                                            @if ($sitio->id == $cable->sitio->id)
                                                @if ($cable->id > "1")
                                                    <tr>
                                                        <td>{{ $cable->nombre_cable }}</td>
                                                        <td>{{ $cable->sitio->abreviacion}}</td>
                                                        <td>{{ $cable->cant_filam}}</td>
                                                        <td>{{ $cable->tipocable->tipo}}</td>
                                                        <td>{{ $cable->descripcion}}</td>
                                                        <td><a href="{{ route('cable.detallecable.index', $cable->id)}}">Ver Cable</a></td>
                                                        <td class="td-actions text-right">
                                                            @if ( $cable->sitio->url == NULL)
                                                                @elseif ( $cable->sitio->url != NULL)
                                                                    <a href="{{ $cable->sitio->url }}" target="_blank" class="btn btn-success"><i class="material-icons">location_on</i></a>
                                                                @endif
                                                            <a href="{{ route('cable.edit', $cable->id) }}" class="btn btn-warning"><i class="material-icons">edit</i></a>
                                                            <form action="{{route('cable.destroy', $cable->id)}}" method="post" style="display: inline-block" onsubmit="return confirm('¿Estás seguro?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-danger" type="submit" rel="tooltip">
                                                                <i class="material-icons">close</i>
                                                            </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endif
                                            @endforeach
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

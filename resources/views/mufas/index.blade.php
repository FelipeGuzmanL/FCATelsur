@extends('layouts.app', ['activePage' => 'cablestroncales', 'titlePage' => 'Mufas del Cable'])
@section('content')
    <div class="content">
        <div class="container-fuid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header card-header-primary">
                                    <h4 class="card-tittle">Mufas del cable {{$cable->sitio->abreviacion }} {{ $cable->nombre_cable}}</h4>
                                    <div class="row">
                                        <div class="col-7 text-right d-felx">
                                            <form action="{{route('cable.detallecable.index', $cable->id)}}" method="get">
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
                                    <p class="card-category">Mufas de Cables de Fibra Óptica</p>
                                </div>
                                <div class="card-body">
                                    @if (session('success'))
                                        <div class="alert alert-success text-center" role="success">
                                            {{ session('success') }}
                                        </div>
                                    @endif
                                    @if (session('warning'))
                                        <div class="alert alert-warning text-center" role="warning">
                                            {{ session('warning') }}
                                        </div>
                                    @endif
                                    <div class="row">
                                        <div class="col-12 text-right">
                                            <a href="{{ route('cable.mufas.create', [$cable])}}" class="btn btn-primary">Añadir Mufa</a>
                                            <a href="{{ route('cablestroncales.index') }}" class="btn btn-primary"><i class="material-icons">arrow_back</i></a>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="text-primary">
                                                <th>Item</th>
                                                <th>Distancia K</th>
                                                <th>Ruta 5 K</th>
                                                <th>Ubicación</th>
                                                <th>Latitud</th>
                                                <th>Longitud</th>
                                                <th>Observaciones</th>
                                                <th>Fecha de creación</th>
                                                <th class="text-right">Acciones</th>
                                            </thead>
                                            <tbody>
                                                @foreach ($mufas as $mufa)
                                                <tr>
                                                    <td>{{ $mufa->item}}</td>
                                                    <td>{{ $mufa->distancia_k}}</td>
                                                    <td>{{ $mufa->ruta5_k}}</td>
                                                    <td>{{ $mufa->ubicacion}}</td>
                                                    <td>{{ $mufa->latitud}}</td>
                                                    <td>{{ $mufa->longitud}}</td>
                                                    <td>{{ $mufa->observaciones}}</td>
                                                    <td>{{ $mufa->fecha}}</td>
                                                    <td class="td-actions text-right">
                                                        @if ( $mufa->cable->sitio->url == NULL)
                                                            @elseif ( $mufa->cable->sitio->url != NULL)
                                                                <a href="{{ $mufa->cable->sitio->url }}" target="_blank" class="btn btn-success"><i class="material-icons">location_on</i></a>
                                                            @endif
                                                        <a href="#" class="btn btn-primary"><i class="material-icons">edit</i></a>
                                                        <form action="{{ route('cable.mufas.destroy', [$cable,$mufa])}}" method="post" style="display: inline-block" onsubmit="return confirm('¿Estás seguro?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger" type="submit" rel="tooltip">
                                                            <i class="material-icons">close</i>
                                                        </button>
                                                        </form>
                                                    </td>
                                                </tr>
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

@extends('layouts.app', ['activePage' => 'mufas', 'titlePage' => 'Mufas del Cable'])
@section('content')
    <div class="content">
        <div class="container-fuid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header card-header-primary">
                                    <h4 class="card-tittle">Mufas</h4>
                                    <div class="row">
                                        <div class="col-7 text-right d-felx">
                                            <form action="{{route('mufas.index')}}" method="get">
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
                                    <div class="row justify-content-between">
                                        <div class="col-md-3 text-center">
                                            <form action="{{ route('mufas.index', $cable) }}" method="GET">
                                                <div class="form-group">
                                                    <label for="ordenamiento">Ordenar Distancia OTDR:</label>
                                                    <select class="form-control" id="ordenamiento" name="ordenamiento">
                                                        <option value="asc">Ascendente</option>
                                                        <option value="desc">Descendente</option>
                                                    </select>
                                                    <button type="submit" class="btn btn-primary">Aplicar</button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-md-6 text-right">
                                            <a href="{{ route('cablestroncales.index') }}" class="btn btn-primary"><i class="material-icons">arrow_back</i></a>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="text-primary">
                                                <th>Cable</th>
                                                <th>Distancia OTDR</th>
                                                <th>Distancia Ruta 5</th>
                                                <th>Ubicación</th>
                                                <th>Latitud</th>
                                                <th>Longitud</th>
                                                <th>Atenuación</th>
                                                <th>Observaciones</th>
                                                <th>Fecha de creación</th>
                                            </thead>
                                            <tbody>
                                                @foreach ($mufas as $mufa)
                                                <tr>
                                                    <td><a href="{{ route('cable.detallecable.index', $mufa->cable)}}">{{ $mufa->cable->nombre_cable}}</a></td>
                                                    <td>{{ $mufa->distancia_k}}</td>
                                                    <td>{{ $mufa->ruta5_k}}</td>
                                                    <td>{{ $mufa->ubicacion}}</td>
                                                    <td>{{ $mufa->latitud}}</td>
                                                    <td>{{ $mufa->longitud}}</td>
                                                    @if ($mufa->atenuacion == NULL)
                                                        <td>{{ $mufa->atenuacion}}</td>
                                                    @elseif ($mufa->atenuacion != NULL)
                                                        <td>{{ $mufa->atenuacion}} db</td>
                                                    @endif
                                                    <td>{{ $mufa->observaciones}}</td>
                                                    <td>{{ $mufa->fecha}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <div class="d-flex justify-content-center">
                                            {!! $mufas->links("pagination::bootstrap-4") !!}
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

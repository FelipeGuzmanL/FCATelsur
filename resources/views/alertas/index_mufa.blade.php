@extends('layouts.app', ['activePage' => 'cablestroncales', 'titlePage' => 'Lista de Alertas'])
@section('content')
    <div class="content">
        <div class="container-fuid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header card-header-primary">
                                    <h4 class="card-tittle">Alerta de Mufa del cable {{$alerta->mufa->cable->nombre_cable}}</h4>
                                    <div class="row">
                                        <div class="col-7 text-right d-felx">
                                            <form action="#" method="get">
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
                                            <a href="{{ route('mufas.edit_mufa', $alerta)}}" class="btn btn-warning">Editar Alerta</a>
                                            <a href="{{ route('mufas.index_cable', $alerta->mufa->cable) }}" class="btn btn-primary"><i class="material-icons">arrow_back</i></a>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="text-primary">
                                                <th>Distancia OTDR</th>
                                                <th>Distancia Ruta 5</th>
                                                <th>Ubicación</th>
                                                <th>Latitud</th>
                                                <th>Longitud</th>
                                                <th>Atenuación</th>
                                                <th>Observaciones</th>
                                                <th>Fecha de creación</th>
                                                <th class="text-right">Acciones</th>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>{{ $alerta->mufa->distancia_k}}</td>
                                                    <td>{{ $alerta->mufa->ruta5_k}}</td>
                                                    <td>{{ $alerta->mufa->ubicacion}}</td>
                                                    <td>{{ $alerta->mufa->latitud}}</td>
                                                    <td>{{ $alerta->mufa->longitud}}</td>
                                                    <td>{{ $alerta->mufa->atenuacion}} db</td>
                                                    <td>{{ $alerta->mufa->observaciones}}</td>
                                                    <td>{{ $alerta->mufa->fecha}}</td>
                                                    <td class="td-actions text-right">
                                                        <a href="{{ route('cable.mufas.edit', [$alerta->mufa->cable, $alerta->mufa])}}" class="btn btn-primary"><i class="material-icons">edit</i></a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <table class="table">
                                            <thead class="text-primary">
                                                <th>Observación de la Alerta</th>
                                                <th>Severidad</th>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>{{ $alerta->observacion}}</td>
                                                    @if ($alerta->gravedad->gravedad == 'Baja')
                                                        <td class="text-success">{{ $alerta->gravedad->gravedad}}</td>
                                                    @elseif ($alerta->gravedad->gravedad == 'Media')
                                                        <td class="text-warning">{{ $alerta->gravedad->gravedad}}</td>
                                                    @elseif ($alerta->gravedad->gravedad == 'Alta')
                                                        <td class="text-danger">{{ $alerta->gravedad->gravedad}}</td>
                                                    @endif
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

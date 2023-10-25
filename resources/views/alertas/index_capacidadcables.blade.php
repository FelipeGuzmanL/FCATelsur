@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => 'Lista de Alertas Capacidad Cables'])
@section('content')
    <div class="content">
        <div class="container-fuid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header card-header-primary">
                                    <h4 class="card-tittle">Lista de Cables de Fibra Óptica con poca capacidad</h4>
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
                                            <a href="{{ route('dashboard')}}" class="btn btn-primary"><i class="material-icons">arrow_back</i></a>
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
                                                <th>Porcentaje Capacidad</th>
                                            </thead>
                                            <tbody>
                                                @foreach ($cable_alarmados as $index => $cable)
                                                    <tr>
                                                        <td><a href="{{ route('cable.detallecable.index', $cable->id)}}">{{$cable->nombre_cable}}</a></td>
                                                        <td>{{$cable->sitio->abreviacion}}</td>
                                                        <td>{{$cable->cant_filam}}</td>
                                                        <td>{{$cable->tipocable->tipo}}</td>
                                                        <td>{{$cable->descripcion}}</td>
                                                        @if ($porcentajes[$index] >= 75 && $porcentajes[$index] < 90)
                                                            <td class="text-warning"><strong>{{$porcentajes[$index]}}%</strong></td>
                                                        @elseif ($porcentajes[$index] >= 90)
                                                            <td class="text-danger"><strong>{{$porcentajes[$index]}}%</strong></td>
                                                        @endif
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

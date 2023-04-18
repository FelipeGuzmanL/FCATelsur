@extends('layouts.app', ['activePage' => 'etiquetas', 'titlePage' => 'Filamento'])
@section('content')
    <div class="content">
        <div class="container-fuid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header card-header-primary">
                                    <h4 class="card-tittle">Cable: {{$etiqueta->cable->sitio->abreviacion}} {{ $etiqueta->cable->nombre_cable}} Filamento: {{ $etiqueta->filam}}</h4>
                                    <p class="card-category">Filamento</p>
                                </div>
                                <div class="card-body">
                                    @if (session('success'))
                                        <div class="alert alert-success" role="success">
                                            {{ session('success') }}
                                        </div>
                                    @endif
                                    <div class="row">
                                        <div class="col-12 text-right">
                                            <a href="{{ url()->previous()}}" class="btn btn-primary"><i class="material-icons">arrow_back</i></a>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="text-primary">
                                                <th>Filam</th>
                                                <th>DIR</th>
                                                <th>Servicio</th>
                                                <th>Cruzada</th>
                                                <th>Observaciones</th>
                                                <th>Estado</th>
                                                <th>Longitud</th>
                                                <th>Fecha Modificación</th>
                                                <th class="text-right">Acciones</th>
                                            </thead>
                                            <tbody>
                                                @foreach ($detalle as $detalle)
                                                    <tr>
                                                        <td>{{ $detalle->filamento}}</td>
                                                        <td>{{ $detalle->direccion}}</td>
                                                        <td>{{ $detalle->servicio}}</td>
                                                        <td>{{ $detalle->cruzada}}</td>
                                                        <td>{{ $detalle->observaciones}}</td>
                                                        @if ($detalle->estado->id == 1)
                                                            <td class="text-success">{{ $detalle->estado->estado}}</td>
                                                        @endif
                                                        @if ($detalle->estado->id == 2)
                                                            <td class="text-danger">{{ $detalle->estado->estado}}</td>
                                                        @endif
                                                        <td>{{ $detalle->longitud}}</td>
                                                        <td>{{ $detalle->updated_at}}</td>
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

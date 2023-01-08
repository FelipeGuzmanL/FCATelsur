@extends('layouts.app', ['activePage' => 'cable', 'titlePage' => 'Detalles del Cable'])
@section('content')
    <div class="content">
        <div class="container-fuid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header card-header-primary">
                                    <h4 class="card-tittle">Detalles del cable {{$cable->sitio->abreviacion }} {{ $cable->nombre_cable}}</h4>
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
                                    <p class="card-category">Datos de Cables de Fibra Óptica</p>
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
                                            <a href="{{ route('cable.index') }}" class="btn btn-primary"><i class="material-icons">arrow_back</i></a>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="text-primary text-center">
                                                <th>Filam</th>
                                                <th>DIR</th>
                                                <th>Servicio</th>
                                                <th>Cruzada</th>
                                                <th>Observaciones</th>
                                                <th>Estado</th>
                                                <th>Longitud</th>
                                                <th class="text-right">Acciones</th>
                                            </thead>
                                            <tbody>
                                            @foreach ($detalles as $detalle)
                                                @if ($detalle->cable->id == $cable->id)
                                                    <tr class="text-center">
                                                        <td>{{ $detalle->filamento}}</td>
                                                        <td>{{ $detalle->direccion}}</td>
                                                        <td>{{ $detalle->servicio}}</td>
                                                        <td>{{ $detalle->cruzada}}</td>
                                                        <td>{{ $detalle->observaciones}}</td>
                                                        @if ($detalle->estado->id == "1")
                                                            <td class="text-success">{{ $detalle->estado->estado}}</td>
                                                        @elseif ($detalle->estado->id == "2")
                                                            <td class="text-danger">{{ $detalle->estado->estado}}</td>
                                                        @endif
                                                        <td>{{ $detalle->longitud}} mts</td>
                                                        <td class="td-actions text-right">
                                                            @if ( $detalle->gmaps == NULL)
                                                            @elseif ( $detalle->gmaps != NULL)
                                                                <a href="{{ $detalle->gmaps }}" target="_blank" class="btn btn-success"><i class="material-icons">location_on</i></a>
                                                            @endif
                                                            <a href="{{ route('cable.detallecable.edit', [$cable,$detalle]) }}" class="btn btn-warning"><i class="material-icons">edit</i></a>
                                                            <form action="{{route('cable.detallecable.destroy', [$cable,$detalle])}}" method="post" style="display: inline-block" onsubmit="return confirm('¿Estás seguro?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-danger" type="submit" rel="tooltip">
                                                                <i class="material-icons">close</i>
                                                            </button>
                                                            </form>
                                                        </td>
                                                    </tr>
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

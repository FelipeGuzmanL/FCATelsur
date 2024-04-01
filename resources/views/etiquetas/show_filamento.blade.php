@extends('layouts.app', ['activePage' => 'etiquetas', 'titlePage' => 'Etiqueta'])
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
                                            </thead>
                                            <tbody>
                                                @foreach ($detalles as $detalle)
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
                                <div class="card-header card-header-primary">
                                    <h4 class="card-tittle">Detalles de Equipo MSAN</h4>
                                </div>
                                <div class="card-body">
                                    @if ($existe_olt == 1)
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="text-primary">
                                                <th>OLT MSAN</th>
                                                <th>Sitio FCA</th>
                                                <th>SPL</th>
                                                <th>Descripción Sitio</th>
                                                <th>Cable</th>
                                                <th>Filam</th>
                                                <th>Estado</th>
                                                <th>Alerta</th>
                                            </thead>
                                            <tbody>
                                                @foreach ($detalles as $detalle)
                                                    @php
                                                        $equipo = $detalle->olt->msan->equiposmsan;
                                                        $slot = $detalle->olt->msan;
                                                        $olt = $detalle->olt;
                                                        $cables = $detalle->cable;
                                                    @endphp
                                                    <td><a href="{{ route('equiposmsan.slots.olt.index', [$equipo,$slot])}}">{{ $detalle->ocupacion}}</a></td>
                                                    <td>{{$detalle->olt->sitio_fca}}</td>
                                                    <td>{{$detalle->olt->spl}}</td>
                                                    <td>{{$detalle->olt->descripcion_fca}}</td>
                                                    <td><a href="{{ route('equiposmsan.slots.olt.cables.index', [$equipo,$slot,$olt,$cables])}}">{{ $olt->cable->nombre_cable}}</a></td>
                                                    <td>{{$detalle->olt->filam}}</td>
                                                    @if ($detalle->olt->estad->id == "1")
                                                        <td class="text-success">{{ $detalle->olt->estad->estado}}</td>
                                                    @elseif ($detalle->olt->estad->id == "2")
                                                        <td class="text-danger">{{ $detalle->olt->estad->estado}}</td>
                                                    @endif
                                                    @if ($detalle->olt->alerta != null)
                                                        <td><a href="{{ route('equiposmsan.slots.olt.alertas.show', [$equipo,$slot,$olt,$olt->alerta]) }}">{{$olt->alerta->gravedad->gravedad}}</a></td>
                                                    @else
                                                        <td>Sin Alerta</td>
                                                    @endif

                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    @endif
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

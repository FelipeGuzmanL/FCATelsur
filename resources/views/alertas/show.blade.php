@extends('layouts.app', ['activePage' => 'equiposmsan', 'titlePage' => 'Alerta filamento'])
@section('content')
    <div class="content">
        <div class="container-fuid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header card-header-primary">
                                    <h4 class="card-tittle">Cable: </h4>
                                    <p class="card-category">Filamento Alertado</p>
                                </div>
                                <div class="card-body">
                                    @if (session('success'))
                                        <div class="alert alert-success" role="success">
                                            {{ session('success') }}
                                        </div>
                                    @endif
                                    @if (session('warning'))
                                        <div class="alert alert-warning" role="warning">
                                            {{ session('warning') }}
                                        </div>
                                    @endif
                                    <div class="row">
                                        <div class="col-12 text-right">
                                            <a href="{{ route('equiposmsan.slots.olt.alertas.edit',[$equipo,$slot,$olt,$alerta])}}" class="btn btn-warning">Editar Alerta</a>
                                            <a href="{{ route('equiposmsan.slots.olt.index',[$equipo,$slot,$olt])}}" class="btn btn-primary"><i class="material-icons">arrow_back</i></a>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="text-primary">
                                                <th>OLT</th>
                                                <th>Sitio FCA</th>
                                                <th>SPL</th>
                                                <th>descripcion Sitio</th>
                                                <th>Cable</th>
                                                <th>Filam</th>
                                                <th>Estado</th>
                                                <th>Fecha Modificación</th>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>{{ $olt->olt }}</td>
                                                    <td>{{ $olt->sitio_fca}}</td>
                                                    <td>{{ $olt->spl}}</td>
                                                    <td>{{ $olt->descripcion_fca}}</td>
                                                    @if ($olt->cable->id > "1")
                                                        @php
                                                            $cables = $olt->cable
                                                        @endphp
                                                        <td><a href="{{ route('equiposmsan.slots.olt.cables.index', [$equipo,$slot,$olt,$cables])}}">{{ $olt->cable->nombre_cable}}</a></td>
                                                    @endif
                                                    @if ($olt->cable->id == "1")
                                                        <td></td>
                                                    @endif
                                                    <td>{{ $olt->filam}}</td>
                                                    @if ($olt->estad->id == "1")
                                                        <td class="text-success">{{ $olt->estad->estado}}</td>
                                                    @endif
                                                    @if ($olt->estad->id == "2")
                                                        <td class="text-danger">{{ $olt->estad->estado}}</td>
                                                    @endif
                                                    <td>{{ $olt->updated_at}} <br> por {{ $olt->usuario->name}}</td>
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
                                                        <td class="text-success"><strong>{{ $alerta->gravedad->gravedad}}</strong></td>
                                                    @elseif ($alerta->gravedad->gravedad == 'Media')
                                                        <td class="text-warning"><strong>{{ $alerta->gravedad->gravedad}}</strong></td>
                                                    @elseif ($alerta->gravedad->gravedad == 'Alta')
                                                        <td class="text-danger"><strong>{{ $alerta->gravedad->gravedad}}</strong></td>
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

@extends('layouts.app', ['activePage' => 'cable', 'titlePage' => 'Alerta filamento'])
@section('content')
    <div class="content">
        <div class="container-fuid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header card-header-primary">
                                    <h4 class="card-tittle">Cable: {{ $alerta->detallecable->cable->sitio->abreviacion}} {{ $alerta->detallecable->cable->nombre_cable}} <br> Tipo de Cable: {{ $alerta->detallecable->cable->tipocable->tipo}}</h4>
                                    <p class="card-category">Filamento {{ $alerta->detallecable->filamento}} Alertado</p>
                                </div>
                                <div class="card-body">
                                    @if (session('success'))
                                        <div class="alert alert-success" role="success">
                                            {{ session('success') }}
                                        </div>
                                    @endif
                                    <div class="row">
                                        <div class="col-12 text-right">
                                            <form action="{{ route('cables.destroy_cable', $alerta->detallecable)}}" method="post" style="display: inline-block" onsubmit="return confirm('¿Está seguro de eliminar esta alerta?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger" type="submit" rel="tooltip">
                                                    Eliminar Alerta
                                                </button>
                                            </form>
                                            <a href="{{ route('cables.edit_cable', $alerta->detallecable)}}" class="btn btn-warning">Editar Alerta</a>
                                            <!--a href="{{ route('cable.detallecable.index', [$alerta->detallecable->cable,$alerta->detallecable])}}" class="btn btn-primary"><i class="material-icons">arrow_back</i></a-->
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
                                                <tr>
                                                    <td>{{ $alerta->detallecable->filamento}}</td>
                                                    <td>{{ $alerta->detallecable->direccion}}</td>
                                                    @if ($alerta->detallecable->ocupacion == NULL && $alerta->detallecable->servicio == NULL)
                                                        <td></td>
                                                    @endif
                                                    @if($alerta->detallecable->ocupacion == NULL && $alerta->detallecable->servicio != NULL)
                                                        <td>{{ $alerta->detallecable->servicio}}</td>
                                                    @endif
                                                    @if($alerta->detallecable->ocupacion != NULL && $alerta->detallecable->servicio == NULL)
                                                    @php
                                                        $equipo = $alerta->detallecable->olt->msan->equiposmsan;
                                                        $slot = $alerta->detallecable->olt->msan;
                                                    @endphp
                                                        <td><a href="{{ route('equiposmsan.slots.olt.index', [$equipo,$slot])}}">{{ $detalle->ocupacion}}</a></td>
                                                    @endif
                                                    <td>{{ $alerta->detallecable->cruzada}}</td>
                                                    <td>{{ $alerta->detallecable->observaciones}}</td>
                                                    @if ($alerta->detallecable->estado->id == "1")
                                                        <td class="text-success">{{ $alerta->detallecable->estado->estado}}</td>
                                                    @elseif ($alerta->detallecable->estado->id == "2")
                                                        <td class="text-danger">{{ $alerta->detallecable->estado->estado}}</td>
                                                    @endif
                                                    <td>{{ $alerta->detallecable->longitud}} mts</td>
                                                    <td>{{ $alerta->detallecable->updated_at}}</td>
                                                    <td class="td-actions text-right">
                                                        <a href="{{ route('cable.detallecable.edit',[$alerta->detallecable->cable, $alerta->detallecable])}}" class="btn btn-primary"><i class="material-icons">edit</i></a>
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

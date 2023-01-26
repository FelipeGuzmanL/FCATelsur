@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => 'Lista de Alertas'])
@section('content')
    <div class="content">
        <div class="container-fuid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header card-header-primary">
                                    <h4 class="card-tittle">Lista de Cables de Fibra Óptica de</h4>
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
                                            <a href="#" class="btn btn-primary">Añadir Cable</a>
                                            <a href="#" class="btn btn-primary"><i class="material-icons">arrow_back</i></a>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="text-primary">
                                                <th>Tipo de Alerta</th>
                                                <th>Información</th>
                                                <th>Observación</th>
                                                <th>Fecha creación de alerta</th>
                                                <th>Severidad</th>
                                                <th>Link</th>
                                            </thead>
                                            <tbody>
                                                @foreach ($alertas as $alerta)
                                                    <tr>
                                                        @if ($alerta->id_olt == NULL && $alerta->id_detallecable != NULL)
                                                            <td>Cables</td>
                                                        @endif
                                                        @if ($alerta->id_olt != NULL && $alerta->id_detallecable == NULL)
                                                            <td>OLTs</td>
                                                        @endif
                                                        @if ($alerta->id_olt == NULL && $alerta->id_detallecable != NULL)
                                                            <td>{{ $alerta->detallecable->cable->sitio->abreviacion}} {{ $alerta->detallecable->cable->nombre_cable}}
                                                                <br> FILAM: {{$alerta->detallecable->filamento}}
                                                                <br> Tipo Cable: {{$alerta->detallecable->cable->tipocable->tipo}}
                                                            </td>
                                                        @endif
                                                        @if ($alerta->id_olt != NULL && $alerta->id_detallecable == NULL)
                                                            <td>{{$alerta->olt->msan->equiposmsan->sitio->abreviacion}} {{ $alerta->olt->msan->slot_msan}}
                                                            <br> OLT: {{$alerta->olt->olt}}
                                                            </td>
                                                        @endif
                                                        <td>{{ $alerta->observacion}}</td>
                                                        <td>{{ $alerta->created_at}}</td>

                                                        @if ($alerta->gravedad->gravedad == 'Baja')
                                                            <td class="text-success"><strong>{{ $alerta->gravedad->gravedad}}</strong></td>
                                                        @elseif ($alerta->gravedad->gravedad == 'Media')
                                                            <td class="text-warning"><strong>{{ $alerta->gravedad->gravedad}}</strong></td>
                                                        @elseif ($alerta->gravedad->gravedad == 'Alta')
                                                            <td class="text-danger"><strong>{{ $alerta->gravedad->gravedad}}</strong></td>
                                                        @endif
                                                        @if ($alerta->id_olt == NULL && $alerta->id_detallecable != NULL)
                                                            <td><a href="{{ route('cables.show_cable',[$alerta])}}">Ver</a></td>
                                                        @endif
                                                        @if ($alerta->id_olt != NULL && $alerta->id_detallecable == NULL)
                                                            <td><a href="{{ route('equiposmsan.slots.olt.alertas.show', [$alerta->olt->msan->equiposmsan,$alerta->olt->msan,$alerta->olt,$alerta])}}">Ver</a></td>
                                                        @endif
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <div class="d-flex justify-content-center">
                                            {!! $alertas->links("pagination::bootstrap-4") !!}
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

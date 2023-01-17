@extends('layouts.app', ['activePage' => 'mantenciones', 'titlePage' => 'Mantencion MSAN'])
@section('content')
    <div class="content">
        <div class="container-fuid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header card-header-primary">
                                    <h4 class="card-tittle">Numero Ticket: {{ $mantencion->numero_ticket}} <br> Sitio: {{ $mantencion->msan->sitio->abreviacion}} <br> Fecha Mantención: {{ $mantencion->fecha_mantencion}}</h4>
                                    <p class="card-category">Datos de {{ $mantencion->msan->sitio->abreviacion}} {{ $mantencion->msan->numero}}</p>
                                </div>
                                <div class="card-body">
                                    @if (session('success'))
                                        <div class="alert alert-success" role="success">
                                            {{ session('success') }}
                                        </div>
                                    @endif
                                    <div class="row">
                                        <div class="col-12 text-right">
                                            <a href="{{ route('equiposmsan.mantencionesmsan.index', [$equipo])}}" class="btn btn-primary"><i class="material-icons">arrow_back</i></a>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="text-primary">
                                                <th>Tarea</th>
                                                <th>Comprobado</th>
                                            </thead>
                                            <tbody>
                                                @for ($i = 0; $i < 11; $i++)
                                                    <tr>
                                                        <td>{{$comprobacion[$i]}}</td>
                                                        @if ( $comp[$i] == 'OK')
                                                            <td class="text-success"><strong>{{ $comp[$i]}}</strong></td> 
                                                        @endif
                                                        @if ($comp[$i] == 'No OK')
                                                            <td class="text-danger"><strong>{{ $comp[$i]}}</strong></td> 
                                                        @endif
                                                        
                                                    </tr>
                                                @endfor
                                            </tbody>
                                        </table>
                                        <table class="table">
                                            <thead class="text-primary">
                                                <th>Observaciones</th>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>{{$mantencion->observaciones}}</td>
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

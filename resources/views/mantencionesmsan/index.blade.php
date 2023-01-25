@extends('layouts.app', ['activePage' => 'mantenciones', 'titlePage' => 'Mantenciones MSAN'])
@section('content')
    <div class="content">
        <div class="container-fuid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header card-header-primary">
                                    <h4 class="card-tittle">Mantenciones del MSAN {{ $equipo->Ubicacion->ciudad->abreviacion }} {{ $equipo->numero }}</h4>
                                    <div class="row">
                                        <div class="col-7 text-right d-felx">
                                            <form action="{{route('equiposmsan.mantencionesmsan.index', [$equipo])}}" method="get">
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
                                    <p class="card-category">Datos de Equipos MSAN</p>
                                </div>
                                <div class="card-body">
                                    @if (session('success'))
                                        <div class="alert alert-success" role="success">
                                            {{ session('success') }}
                                        </div>
                                    @endif
                                    <div class="row">
                                        <div class="col-12 text-right">
                                            <a href="{{ route('equiposmsan.mantencionesmsan.create', [$equipo])}}" class="btn btn-primary">Crear Mantención</a>
                                            <a href="{{ route('index_msan.index') }}" class="btn btn-primary"><i class="material-icons">arrow_back</i></a>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="text-primary">
                                                <th>Nombre</th>
                                                <th>Numero Ticket</th>
                                                <th>Fecha Mantención</th>
                                                <th>Mantencion realizada por</th>
                                                <th class="text-right">Acciones</th>
                                            </thead>
                                            <tbody>
                                                @if (count($mantenciones)<=0)
                                                    <div class="alert alert-danger" style="text-align:center" role="alert">
                                                        <h4>No hay mantenciones registradas</h4>
                                                    </div>
                                                @endif
                                                @foreach ($mantenciones as $mantencion)
                                                    @if ($equipo->id == $mantencion->msan->id)
                                                        <tr>
                                                            <td>{{ $equipo->Ubicacion->ciudad->abreviacion }} {{ $equipo->numero }}</td>
                                                            <td>{{ $mantencion->numero_ticket}}</td>
                                                            <td>{{ $mantencion->fecha_mantencion}}</td>
                                                            <td >{{ $mantencion->user->name}}</td>
                                                            <td class="td-actions text-right">
                                                                <a href="{{ route('equiposmsan.mantencionesmsan.show', [$equipo,$mantencion->id])}}" class="btn btn-info"><i class="material-icons">library_books</i></a>
                                                                <form action="{{ route('equiposmsan.mantencionesmsan.destroy', [$equipo,$mantencion->id])}}" method="post" style="display: inline-block" onsubmit="return confirm('¿Estás seguro?')">
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

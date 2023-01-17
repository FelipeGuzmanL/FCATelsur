@extends('layouts.app', ['activePage' => 'equiposmsan', 'titlePage' => 'Lista de Equipos MSAN'])
@section('content')
    <div class="content">
        <div class="container-fuid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header card-header-primary">
                                    <h4 class="card-tittle">Lista de Equipos MSAN de {{ $sitio->nombre}}</h4>
                                    <div class="row">
                                        <div class="col-7 text-right d-felx">
                                            <form action="{{route('sitios.index_equipo', $sitio->id)}}" method="get">
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
                                            <a href="{{ route('equiposmsan.create') }}" class="btn btn-primary">Añadir MSAN</a>
                                            <a href="{{ url()->previous() }}" class="btn btn-primary"><i class="material-icons">arrow_back</i></a>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="text-primary">
                                                <th>Sitio</th>
                                                <th>Nombre</th>
                                                <th>Slots</th>
                                                <th class="text-right">Acciones</th>
                                            </thead>
                                            <tbody>
                                            @foreach ($equipo as $equipo)
                                            @if ($sitio->id == $equipo->sitio->id)
                                                <tr>
                                                    <td>{{ $equipo->Ubicacion->ciudad->nombre }}</td>
                                                    <td>{{ $equipo->Ubicacion->ciudad->abreviacion }} {{ $equipo->numero }}</td>
                                                    <td><a href="{{ route('equiposmsan.slots.index', $equipo->id)}}">Slots {{ $equipo->Ubicacion->ciudad->abreviacion }} {{ $equipo->numero }}</a></td>
                                                    <td class="td-actions text-right">
                                                        @if ( $equipo->Ubicacion->link_gmaps == NULL)
                                                        @elseif ( $equipo->Ubicacion->link_gmaps != NULL)
                                                            <a href="{{ $equipo->Ubicacion->link_gmaps }}" target="_blank" class="btn btn-success"><i class="material-icons">location_on</i></a>
                                                        @endif
                                                        <!--a href="{{ route('equiposmsan.show', $equipo->id) }}" class="btn btn-info"><i class="material-icons">library_books</i></a-->
                                                        <a href="{{ route('equiposmsan.edit', $equipo->id) }}" class="btn btn-warning"><i class="material-icons">edit</i></a>
                                                        <form action="{{route('equiposmsan.destroy', $equipo->id)}}" method="post" style="display: inline-block" onsubmit="return confirm('¿Estás seguro?')">
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

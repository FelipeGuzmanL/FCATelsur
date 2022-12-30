@extends('layouts.app', ['activePage' => 'sitios', 'titlePage' => 'Lista de Sitios'])
@section('content')
    <div class="content">
        <div class="container-fuid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header card-header-primary">
                                    <h4 class="card-tittle">Lista de Sitios</h4>
                                    <div class="row">
                                        <div class="col-7 text-right d-felx">
                                            <form action="{{route('sitios.index')}}" method="get">
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
                                    <p class="card-category">Datos de Sitios</p>
                                </div>
                                <div class="card-body">
                                    @if (session('success'))
                                        <div class="alert alert-success" role="success">
                                            {{ session('success') }}
                                        </div>
                                    @endif
                                    <div class="row">
                                        <div class="col-12 text-right">
                                            <a href="{{ route('sitios.create') }}" class="btn btn-sm btn-facebook">Añadir Sitio</a>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="text-primary">
                                                <th>Nombre</th>
                                                <th>Abreviación</th>
                                                <th>Descripcion</th>
                                                <th class="text-right">Acciones</th>
                                            </thead>
                                            <tbody>
                                            @if (count($sitios)<=0)
                                                <div class="alert alert-danger" style="text-align:center" role="alert">
                                                    <h4>No se han encontrado sitios</h4>
                                                </div>
                                            @endif
                                            @foreach ($sitios as $sitio)
                                                <tr>
                                                    <td>{{ $sitio->nombre }}</td>
                                                    <td>{{ $sitio->abreviacion }}</td>
                                                    <td>{{ $sitio->descripcion }}</td>
                                                    <td class="td-actions text-right">
                                                        @if ( $sitio->url == NULL)
                                                        @elseif ( $sitio->url != NULL)
                                                            <a href="{{ $sitio->url }}" target="_blank" class="btn btn-success"><i class="material-icons">location_on</i></a>
                                                        @endif
                                                        <!--a href="{{ route('sitios.show', $sitio->id) }}" class="btn btn-info"><i class="material-icons">library_books</i></a-->
                                                        <a href="{{ route('sitios.edit', $sitio->id) }}" class="btn btn-warning"><i class="material-icons">edit</i></a>
                                                        <form action="{{route('sitios.destroy', $sitio->id)}}" method="post" style="display: inline-block" onsubmit="return confirm('¿Estás seguro?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger" type="submit" rel="tooltip">
                                                            <i class="material-icons">close</i>
                                                        </button>
                                                        </form>
                                                    </td>
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

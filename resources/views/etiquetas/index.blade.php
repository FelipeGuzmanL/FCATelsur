@extends('layouts.app', ['activePage' => 'etiquetas', 'titlePage' => 'Lista de Etiquetas'])
@section('content')
    <div class="content">
        <div class="container-fuid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header card-header-primary">
                                    <h4 class="card-tittle">Lista de Etiquetas</h4>
                                    <div class="row">
                                        <div class="col-7 text-right d-felx">
                                            <form action="{{ route('etiquetas.index')}}" method="get">
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
                                    <p class="card-category">Datos de Etiquetas</p>
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
                                            <a href="{{ route('etiquetas.create')}}" class="btn btn-primary">Agregar Etiqueta</a>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="text-primary">
                                                <th>Cable</th>
                                                <th>Filam</th>
                                                <th>Sitio</th>
                                                <th>Etiqueta</th>
                                                <th class="text-right">Acciones</th>
                                            </thead>
                                            <tbody>
                                                @foreach ($etiquetas as $etiqueta)
                                                    <tr>
                                                        <td><a href="{{ route('cable.detallecable.index', $etiqueta->cable->id)}}">{{ $etiqueta->cable->nombre_cable}}</a></td>
                                                        <td><a href="{{ route('etiquetas.show_filamento', $etiqueta)}}">{{ $etiqueta->filam}}</a></td>
                                                        <td>{{ $etiqueta->cable->sitio->abreviacion}}</td>
                                                        <td>{{ $etiqueta->etiqueta}}</td>
                                                        <td class="td-actions text-right">
                                                            @if ($etiqueta->cable->sitio->url == NULL)
                                                            @elseif ($etiqueta->cable->sitio->url != NULL)
                                                                <a href="{{$etiqueta->cable->sitio->url }}" target="_blank" class="btn btn-success"><i class="material-icons">location_on</i></a>
                                                            @endif
                                                            <a href="{{ route('etiquetas.edit', $etiqueta->id)}}" class="btn btn-primary"><i class="material-icons">edit</i></a>
                                                            <form action="{{ route('etiquetas.destroy', $etiqueta->id)}}" method="post" style="display: inline-block" onsubmit="return confirm('¿Estás seguro?')">
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
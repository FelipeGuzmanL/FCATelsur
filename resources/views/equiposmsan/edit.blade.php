@extends('layouts.app', ['activePage' => 'equiposmsan', 'titlePage' => 'Guardar Equipo MSAN'])
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form action="{{route('equiposmsan.update', $equipos->id)}}" method="post" class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-tittle">Guardar MSAN</h4>
                            <p class="card-category">Ingresar datos</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 text-right">
                                    <a href="{{ url()->previous() }}" class="btn btn-primary"><i class="material-icons">arrow_back</i></a>
                                </div>
                            </div>
                            <div class="row">
                            <label for="numero" class="col-sm-2 col-form-label">Numero MSAN</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="numero" placeholder="Numero MSAN" value="{{old('numero', $equipos->numero)}}" autofocus required oninvalid="this.setCustomValidity('Ingrese ID de licitación')" oninput="this.setCustomValidity('')"/>
                                    @if ($errors->has('numero'))
                                        <span class="error text-danger" for="input-numero">{{$errors -> first('numero')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label for="tecnologia" class="col-sm-2 col-form-label">Tecnología</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="tecnologia" placeholder="Ingrese tecnología" value="{{old('tecnologia', $equipos->tecnologia)}}">
                                    @if ($errors->has('tecnologia'))
                                        <span class="error text-danger" for="input-tecnologia">{{$errors -> first('tecnologia')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label for="id_ubicacion" class="col-sm-2 col-form-label">Sitio</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <select class="form-control selectpicker" data-style="btn btn-link" id="exampleFormControlSelect1" name="id_ubicacion">
                                        @foreach ( $sitio as $sitio )
                                            <option value="{{ $sitio->id }}" {{$equipos->Ubicacion->ciudad->id == $sitio->id ? 'selected' : ''}}>{{ $sitio->nombre }} - {{ $sitio->abreviacion}}</option>
                                        @endforeach
                                        </select>
                                      </div>
                                </div>
                            </div>
                            <div class="row">
                                <label for="direccion" class="col-sm-2 col-form-label">Direccion</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="direccion" placeholder="Ingrese dirección" value="{{old('direccion', $equipos->Ubicacion->direccion)}}">
                                    @if ($errors->has('direccion'))
                                        <span class="error text-danger" for="input-direccion">{{$errors -> first('direccion')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label for="coordenadas" class="col-sm-2 col-form-label">Coordenadas</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="coordenadas" placeholder="Ingrese coordenadas" value="{{old('coordenadas', $equipos->Ubicacion->coordenadas)}}">
                                    @if ($errors->has('coordenadas'))
                                        <span class="error text-danger" for="input-coordenadas">{{$errors -> first('coordenadas')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label for="link_gmaps" class="col-sm-2 col-form-label">Link GMaps</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="link_gmaps" placeholder="Link a Google Maps" value="{{old('link_gmaps', $equipos->Ubicacion->link_gmaps)}}">
                                    @if ($errors->has('link_gmaps'))
                                        <span class="error text-danger" for="input-link_gmaps">{{$errors -> first('link_gmaps')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label for="sitio_fca" class="col-sm-2 col-form-label">Sitio FCA</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="sitio_fca" placeholder="Ingrese Sitio FCA" value="{{old('sitio_fca', $equipos->Ubicacion->sitio_fca)}}">
                                    @if ($errors->has('sitio_fca'))
                                        <span class="error text-danger" for="input-sitio_fca">{{$errors -> first('sitio_fca')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label for="descripcion_sitio" class="col-sm-2 col-form-label">Descripcion Sitio FCA</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="descripcion_sitio" placeholder="Descripción" value="{{old('descripcion_sitio', $equipos->Ubicacion->descripcion_sitio)}}">
                                    @if ($errors->has('descripcion_sitio'))
                                        <span class="error text-danger" for="input-descripcion_sitio">{{$errors -> first('descripcion_sitio')}}</span>
                                    @endif
                                </div>
                            </div>
                        <div class="card-footer ml-auto mr-auto">
                            <button type="submit" class="btn btn-primary">{{ __('Guardar') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection

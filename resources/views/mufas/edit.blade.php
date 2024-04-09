@extends('layouts.app', ['activePage' => 'cablestroncales', 'titlePage' => 'Mufa del Cable'])
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form action="{{route('cable.mufas.update', [$cable,$mufa])}}" method="post" class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-tittle">Actualizar Mufa del Cable {{ $cable->sitio->abreviacion}} {{ $cable->nombre_cable}}</h4>
                            <p class="card-category">Ingresar datos de la mufa del Cable {{ $cable->sitio->abreviacion }} {{ $cable->nombre_cable}}</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 text-right">
                                    <a href="{{ route('mufas.create_mufa', $mufa)}}" class="btn btn-warning">Generar Alerta</a>
                                    <a href="{{ url()->previous() }}" class="btn btn-primary"><i class="material-icons">arrow_back</i></a>
                                </div>
                            </div>
                            <div class="row">
                                <label for="distancia_k" class="col-sm-2 col-form-label">Distancia OTDR</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="distancia_k" placeholder="Distancia en Kilometros" value="{{old('distancia_k', $mufa->distancia_k)}}">
                                    @if ($errors->has('distancia_k'))
                                        <span class="error text-danger" for="input-distancia_k">{{$errors -> first('distancia_k')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label for="ruta5_k" class="col-sm-2 col-form-label">Distancia Ruta 5</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="ruta5_k" placeholder="Distancia en Kilometros Ruta 5" value="{{old('ruta5_k', $mufa->ruta5_k)}}">
                                    @if ($errors->has('ruta5_k'))
                                        <span class="error text-danger" for="input-ruta5_k">{{$errors -> first('ruta5_k')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label for="ubicacion" class="col-sm-2 col-form-label">Ubicación</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="ubicacion" placeholder="Dirección de la ubicación" value="{{old('ubicacion', $mufa->ubicacion)}}">
                                    @if ($errors->has('ubicacion'))
                                        <span class="error text-danger" for="input-ubicacion">{{$errors -> first('ubicacion')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label for="latitud" class="col-sm-2 col-form-label">Latitud</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="latitud" placeholder="Coordenadas Latitud" value="{{old('latitud', $mufa->latitud)}}">
                                    @if ($errors->has('latitud'))
                                        <span class="error text-danger" for="input-latitud">{{$errors -> first('latitud')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label for="longitud" class="col-sm-2 col-form-label">Longitud</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="longitud" placeholder="Coordenadas longitud" value="{{old('longitud', $mufa->longitud)}}">
                                    @if ($errors->has('longitud'))
                                        <span class="error text-danger" for="input-longitud">{{$errors -> first('longitud')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label for="atenuacion" class="col-sm-2 col-form-label">Atenuación (DB)</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="atenuacion" placeholder="Atenuación (DB)" value="{{old('atenuacion', $mufa->atenuacion)}}">
                                    @if ($errors->has('atenuacion'))
                                        <span class="error text-danger" for="input-atenuacion">{{$errors -> first('atenuacion')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label for="observaciones" class="col-sm-2 col-form-label">Observaciones</label>
                                <div class="col-sm-7">
                                    <textarea class="form-control" name="observaciones" rows="3" placeholder="Observaciones">{{old('observaciones', $mufa->observaciones)}}</textarea>
                                    @if ($errors->has('observaciones'))
                                        <span class="error text-danger" for="input-observaciones">{{$errors -> first('observaciones')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label for="link_gmaps" class="col-sm-2 col-form-label">Link Gmaps</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="link_gmaps" placeholder="Coordenadas link_gmaps" value="{{old('link_gmaps', $mufa->link_gmaps)}}">
                                    @if ($errors->has('link_gmaps'))
                                        <span class="error text-danger" for="input-link_gmaps">{{$errors -> first('link_gmaps')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label for="fecha" class="col-sm-2 col-form-label">Fecha de creación</label>
                                <div class="col-sm-7">
                                    <input type="date" class="form-control" name="fecha" value="{{old('fecha', $mufa->fecha)}}">
                                </div>
                            </div>
                        <div class="card-footer ml-auto mr-auto">
                            <button type="submit" class="btn btn-primary">{{ __('Guardar') }}</button>
                        </div>
                    </div>
                </form>
            </div>
            <script>
                $("#sitios").select2({
                });
            </script>
            <script>
                $("#tipocables").select2({
                });
            </script>
            <style>
                .select2 {
                    width: 100% !important;
                }
            </style>
        </div>
    </div>
</div>


@endsection

@extends('layouts.app', ['activePage' => 'cable', 'titlePage' => 'Detalles del Cable'])
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form action="{{route('cable.detallecable.store', $cable->id)}}" method="post" class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-tittle">Guardar Datos del Cable {{ $cable->sitio->abreviacion}} {{ $cable->nombre_cable}}</h4>
                            <p class="card-category">Ingresar datos del Cable {{ $cable->sitio->abreviacion }} {{ $cable->nombre_cable}}</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 text-right">
                                    <a href="{{ url()->previous() }}" class="btn btn-primary"><i class="material-icons">arrow_back</i></a>
                                </div>
                            </div>
                            <div class="row">
                                <label for="filamento" class="col-sm-2 col-form-label">Filamento</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="filamento" placeholder="Número del filamento" value="{{old('filamento')}}" required oninvalid="this.setCustomValidity('Ingrese numero del filamento')" oninput="this.setCustomValidity('')"/>
                                    @if ($errors->has('filamento'))
                                        <span c lass="error text-danger" for="input-filamento">{{$errors -> first('filamento')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label for="direccion" class="col-sm-2 col-form-label">Dirección</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="direccion" placeholder="Dirección del filamento" value="{{old('direccion')}}" required oninvalid="this.setCustomValidity('Ingrese direccion del filamento')" oninput="this.setCustomValidity('')"/>
                                    @if ($errors->has('direccion'))
                                        <span class="error text-danger" for="input-direccion">{{$errors -> first('direccion')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label for="servicio" class="col-sm-2 col-form-label">Servicios</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="servicio" placeholder="Servicios" value="{{old('servicio')}}">
                                    @if ($errors->has('servicio'))
                                        <span class="error text-danger" for="input-servicio">{{$errors -> first('servicio')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label for="longitud" class="col-sm-2 col-form-label">Longitud filamento</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="longitud" placeholder="Longitud en Metros (ej: 8000, 5000, 200)" value="{{old('longitud')}}">
                                    @if ($errors->has('longitud'))
                                        <span class="error text-danger" for="input-longitud">{{$errors -> first('longitud')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label for="cruzada" class="col-sm-2 col-form-label">Cruzada</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="cruzada" placeholder="Cruzada" value="{{old('cruzada')}}">
                                    @if ($errors->has('cruzada'))
                                        <span class="error text-danger" for="input-cruzada">{{$errors -> first('cruzada')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label for="observaciones" class="col-sm-2 col-form-label">Observaciones</label>
                                <div class="col-sm-7">
                                    <textarea class="form-control" name="observaciones" rows="3" placeholder="Observaciones" value="{{old('observaciones')}}"></textarea>
                                    @if ($errors->has('observaciones'))
                                        <span class="error text-danger" for="input-observaciones">{{$errors -> first('observaciones')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label for="gmaps" class="col-sm-2 col-form-label">Link GMaps</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="gmaps" placeholder="Link Ubicación en GMaps (opcional)" value="{{old('gmaps')}}">
                                    @if ($errors->has('gmaps'))
                                        <span class="error text-danger" for="input-gmaps">{{$errors -> first('gmaps')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label for="id_estado" class="col-sm-2 col-form-label">Estado</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <select class="form-control sitios" data-style="btn btn-link" id="sitios" name="id_estado">
                                        @foreach ( $estado as $est )
                                            <option value="{{ $est->id }}">{{ $est->estado }}</option>
                                        @endforeach
                                        </select>
                                      </div>
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

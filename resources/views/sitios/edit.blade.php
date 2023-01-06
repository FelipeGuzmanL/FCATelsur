@extends('layouts.app', ['activePage' => 'sitios', 'titlePage' => 'Actualizar Sitio'])
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form action="{{route('sitios.update', $sitio->id)}}" method="post" class="form-horizontal">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-tittle">Sitio {{$sitio->nombre}} - {{$sitio->abreviacion}}</h4>
                            <p class="card-category">Actualizar datos</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 text-right">
                                    <a href="{{ url()->previous() }}" class="btn btn-primary"><i class="material-icons">arrow_back</i></a>
                                </div>
                            </div>
                            <div class="row">
                            <label for="nombre" class="col-sm-2 col-form-label">Nombre Sitio</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="nombre" placeholder="Nombre Sitio" value="{{old('nombre', $sitio->nombre)}}" autofocus required oninvalid="this.setCustomValidity('Ingrese Nombre del Sitio')" oninput="this.setCustomValidity('')"/>
                                    @if ($errors->has('nombre'))
                                        <span class="error text-danger" for="input-nombre">{{$errors -> first('nombre')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label for="abreviacion" class="col-sm-2 col-form-label">Nemotécnico</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="abreviacion" placeholder="Ingrese Nemotécnico" value="{{old('abreviacion', $sitio->abreviacion)}}" required oninvalid="this.setCustomValidity('Ingrese nemotécnico')" oninput="this.setCustomValidity('')"/>
                                    @if ($errors->has('abreviacion'))
                                        <span class="error text-danger" for="input-abreviacion">{{$errors -> first('abreviacion')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label for="direccion" class="col-sm-2 col-form-label">Dirección</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="direccion" placeholder="Ingrese Nemotécnico" value="{{old('direccion', $sitio->direccion)}}" required oninvalid="this.setCustomValidity('Ingrese nemotécnico')" oninput="this.setCustomValidity('')"/>
                                    @if ($errors->has('direccion'))
                                        <span class="error text-danger" for="input-direccion">{{$errors -> first('direccion')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label for="descripcion" class="col-sm-2 col-form-label">Descripcion</label>
                                <div class="col-sm-7">
                                    <textarea class="form-control" name="descripcion" rows="3" placeholder="Ingrese nombre descripcion">{{ old('descrpcion', $sitio->descripcion)}}</textarea>
                                    @if ($errors->has('descripcion'))
                                        <span class="error text-danger" for="input-descripcion">{{$errors -> first('descripcion')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label for="url" class="col-sm-2 col-form-label">Link GMaps</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="url" placeholder="Link Ubicación (opcional)" value="{{old('url', $sitio->url)}}">
                                    @if ($errors->has('url'))
                                        <span class="error text-danger" for="input-url">{{$errors -> first('url')}}</span>
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

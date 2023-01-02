@extends('layouts.app', ['activePage' => 'cable', 'titlePage' => 'Actualizar Cable'])
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form action="{{route('cable.update', $cable->id)}}" method="post" class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-tittle">Cable {{$cable->nombre_cable}}</h4>
                            <p class="card-category">Actualizar datos</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 text-right">
                                    <a href="{{ url()->previous() }}" class="btn btn-primary"><i class="material-icons">arrow_back</i></a>
                                </div>
                            </div>
                            <div class="row">
                                <label for="nombre_cable" class="col-sm-2 col-form-label">Nombre Cable</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="nombre_cable" placeholder="Nombre cable" value="{{old('nombre_cable', $cable->nombre_cable)}}" required oninvalid="this.setCustomValidity('Ingrese Nombre del Cable')" oninput="this.setCustomValidity('')"/>
                                    @if ($errors->has('nombre_cable'))
                                        <span class="error text-danger" for="input-nombre_cable">{{$errors -> first('nombre_cable')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label for="id_sitio" class="col-sm-2 col-form-label">Sitio</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <select class="form-control" data-style="btn btn-link" id="exampleFormControlSelect1" name="id_sitio">
                                        @foreach ( $sitios as $sitio )
                                            <option value="{{ $sitio->id }}" {{$cable->sitio->id == $sitio->id ? 'selected' : ''}}>{{ $sitio->nombre }} - {{ $sitio->abreviacion}}</option>
                                        @endforeach
                                        </select>
                                      </div>
                                </div>
                            </div>
                            <div class="row">
                            <label for="cant_filam" class="col-sm-2 col-form-label">Cantidad Filamentos</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="cant_filam" placeholder="Cantidad" value="{{old('cant_filam', $cable->cant_filam)}}">
                                    @if ($errors->has('cant_filam'))
                                        <span class="error text-danger" for="input-cant_filam">{{$errors -> first('cant_filam')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label for="cant_minitubos" class="col-sm-2 col-form-label">Cantidad Mini Tubos</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="cant_minitubos" placeholder="Cantidad" value="{{old('cant_minitubos', $cable->cant_minitubos)}}">
                                    @if ($errors->has('cant_minitubos'))
                                        <span class="error text-danger" for="input-cant_minitubos">{{$errors -> first('cant_minitubos')}}</span>
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

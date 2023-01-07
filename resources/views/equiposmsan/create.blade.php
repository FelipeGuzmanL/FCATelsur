@extends('layouts.app', ['activePage' => 'equiposmsan', 'titlePage' => 'Guardar Equipo MSAN'])
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form action="{{route('equiposmsan.store')}}" method="post" class="form-horizontal" enctype="multipart/form-data">
                    @csrf
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
                                    <input type="text" class="form-control" name="numero" placeholder="Numero MSAN" value="{{old('numero')}}" autofocus required oninvalid="this.setCustomValidity('Ingrese numero del MSAN')" oninput="this.setCustomValidity('')"/>
                                    @if ($errors->has('numero'))
                                        <span class="error text-danger" for="input-numero">{{$errors -> first('numero')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label for="id_tecnologia" class="col-sm-2 col-form-label">Tecnología</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <select class="form-control" data-style="btn btn-link" id="exampleFormControlSelect1" name="id_tecnologia" required oninvalid="this.setCustomValidity('Seleccione tecnología')" oninput="this.setCustomValidity('')"/>
                                            <option disabled selected value="">Seleccione Tecnología</option>
                                        @foreach ( $tecnologias as $tecnologia )
                                            <option value="{{ $tecnologia->id }}" >{{ $tecnologia->nombre_tec }}</option>
                                        @endforeach
                                        </select>
                                      </div>
                                </div>
                            </div>
                            <div class="row">
                                <label for="id_slotec" class="col-sm-2 col-form-label">Slots de Tecnología</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <select class="form-control" data-style="btn btn-link" id="exampleFormControlSelect1" name="id_slotec" required oninvalid="this.setCustomValidity('Seleccione tecnología')" oninput="this.setCustomValidity('')"/>
                                            <option disabled selected value="">Seleccione Tecnología</option>
                                        @foreach ( $slotstec as $slotec )
                                            <option value="{{ $slotec->id }}" >{{ $slotec->slots }} - {{ $slotec->tecnologia->nombre_tec}}</option>
                                        @endforeach
                                        </select>
                                      </div>
                                </div>
                            </div>
                            <div class="row">
                                <label for="id_ubicacion" class="col-sm-2 col-form-label">Sitio</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <select class="form-control micoso" data-style="btn btn-link" id="micoso" name="id_ubicacion">
                                        @foreach ( $sitio as $sitio )
                                            <option value="{{ $sitio->id }}">{{ $sitio->nombre }} - {{ $sitio->abreviacion}}</option>
                                        @endforeach
                                        </select>
                                      </div>
                                </div>
                            </div>
                            <div class="row">
                                <label for="direccion" class="col-sm-2 col-form-label">Direccion</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="direccion" placeholder="Ingrese dirección" value="{{old('direccion')}}">
                                    @if ($errors->has('direccion'))
                                        <span class="error text-danger" for="input-direccion">{{$errors -> first('direccion')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label for="link_gmaps" class="col-sm-2 col-form-label">Link GMaps</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="link_gmaps" placeholder="Link a Google Maps" value="{{old('link_gmaps')}}">
                                    @if ($errors->has('link_gmaps'))
                                        <span class="error text-danger" for="input-link_gmaps">{{$errors -> first('link_gmaps')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label for="sitio_fca" class="col-sm-2 col-form-label">Sitio FCA</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="sitio_fca" placeholder="Ingrese Sitio FCA" value="{{old('sitio_fca')}}">
                                    @if ($errors->has('sitio_fca'))
                                        <span class="error text-danger" for="input-sitio_fca">{{$errors -> first('sitio_fca')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label for="descripcion_sitio" class="col-sm-2 col-form-label">Descripcion Sitio FCA</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="descripcion_sitio" placeholder="Descripción" value="{{old('descripcion_sitio')}}">
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
                <script>
                    $("#micoso").select2({
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
</div>


@endsection

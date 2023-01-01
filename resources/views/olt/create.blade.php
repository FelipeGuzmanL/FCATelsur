@extends('layouts.app', ['activePage' => 'equiposmsan', 'titlePage' => 'Guardar Equipo MSAN'])
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form action="{{route('equiposmsan.slots.olt.store', [$equipo,$slot])}}" method="post" class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-tittle">Guardar OLT {{$slot->slot_msan}}</h4>
                            <p class="card-category">Ingresar datos</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 text-right">
                                    <a href="{{ url()->previous() }}" class="btn btn-primary"><i class="material-icons">arrow_back</i></a>
                                </div>
                            </div>
                            <div class="row">
                                <label for="olt" class="col-sm-2 col-form-label">OLT</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="olt" placeholder="Numero OLT" value="{{old('olt')}}">
                                    @if ($errors->has('olt'))
                                        <span class="error text-danger" for="input-olt">{{$errors -> first('olt')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                            <label for="sitio_fca" class="col-sm-2 col-form-label">Sitio FCA</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="sitio_fca" placeholder="Sitio FCA" value="{{old('sitio_fca')}}" autofocus required oninvalid="this.setCustomValidity('Ingrese ID de licitación')" oninput="this.setCustomValidity('')"/>
                                    @if ($errors->has('sitio_fca'))
                                        <span class="error text-danger" for="input-sitio_fca">{{$errors -> first('sitio_fca')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label for="spl" class="col-sm-2 col-form-label">SPL</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="spl" placeholder="Spliter" value="{{old('spl')}}">
                                    @if ($errors->has('spl'))
                                        <span class="error text-danger" for="input-spl">{{$errors -> first('spl')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label for="descripcion_fca" class="col-sm-2 col-form-label">Descripción Sitio</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="descripcion_fca" placeholder="Descripción sitio FCA" value="{{old('descripcion_fca')}}">
                                    @if ($errors->has('descripcion_fca'))
                                        <span class="error text-danger" for="input-descripcion_fca">{{$errors -> first('descripcion_fca')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label for="nombre_cable" class="col-sm-2 col-form-label">Cable</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="nombre_cable" placeholder="Numero Cable" value="{{old('nombre_cable')}}">
                                    @if ($errors->has('nombre_cable'))
                                        <span class="error text-danger" for="input-nombre_cable">{{$errors -> first('nombre_cable')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label for="id_estado" class="col-sm-2 col-form-label">Estado</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <select class="form-control " data-style="btn btn-link" id="exampleFormControlSelect1" name="id_estado">
                                        @foreach ( $estado as $est )
                                            <option value="{{ $est->id }}">{{ $est->estado }}</option>
                                        @endforeach
                                        </select>
                                      </div>
                                </div>
                            </div>
                            <div class="row">
                                <label for="filam" class="col-sm-2 col-form-label">Filam</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="filam" placeholder="Filamento" value="{{old('filam')}}">
                                    @if ($errors->has('filam'))
                                        <span class="error text-danger" for="input-filam">{{$errors -> first('filam')}}</span>
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

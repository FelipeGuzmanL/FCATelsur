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
                            <!--div class="row">
                                <label for="olt" class="col-sm-2 col-form-label">OLT</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="olt" placeholder="Numero OLT" value="{{old('olt')}}" required oninvalid="this.setCustomValidity('Ingrese el numero OLT')" oninput="this.setCustomValidity('')">
                                    @if ($errors->has('olt'))
                                        <span class="error text-danger" for="input-olt">{{$errors -> first('olt')}}</span>
                                    @endif
                                </div>
                            </div-->
                            <div class="row">
                                <label for="id_cable" class="col-sm-2 col-form-label">Cable</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <select class="form-control micoso" data-style="btn btn-link" id="micoso" name="id_cable">
                                        @foreach ( $cables as $cable )
                                            @if ($cable->id == "1")
                                                <option value="{{ $cable->id }}">{{ $cable->nombre_cable }}</option>
                                            @elseif ($cable->id > "1")
                                                <option value="{{ $cable->id }}">{{ $cable->nombre_cable }} - {{ $cable->sitio->abreviacion }}</option>
                                            @endif
                                        @endforeach
                                        </select>
                                      </div>
                                </div>
                            </div>
                            <!--div class="row">
                                <label for="filam" class="col-sm-2 col-form-label">Filam</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="filam" placeholder="Filamento" value="{{old('filam')}}">
                                    @if ($errors->has('filam'))
                                        <span class="error text-danger" for="input-filam">{{$errors -> first('filam')}}</span>
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
                            <label for="sitio_fca" class="col-sm-2 col-form-label">Sitio FCA</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="sitio_fca" placeholder="Sitio FCA" value="{{old('sitio_fca')}}">
                                    @if ($errors->has('sitio_fca'))
                                        <span class="error text-danger" for="input-sitio_fca">{{$errors -> first('sitio_fca')}}</span>
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
                            </div-->
                            <div class="row">
                                <label for="id_slotec" class="col-sm-2 col-form-label">Slots de Tecnología</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <select class="form-control" data-style="btn btn-link" id="micoso2" name="id_slotec" required oninvalid="this.setCustomValidity('Seleccione tecnología')" oninput="this.setCustomValidity('')"/>
                                            <option disabled selected value="">Seleccione Tecnología</option>
                                        @foreach ( $slotstec as $slotec )
                                            <option value="{{ $slotec->slots }}" >{{ $slotec->slots}} - {{ $slotec->tecnologia->nombre_tec}}</option>
                                        @endforeach
                                        </select>
                                      </div>
                                </div>
                            </div>
                            <div class="row">
                                <label for="id_estado" class="col-sm-2 col-form-label">Estado</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <select class="form-control " data-style="btn btn-link" id="micoso3" name="id_estado">
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
                <script>
                    $("#micoso").select2({
                    });
                </script>
                <script>
                    $("#micoso2").select2({
                    });
                </script>
                <script>
                    $("#micoso3").select2({
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

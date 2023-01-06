@extends('layouts.app', ['activePage' => 'cable', 'titlePage' => 'Guardar Cable'])
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form action="{{route('cable.detallecable.store', $cable->id)}}" method="post" class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-tittle">Guardar Cable</h4>
                            <p class="card-category">Ingresar datos de Cable</p>
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
                                    <input type="text" class="form-control" name="nombre_cable" placeholder="Nombre cable" value="{{old('nombre_cable')}}" required oninvalid="this.setCustomValidity('Ingrese Nombre del Cable')" oninput="this.setCustomValidity('')"/>
                                    @if ($errors->has('nombre_cable'))
                                        <span class="error text-danger" for="input-nombre_cable">{{$errors -> first('nombre_cable')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label for="id_sitio" class="col-sm-2 col-form-label">Sitio</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <select class="form-control sitios" data-style="btn btn-link" id="sitios" name="id_sitio">
                                        @foreach ( $estado as $est )
                                            <option value="{{ $est->id }}">{{ $est->estado }}</option>
                                        @endforeach
                                        </select>
                                      </div>
                                </div>
                            </div>
                            <div class="row">
                            <label for="cant_filam" class="col-sm-2 col-form-label">Cantidad Filamentos</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="cant_filam" placeholder="Cantidad" value="{{old('cant_filam')}}">
                                    @if ($errors->has('cant_filam'))
                                        <span class="error text-danger" for="input-cant_filam">{{$errors -> first('cant_filam')}}</span>
                                    @endif
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

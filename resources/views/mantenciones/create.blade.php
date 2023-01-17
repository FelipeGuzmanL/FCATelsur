@extends('layouts.app', ['activePage' => 'mantenciones', 'titlePage' => 'Crear mantención equipo MSAN'])
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form action="{{route('mantenciones.store')}}" method="post" class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-tittle">Crear mantención MSAN</h4>
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
                                    <input type="number" class="form-control" name="numero" placeholder="Numero MSAN" value="{{old('numero')}}" autofocus required oninvalid="this.setCustomValidity('Ingrese numero del MSAN')" oninput="this.setCustomValidity('')"/>
                                    @if ($errors->has('numero'))
                                        <span class="error text-danger" for="input-numero">{{$errors -> first('numero')}}</span>
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
                <script>
                    $("#micoso2").select2({
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

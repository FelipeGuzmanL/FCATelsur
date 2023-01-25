
@extends('layouts.app', ['activePage' => 'cable', 'titlePage' => 'Generar Alerta en Filamento'])
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form action="{{route('cables.store_cable', $detalles)}}" method="post" class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-tittle">Cable {{$detalles->cable->nombre_cable}} Filamento: {{ $detalles->filamento}}</h4>
                            <p class="card-category">Actualizar datos</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 text-right">
                                    <a href="{{ url()->previous() }}" class="btn btn-primary"><i class="material-icons">arrow_back</i></a>
                                </div>
                            </div>
                            <div class="row">
                                <label for="observacion" class="col-sm-2 col-form-label">Observación</label>
                                <div class="col-sm-7">
                                    <textarea class="form-control" name="observacion" rows="10" placeholder="Observaciones sobre la alerta" required oninvalid="this.setCustomValidity('Ingrese una observación sobre la alerta')" oninput="this.setCustomValidity('')"/>{{ old('descrpcion')}}</textarea>
                                    @if ($errors->has('observacion'))
                                        <span class="error text-danger" for="input-observacion">{{$errors -> first('observacion')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label for="id_gravedad" class="col-sm-2 col-form-label">Gravedad</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <select class="form-control micoso" data-style="btn btn-link" id="micoso" name="id_gravedad" required oninvalid="this.setCustomValidity('Seleccione la gravedad de la alerta')" oninput="this.setCustomValidity('')">
                                            <option disabled selected value="">Seleccione Gravedad de la Alerta</option>
                                        @foreach ( $gravedad as $grave )
                                                <option value="{{ $grave->id }}">{{ $grave->gravedad }}</option>
                                        @endforeach
                                        </select>
                                      </div>
                                </div>
                            </div>
                        <div class="card-footer ml-auto mr-auto">
                            <button type="submit" class="btn btn-warning">{{ __('Generar Alerta') }}</button>
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

@extends('layouts.app', ['activePage' => 'etiquetas', 'titlePage' => 'Guardar Sitio'])
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form action="{{route('etiquetas.store')}}" method="post" class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-tittle">Guardar Etiqueta</h4>
                            <p class="card-category">Ingresar datos</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 text-right">
                                    <a href="{{ url()->previous() }}" class="btn btn-primary"><i class="material-icons">arrow_back</i></a>
                                </div>
                            </div>
                            @if (session('danger'))
                                <div class="alert alert-danger" role="danger">
                                    {{ session('danger') }}
                                </div>
                            @endif
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
                            <div class="row">
                            <label for="filam" class="col-sm-2 col-form-label">Filamento</label>
                                <div class="col-sm-7">
                                    <input type="number" class="form-control" name="filam" placeholder="N° Filamento" value="{{old('filam')}}" autofocus required oninvalid="this.setCustomValidity('Ingrese N° de filamento')" oninput="this.setCustomValidity('')"/>
                                    @if ($errors->has('filam'))
                                        <span class="error text-danger" for="input-filam">{{$errors -> first('filam')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label for="etiqueta" class="col-sm-2 col-form-label">Etiqueta</label>
                                <div class="col-sm-7">
                                    <textarea class="form-control" name="etiqueta" rows="3" placeholder="Etiqueta del filamento" value="{{old('etiqueta')}}"></textarea>
                                    @if ($errors->has('etiqueta'))
                                        <span class="error text-danger" for="input-etiqueta">{{$errors -> first('etiqueta')}}</span>
                                    @endif
                                </div>
                            </div>
                        <div class="card-footer ml-auto mr-auto">
                            <button type="submit" class="btn btn-primary">{{ __('Guardar') }}</button>
                        </div>
                    </div>
                    <script>
                        $("#micoso").select2({
                        });
                    </script>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection

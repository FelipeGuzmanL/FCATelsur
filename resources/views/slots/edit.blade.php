@extends('layouts.app', ['activePage' => 'sitios', 'titlePage' => 'Actualizar Slot'])
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form action="{{route('equiposmsan.slots.update', [$equipo, $slot])}}" method="post" class="form-horizontal">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-tittle">Slot {{ $slot->slot_msan}}</h4>
                            <p class="card-category">Actualizar datos</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 text-right">
                                    <a href="{{ url()->previous() }}" class="btn btn-primary"><i class="material-icons">arrow_back</i></a>
                                </div>
                            </div>
                            <div class="row">
                                <label for="slot_msan" class="col-sm-2 col-form-label">Slot MSAN</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" name="slot_msan" placeholder="Slot MSAN" value="{{old('slot_msan',$slot->slot_msan)}}" autofocus required oninvalid="this.setCustomValidity('Ingrese Slot MSAN')" oninput="this.setCustomValidity('')"/>
                                        @if ($errors->has('slot_msan'))
                                            <span class="error text-danger" for="input-slot_msan">{{$errors -> first('slot_msan')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="id_estado" class="col-sm-2 col-form-label">Estado</label>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <select class="form-control" data-style="btn btn-link" id="micoso" name="id_estado">
                                            @foreach ( $estado as $est )
                                                <option value="{{ $est->id }}" {{$slot->id_estado == $est->id ? 'selected' : ''}}>{{ $est->estado }}</option>
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

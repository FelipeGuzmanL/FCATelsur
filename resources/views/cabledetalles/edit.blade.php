@extends('layouts.app', ['activePage' => 'cable', 'titlePage' => 'Detalles del Cable'])
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form action="{{route('cable.detallecable.update', ['cable'=>$cable,'detallecable'=>$detalles])}}" method="post" class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-tittle">Actualizar Datos del Cable {{ $cable->sitio->abreviacion}} {{ $cable->nombre_cable}} FILAM: {{ $detalles->filamento}}</h4>
                            <p class="card-category">Ingresar datos del Cable {{ $cable->sitio->abreviacion }} {{ $cable->nombre_cable}} FILAM: {{ $detalles->filamento}}</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 text-right">
                                    <a href="{{ route('cables.index_cable', $detalles)}}" class="btn btn-warning">Generar Alerta</a>
                                    <a href="{{ url()->previous() }}" class="btn btn-primary"><i class="material-icons">arrow_back</i></a>
                                </div>
                            </div>
                            <div class="row">
                                <label for="direccion" class="col-sm-2 col-form-label">DIR</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="direccion" placeholder="DIR del filamento" value="{{old('direccion', $detalles->direccion)}}">
                                    @if ($errors->has('direccion'))
                                        <span class="error text-danger" for="input-direccion">{{$errors -> first('direccion')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label for="servicio" class="col-sm-2 col-form-label">Servicios</label>
                                <div class="col-sm-7">
                                    @if ($detalles->ocupacion == NULL)
                                        <input type="text" class="form-control" name="servicio" placeholder="Servicios" value="{{old('servicio', $detalles->servicio)}}">
                                    @endif
                                    @if ($detalles->ocupacion != NULL)
                                        <input type="text" class="form-control" name="servicio" placeholder="Servicios" value="{{old('servicio', $detalles->ocupacion)}}" readonly>
                                    @endif
                                    @if ($errors->has('servicio'))
                                        <span class="error text-danger" for="input-servicio">{{$errors -> first('servicio')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label for="longitud" class="col-sm-2 col-form-label">Longitud filamento</label>
                                <div class="col-sm-7">
                                    <input type="number" class="form-control" name="longitud" placeholder="Longitud en Metros (ej: 8000, 5000, 200)" value="{{old('longitud', $detalles->longitud)}}">
                                    @if ($errors->has('longitud'))
                                        <span class="error text-danger" for="input-longitud">{{$errors -> first('longitud')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label for="id_cable" class="col-sm-2 col-form-label">Cruzada 1</label>
                                <label for="id_cable" class="col-sm-1 col-form-label">Cable</label>
                                <div class="col-sm-6 col-md-2">
                                    <div class="form-group">
                                        <select class="form-control sitios" data-style="btn btn-link" id="sitios" name="id_cable">
                                            @foreach ($cables as $cable)
                                            @if ($cable->id == "1")
                                                <option value="{{ $cable->id }}" >{{ $cable->nombre_cable }}</option>
                                            @elseif ($cable->id > "1")
                                            @if ($detalles->cruzada1Fil1 != NULL)
                                                <option value="{{ $cable->id }}" {{$detalles->cruzada1Fil1->detalleFil2->id_cable == $cable->id ? 'selected' : ''}}>{{ $cable->nombre_cable }} - {{ $cable->sitio->abreviacion }} - {{ $cable->tipocable->tipo}}</option>
                                            @else
                                                <option value="{{ $cable->id }}" >{{ $cable->nombre_cable }} - {{ $cable->sitio->abreviacion }} - {{ $cable->tipocable->tipo}}</option>
                                            @endif
                                            @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <label for="id_filamento" class="col-sm-1 col-form-label">Filamento</label>
                                <div class="col-sm-6 col-md-3">
                                    <div class="form-group">
                                        <select class="form-control sitios" data-style="btn btn-link" id="sitios2" name="id_filamento">
                                            <option value="0">Sin Filamento</option>
                                            @foreach ($filamentos as $detalle)
                                                @if ($detalles->cruzada1Fil1 != NULL)
                                                    <option value="{{ $detalle->id }}" data-cable="{{ $detalle->id_cable }}" {{$detalles->cruzada1Fil1->id_fil2 == $detalle->id ? 'selected' : ''}}>
                                                        {{ $detalle->filamento }} - {{ $detalle->servicio}}
                                                    </option>
                                                @else
                                                    <option value="{{ $detalle->id }}" data-cable="{{ $detalle->id_cable }}">
                                                        {{ $detalle->filamento }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label for="id_cable2" class="col-sm-2 col-form-label">Cruzada 2</label>
                                <label for="id_cable2" class="col-sm-1 col-form-label">Cable</label>
                                <div class="col-sm-6 col-md-2">
                                    <div class="form-group">
                                        <select class="form-control sitios" data-style="btn btn-link" id="sitios3" name="id_cable2">
                                            @foreach ($cables as $cable)
                                            @if ($cable->id == "1")
                                                <option value="{{ $cable->id }}" >{{ $cable->nombre_cable }}</option>
                                            @elseif ($cable->id > "1")
                                                @if ($detalles->cruzada1Fil2 != NULL)
                                                    <option value="{{ $cable->id }}" {{$detalles->cruzada1Fil2->detalleFil1->id_cable == $cable->id ? 'selected' : ''}}>{{ $cable->nombre_cable }} - {{ $cable->sitio->abreviacion }} - {{ $cable->tipocable->tipo}}</option>
                                                @else
                                                    <option value="{{ $cable->id }}" >{{ $cable->nombre_cable }} - {{ $cable->sitio->abreviacion }} - {{ $cable->tipocable->tipo}}</option>
                                                @endif
                                            @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <label for="id_filamento2" class="col-sm-1 col-form-label">Filamento</label>
                                <div class="col-sm-6 col-md-3">
                                    <div class="form-group">
                                        <select class="form-control sitios" data-style="btn btn-link" id="sitios4" name="id_filamento2">
                                            <option value="0">Sin Filamento</option>
                                            @foreach ($filamentos2 as $detalle)
                                                @if ($detalles->cruzada1Fil2 != NULL)
                                                    <option value="{{ $detalle->id }}" data-cable="{{ $detalle->id_cable }}" {{$detalles->cruzada1Fil2->id_fil1 == $detalle->id ? 'selected' : ''}}>
                                                        {{ $detalle->filamento }}
                                                    </option>
                                                @else
                                                    <option value="{{ $detalle->id }}" data-cable="{{ $detalle->id_cable }}" >
                                                        {{ $detalle->filamento }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label for="observaciones" class="col-sm-2 col-form-label">Observaciones</label>
                                <div class="col-sm-7">
                                    <textarea class="form-control" name="observaciones" rows="3" placeholder="Observaciones">{{old('observaciones', $detalles->observaciones)}}</textarea>
                                    @if ($errors->has('observaciones'))
                                        <span class="error text-danger" for="input-observaciones">{{$errors -> first('observaciones')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label for="gmaps" class="col-sm-2 col-form-label">Link GMaps</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="gmaps" placeholder="Link Ubicación en GMaps (opcional)" value="{{old('gmaps', $detalles->gmaps)}}">
                                    @if ($errors->has('gmaps'))
                                        <span class="error text-danger" for="input-gmaps">{{$errors -> first('gmaps')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label for="id_estado" class="col-sm-2 col-form-label">Estado</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <select class="form-control sitios" data-style="btn btn-link" id="sitios" name="id_estado">
                                        @foreach ( $estado as $est )
                                            <option value="{{ $est->id }}" {{$detalles->id_estado == $est->id ? 'selected' : ''}}>{{ $est->estado }}</option>
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
            </div>
            <div id="cableStatus"></div>
            <script>
                /*document.addEventListener('DOMContentLoaded', function() {
                    const selectCable = document.getElementById('sitios');

                    selectCable.addEventListener('change', function() {
                        const selectedCableId = selectCable.value;

                        fetch(`/consulta-cable/${selectedCableId}`)
                            .then(response => response.json())
                            .then(data => {
                                const cableStatus = data.hasFilamentos ? 'Tiene filamentos' : 'No tiene filamentos';
                                document.getElementById('cableStatus').textContent = cableStatus;
                            })
                            .catch(error => {
                                console.error('Error al realizar la consulta:', error);
                            });
                    });

                    selectCable.dispatchEvent(new Event('change'));
                });*/
            </script>
            <script>
                $(document).ready(function() {
                    $("#sitios").select2();
                    $("#sitios2").select2();
                    $("#sitios3").select2();
                    $("#sitios4").select2();
                    $("#tipocables").select2();

                    // Obtener los valores de filamentos previamente seleccionados
                    var selectedFilamentoId1 = {{ $detalles->cruzadaFil1->id_fil1 ?? 'null' }};
                    var selectedFilamentoId2 = {{ $detalles->cruzadaFil1->id_fil2 ?? 'null' }};

                    // Función para cargar los filamentos en un selector y mantener la selección
                    function loadFilamentosAndSelect(cableId, selectId, selectedFilamentoId) {
                        $.ajax({
                            url: "{{ route('cable.detallecable.getfilamentosbycable') }}",
                            method: "GET",
                            data: { cable_id: cableId },
                            success: function (response) {
                                $(selectId).empty();
                                $.each(response, function (index, filamento) {
                                    $(selectId).append($('<option>', {
                                        value: parseInt(filamento.id),
                                        text: filamento.text
                                    }));
                                });

                                // Habilitar o deshabilitar el select según si hay opciones disponibles
                                if (cableId === "1") {
                                    $(selectId).prop('disabled', true);
                                } else {
                                    $(selectId).prop('disabled', false);
                                }

                                // Seleccionar el filamento previamente seleccionado
                                if (selectedFilamentoId) {
                                    $(selectId).val(selectedFilamentoId).trigger('change');
                                }
                            },
                            error: function () {
                                // Manejar errores si es necesario
                            }
                        });
                    }

                    // Cargar los selectores de filamentos al cargar la página
                    //loadFilamentosAndSelect($("#sitios").val(), '#sitios2', selectedFilamentoId1);
                    //loadFilamentosAndSelect($("#sitios3").val(), '#sitios4', selectedFilamentoId2);

                    // Manejar cambios en los selectores de cables
                    $('#sitios').on('change', function () {
                        var cableId = $(this).val();
                        loadFilamentosAndSelect(cableId, '#sitios2', selectedFilamentoId1);
                    });

                    $('#sitios3').on('change', function () {
                        var cableId = $(this).val();
                        loadFilamentosAndSelect(cableId, '#sitios4', selectedFilamentoId2);
                    });
                });
            </script>
        </div>
    </div>
</div>


@endsection

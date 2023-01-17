@extends('layouts.app', ['activePage' => 'mantenciones', 'titlePage' => 'Crear mantención equipo MSAN'])
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form action="{{route('equiposmsan.mantencionesmsan.store', [$equipo])}}" method="post" class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h5 class="card-tittle">Crear mantención del MSAN {{ $equipo->Ubicacion->ciudad->abreviacion }} {{ $equipo->numero }}</h5>
                            <p class="card-category">Ingresar datos</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 text-right">
                                    <a href="{{ url()->previous() }}" class="btn btn-primary"><i class="material-icons">arrow_back</i></a> 
                                </div>
                            </div>
                            <div class="row">
                                <label for="numero_ticket" class="col-sm-2 col-form-label">Numero Ticket</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="numero_ticket" placeholder="Numero ticket de mantención" value="{{old('numero_ticket')}}" autofocus required oninvalid="this.setCustomValidity('Ingrese ticket de la mantención')" oninput="this.setCustomValidity('')"/>
                                        @if ($errors->has('numero_ticket'))
                                            <span class="error text-danger" for="input-numero_ticket">{{$errors -> first('numero_ticket')}}</span>
                                        @endif
                                    </div>
                                </div>
                            <div class="row">
                                <label for="fecha_mantencion" class="col-sm-2 col-form-label">Fecha de la Mantención</label>
                                <div class="col-sm-8">
                                    <input type="date" class="form-control" name="fecha_mantencion">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <h5 for="comprobacion_1" class="col-sm-8">1. Comprobar tarjetas energia insertadas en las ranuras correspondientes y comprobar si hay alarmas.</h5>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <select class="form-control" data-style="btn btn-link" id="micoso2" name="comprobacion_1">
                                        <option disabled selected value="">Seleccione comprobación</option>
                                        @foreach ( $comprobacion as $comprobar )
                                            <option value="{{ $comprobar->comprobar }}" >{{ $comprobar->comprobar }}</option>
                                        @endforeach
                                        </select>
                                    </div>  
                                </div>
                            </div>
                            <div class="row">
                                <h5 for="comprobacion_2" class="col-sm-8">2. Compruebe si los cables de conexión a tierra del gabinete, pdp y bastidores estan firmemente apretados.</h5>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <select class="form-control" data-style="btn btn-link" id="micoso" name="comprobacion_2">
                                        <option disabled selected value="">Seleccione comprobación</option>
                                        @foreach ( $comprobacion as $comprobar )
                                            <option value="{{ $comprobar->comprobar }}" >{{ $comprobar->comprobar }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <h5 for="comprobacion_3" class="col-sm-8">3. Compruebe si hay corrosión en las terminaciones de los cables y que los alambres de cobre no estén expuestos.</h5>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <select class="form-control" data-style="btn btn-link" id="micoso3" name="comprobacion_3">
                                        <option disabled selected value="">Seleccione comprobación</option>
                                        @foreach ( $comprobacion as $comprobar )
                                            <option value="{{ $comprobar->comprobar }}" >{{ $comprobar->comprobar }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <h5 for="comprobacion_4" class="col-sm-8">4. Compruebe que la temperatura de la sala de equipos está en el rango de 10°-30°C. Humedad relativa recomendada entre 20% a 85%.</h5>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <select class="form-control" data-style="btn btn-link" id="micoso4" name="comprobacion_4">
                                        <option disabled selected value="">Seleccione comprobación</option>
                                        @foreach ( $comprobacion as $comprobar )
                                            <option value="{{ $comprobar->comprobar }}" >{{ $comprobar->comprobar }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <h5 for="comprobacion_5" class="col-sm-8">5. Compruebe filtros de aire, filtro ubicado en parte inferior de OLT. Limpiar y extraer polvo.</h5>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <select class="form-control" data-style="btn btn-link" id="micoso5" name="comprobacion_5">
                                        <option disabled selected value="">Seleccione comprobación</option>
                                        @foreach ( $comprobacion as $comprobar )
                                            <option value="{{ $comprobar->comprobar }}" >{{ $comprobar->comprobar }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <h5 for="comprobacion_6" class="col-sm-8">6. Verificar que no hay objetos que bloquean la entrada y salida de aure del equipo. La entrada de aire de la OLT es de abajo hacia arriba.</h5>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <select class="form-control" data-style="btn btn-link" id="micoso6" name="comprobacion_6">
                                        <option disabled selected value="">Seleccione comprobación</option>
                                        @foreach ( $comprobacion as $comprobar )
                                            <option value="{{ $comprobar->comprobar }}" >{{ $comprobar->comprobar }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <h5 for="comprobacion_7" class="col-sm-8">7. Comprobar que SLOTS vacios se instalan con paneles ficticios. Verificar que SLOT no utilizados esten con tapas para evitar ingreso de polvo.</h5>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <select class="form-control" data-style="btn btn-link" id="micoso7" name="comprobacion_7">
                                        <option disabled selected value="">Seleccione comprobación</option>
                                        @foreach ( $comprobacion as $comprobar )
                                            <option value="{{ $comprobar->comprobar }}" >{{ $comprobar->comprobar }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <h5 for="comprobacion_8" class="col-sm-8">8. Compruebe si los tornillos o los botones de la unidad de ventilación están bien cerradas.</h5>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <select class="form-control" data-style="btn btn-link" id="micoso8" name="comprobacion_8">
                                        <option disabled selected value="">Seleccione comprobación</option>
                                        @foreach ( $comprobacion as $comprobar )
                                            <option value="{{ $comprobar->comprobar }}" >{{ $comprobar->comprobar }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <h5 for="comprobacion_9" class="col-sm-8">9. En el panel de la unidad de ventilación. El LED verde <strong>ACT</strong> debe estar encendido y el LED <strong>ALM</strong> apagado.</h5>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <select class="form-control" data-style="btn btn-link" id="micoso9" name="comprobacion_9">
                                        <option disabled selected value="">Seleccione comprobación</option>
                                        @foreach ( $comprobacion as $comprobar )
                                            <option value="{{ $comprobar->comprobar }}" >{{ $comprobar->comprobar }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <h5 for="comprobacion_10" class="col-sm-8">10. El extractor de fibra óptica debe ser instalado vertucal en la parte lateral del borde del gabinete y colgado alrededor de 1.5MTS. del suelo. Utilizar para la correcta manipulación de fibra óptica.</h5>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <select class="form-control" data-style="btn btn-link" id="micoso10" name="comprobacion_10">
                                        <option disabled selected value="">Seleccione comprobación</option>
                                        @foreach ( $comprobacion as $comprobar )
                                            <option value="{{ $comprobar->comprobar }}" >{{ $comprobar->comprobar }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <h5 for="comprobacion_11" class="col-sm-8">11. Suficiente espacio de instalación debe ser reservado en la parte superior inferior de los bastidores del equipo. (Recomendado 3U). Instalación cerca del equipo en la parte superior e inferior está prohibido.</h5>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <select class="form-control" data-style="btn btn-link" id="micoso11" name="comprobacion_11">
                                        <option disabled selected value="">Seleccione comprobación</option>
                                        @foreach ( $comprobacion as $comprobar )
                                            <option value="{{ $comprobar->comprobar }}" >{{ $comprobar->comprobar }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label for="observaciones" class="col-sm-2 col-form-label">Observaciones</label>
                                <div class="col-sm-8">
                                    <textarea class="form-control" name="observaciones" rows="3" placeholder="Observaciones de la mantención" value="{{old('observaciones')}}"></textarea>
                                    @if ($errors->has('observaciones'))
                                        <span class="error text-danger" for="input-observaciones">{{$errors -> first('observaciones')}}</span>
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
                <script>
                    $("#micoso3").select2({
                    });
                </script>
                <script>
                    $("#micoso4").select2({
                    });
                </script>
                <script>
                    $("#micoso5").select2({
                    });
                </script>
                <script>
                    $("#micoso6").select2({
                    });
                </script>
                <script>
                    $("#micoso7").select2({
                    });
                </script>
                <script>
                    $("#micoso8").select2({
                    });
                </script>
                <script>
                    $("#micoso9").select2({
                    });
                </script>
                <script>
                    $("#micoso10").select2({
                    });
                </script>
                <script>
                    $("#micoso11").select2({
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

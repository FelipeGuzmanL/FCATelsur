@extends('layouts.app', ['activePage' => 'equiposmsan', 'titlePage' => 'Lista de OLT MSAN'])
@section('content')
    <div class="content">
        <div class="container-fuid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header card-header-primary">
                                    <h4 class="card-tittle">Lista de OLT {{$slot->equiposmsan->Ubicacion->ciudad->abreviacion}} {{ $slot->slot_msan}}</h4>
                                    <div class="row">
                                        <div class="col-7 text-right d-felx">
                                            <form action="{{route('equiposmsan.slots.olt.index', [$equipo,$slot])}}" method="get">
                                                <div class="form-row">
                                                    <div class="col-sm-4 align-self-center" style="text-align: right">
                                                        <input type="text" class="form-control float-right" name="texto" value="{{$texto ?? ''}}" placeholder="Buscar...">
                                                    </div>
                                                    <div class="col-auto align-self-center">
                                                        <input type="submit" class="btn btn-primary float-right" value="Buscar">
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <p class="card-category">Datos de OLT {{$slot->equiposmsan->Ubicacion->ciudad->abreviacion}} {{$slot->slot_msan}}</p>
                                </div>
                                <div class="card-body">
                                    @if (session('success'))
                                        <div class="alert alert-success" role="success">
                                            {{ session('success') }}
                                        </div>
                                    @endif
                                    @if (session('warning'))
                                        <div class="alert alert-warning" role="warning">
                                            {{ session('warning') }}
                                        </div>
                                    @endif
                                    @if (session('failure'))
                                        <div class="alert alert-danger" role="failure">
                                            {{ session('failure') }}
                                        </div>
                                    @endif
                                    <div class="row">
                                        <div class="col-12 text-right">
                                            <a href="{{ route('equiposmsan.slots.olt.create', [$equipo,$slot]) }}" class="btn btn-primary">Generar OLTs</a>
                                            <a href="{{ route('equiposmsan.slots.index', $equipo->id) }}" class="btn btn-primary"><i class="material-icons">arrow_back</i></a>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="text-primary">
                                                <th>OLT</th>
                                                <th>Sitio FCA</th>
                                                <th>SPL</th>
                                                <th>Descripción Sitio</th>
                                                <th>Cable</th>
                                                <th>Filam</th>
                                                <th>Estado</th>
                                                <th>Fecha Modificación</th>
                                                <th class="text-right">Acciones</th>
                                            </thead>
                                            <tbody>
                                            @if (count($olts)<=0)
                                                <div class="alert alert-danger" style="text-align:center" role="alert">
                                                    <h4>No se han encontrado olt</h4>
                                                </div>
                                            @endif
                                            @foreach ($olts as $olt)
                                                @if ($olt->id_slot == $slot->id)
                                                <tr>
                                                    <td>{{ $olt->olt }}</td>
                                                    <td>{{ $olt->sitio_fca}}</td>
                                                    <td>{{ $olt->spl}}</td>
                                                    <td>{{ $olt->descripcion_fca}}</td>
                                                    @if ($olt->cable->id > "1")
                                                        @php
                                                            $cables = $olt->cable
                                                        @endphp
                                                        <td><a href="{{ route('equiposmsan.slots.olt.cables.index', [$equipo,$slot,$olt,$cables])}}">{{ $olt->cable->nombre_cable}}</a></td>
                                                    @endif
                                                    @if ($olt->cable->id == "1")
                                                        <td></td>
                                                    @endif
                                                    <td>{{ $olt->filam}}</td>
                                                    @if ($olt->estad->id == "1")
                                                        <td class="text-success">{{ $olt->estad->estado}}</td>
                                                    @endif
                                                    @if ($olt->estad->id == "2")
                                                        <td class="text-danger">{{ $olt->estad->estado}}</td>
                                                    @endif
                                                    <td>{{ $olt->updated_at}} <br> por {{ $olt->usuario->name}}</td>
                                                    <td class="td-actions text-right">
                                                        @if($olt->etiquetado == 0 && $olt->sitio_fca && $olt->spl && $olt->filam != NULL)
                                                            <a href="{{ route('olt.crearetiqueta', ['equipo' => $equipo, 'slot' => $slot, 'olt' => $olt]) }}" class="btn btn-success">Crear Etiqueta</a>
                                                        @endif
                                                        @foreach ($olt->cable->etiqueta as $etiqueta)
                                                            @if ($olt->etiquetado == 1 && $olt->id == $etiqueta->id_olt && ($etiqueta->id_cable == $olt->cable->id && $etiqueta->filam == $olt->filam && $etiqueta->spl == $olt->spl && $etiqueta->sitio_fca == $olt->sitio_fca))
                                                                <a href="{{ route('etiquetas.show', $etiqueta->id)}}" class="btn btn-success"><i class="material-icons">confirmation_number</i></a>
                                                            @endif
                                                            @if ($olt->etiquetado == 1 && $olt->id == $etiqueta->id_olt && ($etiqueta->id_cable != $olt->cable->id || $etiqueta->filam != $olt->filam || $etiqueta->spl != $olt->spl || $etiqueta->sitio_fca != $olt->sitio_fca) && ($olt->cable->id && $olt->filam && $olt->spl && $olt->sitio_fca != NULL))
                                                                <a href="{{ route('olt.actualizaretiqueta', ['equipo' => $equipo, 'slot' => $slot, 'olt' => $olt, 'etiquetas'=>$etiqueta->id]) }}" class="btn btn-warning">Actualizar Etiqueta</a>
                                                                @break
                                                            @endif
                                                        @endforeach

                                                        @if ( $olt->link_sitio_fca == NULL)
                                                        @elseif ( $olt->link_sitio_fca != NULL)
                                                            <a href="{{ $olt->link_sitio_fca }}" target="_blank" class="btn btn-success"><i class="material-icons">location_on</i></a>
                                                        @endif
                                                        @if ( $olt->alerta == NULL)
                                                        @elseif ( $olt->alerta != NULL)
                                                            <a href="{{ route('equiposmsan.slots.olt.alertas.show', [$equipo,$slot,$olt,$olt->alerta]) }}" class="btn btn-warning"><i class="material-icons">warning</i></a>
                                                            <form action="{{route('equiposmsan.slots.olt.alertas.destroy', [$equipo,$slot,$olt,$olt->alerta])}}" method="post" style="display: inline-block" onsubmit="return confirm('¿Está seguro de eliminar esta alerta?')">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="btn btn-warning" type="submit" rel="tooltip">
                                                                    <i class="material-icons">close</i>
                                                                </button>
                                                            </form>
                                                        @endif
                                                        <a href="{{ route('equiposmsan.slots.olt.edit', [$equipo,$slot,$olt]) }}" class="btn btn-primary"><i class="material-icons">edit</i></a>
                                                        <form action="{{route('equiposmsan.slots.olt.destroy', [$equipo,$slot,$olt])}}" method="post" style="display: inline-block" onsubmit="return confirm('¿Estás seguro?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger" type="submit" rel="tooltip">
                                                            <i class="material-icons">close</i>
                                                        </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

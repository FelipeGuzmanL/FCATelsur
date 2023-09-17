<!-- resources/views/etiquetas/ejecutar_script.blade.php -->

@extends('layouts.app', ['activePage' => 'etiquetas', 'titlePage' => 'Ejecutar Script'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title">Resultado del Script de Python</h4>
                        </div>
                        <div class="card-body">
                            <pre>{{ $output }}</pre>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

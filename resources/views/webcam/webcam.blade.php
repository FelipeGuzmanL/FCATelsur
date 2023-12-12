<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Webcam Capture</title>
    <!-- Agrega el enlace a Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h1>Escanear etiqueta</h1>
                <h3>Coloque la etiqueta centrada en la imagen, y luego presione "Escanear"</h3>
                <div class="embed-responsive embed-responsive-16by9">
                    <!-- Agrega la clase embed-responsive-item a tu video -->
                    <video id="video" class="embed-responsive-item" autoplay playsinline></video>
                </div>
                <div class="mt-3">
                    <button id="captureButton" class="btn btn-primary" data-csrf="{{ csrf_token() }}">Escanear</button>
                </div>
                <div class="mt-3">
                    <button id="changeCameraButton" class="btn btn-secondary">Cambiar Cámara</button>
                </div>
                <div class="mt-3">
                    <a href="{{ url()->previous() }}" class="btn btn-primary">Volver</a>
                  </div>
                <div class="embed-responsive embed-responsive-16by9">
                    <canvas id="canvas" class="mt-3" width="640" height="480"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ mix('js/app.js') }}"></script>
    <!-- Agrega el enlace a Bootstrap JS y Popper.js -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>

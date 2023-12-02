<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Webcam Capture</title>
</head>
<body>
    <h1>Webcam Capture</h1>
    <video id="video" width="640" height="480" autoplay></video>
    <button id="captureButton">Capturar Foto</button>
    <button id="changeCameraButton">Cambiar Cámara</button>
    <canvas id="canvas" width="640" height="480"></canvas>

    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>

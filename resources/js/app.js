require('./bootstrap');

document.addEventListener('DOMContentLoaded', function () {
    const video = document.getElementById('video');
    const captureButton = document.getElementById('captureButton');
    const canvas = document.getElementById('canvas');
    const context = canvas.getContext('2d');

    navigator.mediaDevices.getUserMedia({ video: true })
        .then(function (stream) {
            video.srcObject = stream;
        })
        .catch(function (error) {
            console.error('Error al acceder a la webcam: ', error);
        });

    captureButton.addEventListener('click', function () {
        context.drawImage(video, 0, 0, canvas.width, canvas.height);
        const imageDataURL = canvas.toDataURL('image/png');

        // Enviar la imagen al controlador de Laravel
        enviarImagenAlServidor(imageDataURL);
    });

    function enviarImagenAlServidor(imageDataURL) {
        // Realizar una solicitud POST a Laravel
        axios.post('/procesar_imagen', { imagen: imageDataURL })
            .then(response => {
                console.log('Respuesta del servidor:', response.data);
                // Puedes realizar acciones adicionales con la respuesta del servidor aquí
            })
            .catch(error => {
                console.error('Error al enviar la imagen al servidor:', error);
            });
    }
});

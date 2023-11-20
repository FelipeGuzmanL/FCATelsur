import pytesseract as tess
from PIL import Image
import cv2
import requests
import json

# URL de login y API
url_login = 'http://127.0.0.1:8000/login'
url_api_cable = 'http://127.0.0.1:8000/api/cable'
url_visualizacion = 'http://127.0.0.1:8000/api/cable/otra-funcion'

# Realizar la solicitud POST a la URL de login para obtener el token CSRF
response_login = requests.get(url_login)
token_csrf = response_login.cookies.get('XSRF-TOKEN')

# Configurar el comando de Tesseract
tess.pytesseract.tesseract_cmd = r'C:\Program Files\Tesseract-OCR\tesseract.exe'

# Leer la imagen y realizar el procesamiento OCR
image = cv2.imread('C:\\Users\\feli_\\FCATelsur\\test1.jpg')
gris = cv2.cvtColor(image, cv2.COLOR_BGR2GRAY)
umbral = cv2.adaptiveThreshold(gris, 255, cv2.ADAPTIVE_THRESH_GAUSSIAN_C, cv2.THRESH_BINARY, 55, 25)
config = '--psm 1'
texto_extraido = tess.image_to_string(umbral, config=config)

# Crear el diccionario de datos con el resultado del OCR
datos = {'resultados': texto_extraido}

datos_json = json.dumps(datos)

# Configurar las cabeceras con el token CSRF y el tipo de contenido JSON
headers = {'X-CSRF-TOKEN': token_csrf, 'Content-Type': 'application/json'}

# Realizar la solicitud POST a la URL de la API
respuesta = requests.post(url_api_cable, json=datos_json, headers=headers)

#respuesta_visualizacion = requests.get(url_visualizacion)

# Imprimir la respuesta del servidor
#print(respuesta.text)
#print(respuesta_visualizacion.text)
#print(headers)

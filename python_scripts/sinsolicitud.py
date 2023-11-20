import pytesseract as tess
from PIL import Image
import cv2
import requests
import json




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

print(json.dumps(datos), flush=True)

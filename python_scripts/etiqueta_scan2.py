import pytesseract as tess
from PIL import Image
import cv2
import requests

url = 'http://127.0.0.1:8000/api/cable'
url_edit = 'http://127.0.0.1:8000/login'

token = requests.get(url_edit)
token_csrf = token.cookies.get('XSRF-TOKEN')

tess.pytesseract.tesseract_cmd =  r'C:\Program Files\Tesseract-OCR\tesseract.exe'

my_image = cv2.imread('C:\\Users\\feli_\\OneDrive\\Escritorio\\etiquetas.jpeg')
image = cv2.imread('C:\\Users\\feli_\\FCATelsur\\test1.jpg')


tess.pytesseract.tesseract_cmd = r'C:\Program Files\Tesseract-OCR\tesseract.exe'

# Conversión a escala de grises
gris = cv2.cvtColor(image, cv2.COLOR_BGR2GRAY)
# Filtro
umbral = cv2.adaptiveThreshold(gris, 255, cv2.ADAPTIVE_THRESH_GAUSSIAN_C, cv2.THRESH_BINARY, 55, 25)
# Configuración OCR
config = '--psm 1'
texto_extraido = tess.image_to_string(umbral, config=config)
# Procesar palabras clave
print(texto_extraido)

datos = {'resultados': texto_extraido}

headers = {'X-CSRF-TOKEN': token_csrf}
print(headers)

respuesta = requests.post(url, json=datos, headers=headers)
#print(respuesta.text)

#cv2.imshow('imagen', my_image)
#cv2.waitKey(0)
#cv2.destroyAllWindows()

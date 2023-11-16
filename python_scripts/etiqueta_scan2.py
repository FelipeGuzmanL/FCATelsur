import pytesseract as tess
from PIL import Image

tess.pytesseract.tesseract_cmd =  r'C:\Program Files\Tesseract-OCR\tesseract.exe'

my_image = Image.open('C:\\Users\\feli_\\OneDrive\\Imágenes\\Imagenes OCR\\etiqueta1.jpeg')
print(my_image)
text = tess.image_to_alto_xml(my_image)
text2 = tess.image_to_string(my_image)
#my_image.show()
print(text2)

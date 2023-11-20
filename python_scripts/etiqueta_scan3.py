import cv2
from PIL import Image
from pytesseract import pytesseract

cam = cv2.VideoCapture(0)
cam.set(3, 1280)
cam.set(4, 740)

def escanear():
    while True:
        _,image = cam.read()
        cv2.imshow('Text detection', image)
        if cv2.waitKey(1) & 0xFF == ord('s'):
            cv2.imwrite('test1.jpg',image)
            tesseract()
        esc = cv2.waitKey(5)
        if esc == 27:
            break

    cam.release()
    cv2.destroyAllWindows()

def tesseract():
    path_to_tesseract = r"C:\Program Files\Tesseract-OCR\tesseract.exe"
    #Imagepath = 'test1.jpg'

    image = cv2.imread('C:\\Users\\feli_\\FCATelsur\\test1.jpg')
    pytesseract.tesseract_cmd = path_to_tesseract

    gris = cv2.cvtColor(image, cv2.COLOR_BGR2GRAY)
    # Filtro
    umbral = cv2.adaptiveThreshold(gris, 255, cv2.ADAPTIVE_THRESH_GAUSSIAN_C, cv2.THRESH_BINARY, 55, 25)
    # Configuración OCR
    config = '--psm 1'
    text = pytesseract.image_to_string(umbral, config=config, lang='eng')


    #text = pytesseract.image_to_string(Image.open(Imagepath))
    #print(text[:-1])
    palabras = text.split()

    print(palabras)

escanear()

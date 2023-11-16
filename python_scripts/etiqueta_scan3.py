import cv2
from PIL import Image
from pytesseract import pytesseract

cam = cv2.VideoCapture(0)
cam.set(3, 1280)
cam.set(4, 740)

while True:
    _,image = cam.read()
    cv2.imshow('Text detection', image)
    if cv2.waitKey(1) & 0xFF == ord('s'):
        cv2.imwrite('test1.jpg',image)
        break

cam.release()
cv2.destroyAllWindows()

def tesseract():
    path_to_tesseract = r"C:\Program Files\Tesseract-OCR\tesseract.exe"
    Imagepath = 'test1.jpg'
    pytesseract.tesseract_cmd = path_to_tesseract
    text = pytesseract.image_to_string(Image.open(Imagepath))
    print(text[:-1])

tesseract()

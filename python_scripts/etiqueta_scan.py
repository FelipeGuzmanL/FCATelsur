import cv2
import pytesseract
import json

# Variables
cuadro = 100
doc = 0

cap = cv2.VideoCapture(0)
cap.set(3, 1280)
cap.set(4, 740)

def procesar_palabras(texto):
    palabras = texto.split()  # Dividir el texto en palabras
    #print(palabras)
    resultados = []

    i = 0
    while i < len(palabras):
        clave = palabras[i]

        if clave in ['FCA', 'FIL','SPL']:
            if i + 1 < len(palabras):
                resultados.append([clave, palabras[i + 1]])
                i += 2  # Saltar al siguiente conjunto de palabras
            else:
                i += 1  # Saltar solo la palabra clave si no hay suficiente después
        elif clave.startswith('SPL-') and i + 1 < len(palabras):
            spl_partes = clave.split('-')
            numero_partes = spl_partes[1].split('-')[0]  # Tomar solo el número antes de cualquier otro carácter
            if numero_partes.isdigit():
                resultados.append(['SPL', int(numero_partes)])
            i += 2  # Saltar al siguiente conjunto de palabras
        elif i + 2 < len(palabras) and clave == 'MSAN':
            resultados.append(['MSAN', palabras[i + 1], palabras[i + 2]])
            i += 3  # Saltar al siguiente conjunto de palabras
        elif clave == 'FOT' and i + 1 < len(palabras):
            contenido_fot = [palabras[i + 1]]
            i += 2  # Saltar al siguiente conjunto de palabras
            while i < len(palabras) and palabras[i] != 'FIL':
                contenido_fot.append(palabras[i])
                i += 1
            resultados.append(['FOT', ' '.join(contenido_fot)])
        elif clave == 'CE' and i + 1 < len(palabras):
            contenido_ce = [palabras[i + 1]]
            i += 2  # Saltar al siguiente conjunto de palabras
            while i < len(palabras) and palabras[i] != 'FIL':
                contenido_ce.append(palabras[i])
                i += 1
            resultados.append(['CE', ' '.join(contenido_ce)])
        elif clave == 'CP' and i + 1 < len(palabras):
            contenido_cp = [palabras[i + 1]]
            i += 2  # Saltar al siguiente conjunto de palabras
            while i < len(palabras) and palabras[i] != 'FIL':
                contenido_cp.append(palabras[i])
                i += 1
            resultados.append(['CP', ' '.join(contenido_cp)])
        else:
            i += 1  # Continuar al siguiente conjunto de palabras si no coincide ninguna palabra clave

    #print('Resultados escaneo')
    #return resultados
    #print(resultados)

    claves = ['CP','CE','FOT','SPL','MSAN','FIL','FCA']
    datos = {'resultados': resultados, 'palabras': claves}
    print(json.dumps(datos), flush=True)




def texto(imagen):
    global doc

    # Dirección de Pytesseract
    pytesseract.pytesseract.tesseract_cmd = r'C:\Program Files\Tesseract-OCR\tesseract.exe'

    # Conversión a escala de grises
    gris = cv2.cvtColor(imagen, cv2.COLOR_BGR2GRAY)

    # Filtro
    umbral = cv2.adaptiveThreshold(gris, 255, cv2.ADAPTIVE_THRESH_GAUSSIAN_C, cv2.THRESH_BINARY, 55, 25)

    # Configuración OCR
    config = '--psm 1'
    texto_extraido = pytesseract.image_to_string(umbral, config=config)

    # Procesar palabras clave
    resultados = procesar_palabras(texto_extraido)

    #for resultado in resultados:
    #    print(resultado)

# Empezar
while True:
    ret, frame = cap.read()

    # Interfaz
    cv2.putText(frame, "Ubique la etiqueta en el cuadro", (458, 80), cv2.FONT_HERSHEY_SIMPLEX, 0.71, (0,255,0),2)
    cv2.rectangle(frame, (cuadro,cuadro), (1280 - cuadro, 720 - cuadro), (0,255,0),2)

    if doc == 0:
        cv2.putText(frame, 'PRESIONA S PARA ESCANEAR', (470, 750 - cuadro), cv2.FONT_HERSHEY_SIMPLEX, 0.71, (0,255,0),2)

    t = cv2.waitKey(5)
    cv2.imshow('ID INTELIGENTE', frame)

    if t == 27:
        break

    elif t == 83 or t == 115:
        texto(frame)
        break

cap.release()
cv2.destroyAllWindows()

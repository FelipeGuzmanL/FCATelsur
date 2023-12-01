import cv2
import pytesseract
import json
import openai

# Variables
cuadro = 100
doc = 0

cap = cv2.VideoCapture(0)
cap.set(3, 1280)
cap.set(4, 740)

def estandarizar_etiquetas(etiqueta):
    openai.api_key = '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'

    modelo = 'gpt-3.5-turbo'

    prompt = f'reestandariza la siguiente etiqueta {etiqueta} y solo muestrame la etiqueta y nada mas'

    mapeo = ['CE','FOT','Anillo','CP','CEMP']

    contexto = f'El estandar de las etiquetas de redes es el siguiente: el tipo de cable que pueden ser {mapeo} (si aparece C ESP corresponde a CE), luego nombre del cable, despues FIL, numero del filamento, FCA, nombre del sitio fca, SPL, con guion y numero del spliter, ignorando todo el contenido innecesario.'

    mensajes = [
        {'role': 'system', 'content': contexto},
        {'role': 'user','content':prompt}
    ]

    respuesta = openai.ChatCompletion.create(
        model = modelo,
        messages = mensajes,
        temperature = 0.8,
        max_tokens = 1000
    )

    texto_estandarizado = respuesta['choices'][0]['message']['content']

    #print(texto_estandarizado)

    procesar_palabras(texto_estandarizado)

def procesar_palabras(texto):

    palabras = texto.split()  # Dividir el texto en palabras

    resultados = []
    cl = []

    i = 0
    while i < len(palabras):
        cl.append(palabras[i])
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
            msan_y_fca = palabras[i + 1].split('-')
            msan_numero = msan_y_fca[0]
            msan_fca = msan_y_fca[1]
            resultados.append(['MSAN', msan_numero, msan_fca, palabras[i + 2]])
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

    claves_escaneadas = []

    claves_encontradas = 0

    for clave in cl:
        #print(clave)
        if clave in ['CE','FOT','Anillo','CP','CEMP','SPL','FIL','FCA','MSAN']:
            claves_encontradas += 1
            claves_escaneadas.append(clave)

    if 'FIL' in claves_escaneadas and any(clave in ['CE', 'FOT', 'Anillo', 'CP', 'CEMP'] for clave in claves_escaneadas):
        claves = ['CP','CE','FOT','SPL','MSAN','FIL','FCA']
        datos = {'cable': resultados, 'palabras': claves}
        print(json.dumps(datos), flush=True)

    elif 'MSAN' in claves_escaneadas:
        claves = ['CP','CE','FOT','SPL','MSAN','FIL','FCA']
        resultados = resultados[0]
        separados = resultados[3].split('-')
        slot = separados[0] + '-' + separados[1]
        olt = separados[2]
        datos = {'msan': resultados, 'slot': slot ,'olt': olt, 'palabras': claves}
        print(json.dumps(datos), flush=True)

    else:
        #print('claves_escaneadas no cumple con las condiciones especificadas.')
        estandarizar_etiquetas(texto)

    '''if resultados != []:
        claves = ['CP','CE','FOT','SPL','MSAN','FIL','FCA']
        print('claves', claves_escaneadas)
        if claves_escaneadas[0] in ['CP','CE','FOT','SPL','FIL','FCA']:
            datos = {'cable': resultados, 'palabras': claves}
        elif claves_escaneadas[0] in ['MSAN']:
            resultados = resultados[0]
            separados = resultados[3].split('-')
            slot = separados[0] + '-' + separados[1]
            olt = separados[2]
            datos = {'msan': resultados, 'slot': slot ,'olt': olt, 'palabras': claves}
        print(json.dumps(datos), flush=True)
    else:
        print("Error al capturar imagen")'''


    #print(claves_encontradas, claves_escaneadas,'\n',palabras, '\n',resultados)

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
    #estandarizar_etiquetas(texto_extraido)

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

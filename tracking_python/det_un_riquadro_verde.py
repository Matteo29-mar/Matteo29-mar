import cv2

# Crea l'oggetto per catturare il video dalla webcam
cap = cv2.VideoCapture(0)

# Definisci il rilevatore di movimento
fgbg = cv2.createBackgroundSubtractorMOG2()

# Inizializza le coordinate del centro del rettangolo e la soglia di cambio
prev_cx, prev_cy = None, None
change_threshold = 20
has_movement = False
has_target = False

while True:
    # Cattura un frame dal video
    ret, frame = cap.read()

    # Ridimensiona il frame
    scale_percent = 200
    width = int(frame.shape[1] * scale_percent / 100)
    height = int(frame.shape[0] * scale_percent / 100)
    frame = cv2.resize(frame, (width, height), interpolation=cv2.INTER_AREA)

    # Applica un filtro di sfocatura
    frame = cv2.GaussianBlur(frame, (5, 5), 0)

    # Applica il rilevatore di movimento al frame
    fgmask = fgbg.apply(frame)

    # Applica la morfologia per rimuovere il rumore
    kernel = cv2.getStructuringElement(cv2.MORPH_ELLIPSE, (3, 3))
    fgmask = cv2.morphologyEx(fgmask, cv2.MORPH_OPEN, kernel)

    # Trova i contorni delle aree in movimento
    contours, hierarchy = cv2.findContours(fgmask, cv2.RETR_EXTERNAL, cv2.CHAIN_APPROX_SIMPLE)

    # Trova il rettangolo di movimento più grande
    max_area = 0
    max_contour = None
    for contour in contours:
        area = cv2.contourArea(contour)
        if area > max_area:
            max_area = area
            max_contour = contour


    # Disegna il rettangolo attorno all'area di movimento più grande
    if max_contour is not None:
        x, y, w, h = cv2.boundingRect(max_contour)
        cv2.rectangle(frame, (x, y), (x + w, y + h), (0, 255, 0), 2)

        # Disegna un punto al centro del rettangolo
        cx = int(x + w / 2)
        cy = int(y + h / 2)
        cv2.circle(frame, (cx, cy), 5, (0, 0, 255), -1)

        # Stampa le coordinate del centro del rettangolo solo se c'è un cambiamento significativo
        if prev_cx is None or abs(cx - prev_cx) > change_threshold or abs(cy - prev_cy) > change_threshold:
            print("Coordinate (x,y) del centro del rettangolo: ({},{})".format(cx, cy))
            prev_cx, prev_cy = cx, cy

        # Verifica se il rettangolo supera una certa soglia e se il punto rosso è all'interno del rettangolo
        if w * h > 50000 and abs(cx - x - w/2) < w/2 and abs(cy - y - h/2) < h/2:
            cv2.circle(frame, (cx, cy), 5, (0, 255, 0), -1)
            if not has_target:
                print("Hai preso il bersaglio!")
                has_target = True
        else:
            cv2.circle(frame, (cx, cy), 5, (0, 0, 255), -1)
            if has_target:
                print("Hai perso il bersaglio!")
                has_target = False

        # Se il rettangolo supera una certa soglia e il punto rosso è all'interno del rettangolo, stampa "SPARA!" su terminale
        if w * h > 0 and abs(cx - x - w/2) < w/2 and abs(cy - y - h/2) < h/2:
            print("SPARA!")
            has_movement = True
        else:
            if has_movement:
                print("Non stai puntando.")
                has_movement = False

    # Mostra il frame con il rettangolo e il punto solo se viene rilevato un movimento
    if max_contour is not None:
        cv2.imshow('frame', frame)
    else:
        cv2.imshow('frame', cv2.cvtColor(frame, cv2.COLOR_BGR2GRAY))
        if has_movement:
            print("Non stai puntando.")
            has_movement = False

    # Interrompi il loop se viene premuto il tasto 'q'
    if cv2.waitKey(1) & 0xFF == ord('q'):
        break

# Rilascia la cattura della webcam e chiudi tutte le finestre
cap.release()
cv2.destroyAllWindows()
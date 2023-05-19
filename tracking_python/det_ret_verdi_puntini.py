import cv2

# inizializza il video stream
cap = cv2.VideoCapture(0)

# definisci il riquadro iniziale dell'oggetto
object_frame = None

while True:
    # acquisisci il frame corrente dal video stream
    ret, frame = cap.read()

    # se non riesci ad acquisire il frame, esci dal ciclo
    if not ret:
        break

    # converte il frame in scala di grigi
    gray = cv2.cvtColor(frame, cv2.COLOR_BGR2GRAY)

    # applica un filtro di sfocatura per ridurre il rumore
    gray = cv2.GaussianBlur(gray, (21, 21), 0)

    # se non hai ancora identificato l'oggetto, assegna il frame corrente come riquadro iniziale
    if object_frame is None:
        object_frame = gray
        continue

    # calcola la differenza assoluta tra il frame corrente e il riquadro iniziale
    frame_delta = cv2.absdiff(object_frame, gray)

    # applica una soglia al frame delta per evidenziare i cambiamenti
    thresh = cv2.threshold(frame_delta, 25, 255, cv2.THRESH_BINARY)[1]

    # dilata la soglia per riempire eventuali buchi
    thresh = cv2.dilate(thresh, None, iterations=2)

    # trova i contorni degli oggetti in movimento
    contours, _ = cv2.findContours(thresh.copy(), cv2.RETR_EXTERNAL, cv2.CHAIN_APPROX_SIMPLE)

    # per ogni contorno trovato
    for contour in contours:
        # se il contorno è troppo piccolo, ignoralo
        if cv2.contourArea(contour) < 500:
            continue

        # calcola le coordinate del rettangolo che incornicia il contorno
        (x, y, w, h) = cv2.boundingRect(contour)

        # disegna il rettangolo intorno all'oggetto in movimento
        cv2.rectangle(frame, (x, y), (x + w, y + h), (0, 255, 0), 2)

        # calcola il punto centrale dell'oggetto in movimento
        centroid_x = int(x + w / 2)
        centroid_y = int(y + h / 2)

        # disegna un cerchio al centro dell'oggetto in movimento
        cv2.circle(frame, (centroid_x, centroid_y), 4, (0, 0, 255), -1)

    # mostra il frame corrente
    cv2.imshow("Frame", frame)
    key = cv2.waitKey(1) & 0xFF

    # se l'utente preme 'q', esci dal ciclo
    if key == ord("q"):
        break

# rilascia le risorse
cap.release()
cv2.destroyAllWindows()
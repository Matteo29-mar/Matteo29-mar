<?php
if ($_FILES["file"]["error"] === UPLOAD_ERR_OK) {
    $uploadDir = "uploads/";
    $uploadPath = $uploadDir . basename($_FILES["file"]["name"]);

    if (move_uploaded_file($_FILES["file"]["tmp_name"], $uploadPath)) {
        echo "File caricato con successo.";
    } else {
        echo "Errore durante il caricamento del file.";
    }
} else {
    echo "Errore durante il caricamento del file.";
}
?>

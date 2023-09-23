<?php
if ($_FILES["file"]["error"] == UPLOAD_ERR_OK) {
    $tempFile = $_FILES["file"]["tmp_name"];
    $targetFile = "uploads/" . $_FILES["file"]["name"];

    if (move_uploaded_file($tempFile, $targetFile)) {
        echo "File caricato con successo.";
    } else {
        echo "Errore durante il caricamento del file.";
    }
} else {
    echo "Errore durante il caricamento del file.";
}
?>

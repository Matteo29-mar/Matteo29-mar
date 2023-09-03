<?php
header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data["folderName"])) {
    $folderName = $data["folderName"];
    $folderPath = "uploads/" . $folderName;

    if (!file_exists($folderPath)) {
        if (mkdir($folderPath)) {
            echo json_encode(["message" => "Cartella creata con successo."]);
        } else {
            echo json_encode(["error" => "Errore durante la creazione della cartella."]);
        }
    } else {
        echo json_encode(["error" => "La cartella esiste già."]);
    }
} else {
    echo json_encode(["error" => "Parametro 'folderName' mancante."]);
}
?>

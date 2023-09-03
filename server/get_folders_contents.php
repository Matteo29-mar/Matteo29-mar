<?php
include "config.php";

$folder = $_GET["folder"];

if (!$folder) {
    echo json_encode(["error" => "La cartella non è specificata."]);
    exit();
}

$folder = $conn->real_escape_string($folder);

$result = $conn->query("SELECT file FROM files WHERE folder = '$folder'");
if (!$result) {
    echo json_encode(["error" => "Errore nel recupero del contenuto della cartella dal database."]);
    exit();
}

$files = [];
while ($row = $result->fetch_assoc()) {
    $files[] = $row["file"];
}

echo json_encode(["files" => $files]);
?>

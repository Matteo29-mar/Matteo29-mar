<?php
include "config.php";

$result = $conn->query("SELECT DISTINCT folder FROM files");
if (!$result) {
    echo json_encode(["error" => "Errore nel recupero delle cartelle dal database."]);
    exit();
}

$folders = [];
while ($row = $result->fetch_assoc()) {
    $folders[] = $row["folder"];
}

echo json_encode(["folders" => $folders]);
?>

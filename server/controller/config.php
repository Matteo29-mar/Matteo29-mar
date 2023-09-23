<?php
//da sistemare
    
    $servername = "localhost";
    $username = "finsoft";
    $password = "finsoft";
    $dbname = "finsoft";
    
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Verifica della connessione
    if ($conn->connect_error) {
        die("Connessione al database fallita: " . $conn->connect_error);
    }
?>

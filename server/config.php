<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "server";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connessione al database fallita: " . $conn->connect_error);
}
?>

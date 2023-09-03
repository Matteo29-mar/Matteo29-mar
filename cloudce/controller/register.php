<?php
$host = "localhost";
$user = "finsoft";
$password = "finsoft";
$db = "cloudme";

$connessione = new mysqli($host, $user, $password, $db);

if($connessione === false){
    die("errore di connesione:" . $connessione->connect_error);

}

$user = $connessione->real_escape_string($_POST['user']);
$email = $connessione->real_escape_string($_POST['email']);
$password = $connessione->real_escape_string($_POST['password']);
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Inserisci i dati del nuovo utente nel database
  $sql = "INSERT INTO utenti (user, email, password) VALUES ('$user','$email','$hashed_password')";

  if($connessione->query($sql) === true){
    echo "Registrazione avvenuta con successo.";
    header('Refresh: 2; URL=index.html');
   
  }else {
    echo "Errore durante la registrazione. Riprova $sql.  " . $connessione->error;
    header('Refresh: 2; URL=register.html');

  }

  $connessione->close();
?> 

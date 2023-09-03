<?php

$host = "localhost";
$user = "finsoft";
$password = "finsoft";
$db = "cloudme";
$connessione = new mysqli($host, $user, $password, $db);
if($connessione === false){
    die("errore di connessione:" . $connessione->connect_error);
}

$user = $connessione->real_escape_string($_POST['user']);
$password = $connessione->real_escape_string($_POST['password']);

if($_SERVER["REQUEST_METHOD"] === "POST"){

    $sql_select = "SELECT * FROM utenti WHERE user = '$user'";

    if($result = $connessione->query($sql_select)){

        if($result->num_rows == 1){       
            $row = $result->fetch_array(MYSQLI_ASSOC);

            if(password_verify($password, $row['password'])){

                session_start();

                $_SESSION['loggato'] = true;
                $_SESSION['id'] = $row['id'];
                $_SESSION['user'] = $row['user'];

                if ($row['ruolo'] == 'root') {
                    $_SESSION['is_root'] = true;
                    header("location: root/privateroot.php");
                } else {
                    header("location: user/private.php");
                }

            } else {
                printf("password errata");
                header('URL=index.html');

            }
    
        } else {
            printf("account non esiste");
            header('Refresh: 2; URL=register.html');

        }
    }
    $connessione->close();
}

?>

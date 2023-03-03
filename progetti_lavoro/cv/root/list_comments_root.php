<?php

session_start();
if(!isset($_SESSION['loggato']) || $_SESSION['loggato'] !== true){
    header("location: ../login.html");
    exit;
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="../index.css">

</head>
<body>

  <div class="overflow-h">
    <header class="header">
    <div class="header__content">
      <a class="header__logo" href="">
        <strong>IL MIO PROFILO - Area Privata di <?php printf($_SESSION["name"]);?></strong>
      </a>
      <div class="header__quick">
        <a href="privateroot.php">area privata&nbsp;&nbsp;</a>
        <a href="../index.html"> HOME&nbsp;&nbsp;</a>
        <a href="../logout.php"> Disconetti</a>
        <div class="icon-hamburger">
          <span></span>
          <span></span>
          <span></span>
        </div>
      </div>
    </div>
  </header>
  <div class="cover" style="background-image:linear-gradient(to bottom, rgba(0,0,0,0.2), rgba(0,0,0,0.6)), url('../img/Cloud.jpg');">
      <div class="cover__content grid grid--center text-center">     
<?php
    $host = "localhost";
    $user = "finsoft";
    $password = "finsoft";
    $db = "finsoft";

    // Connessione al database
    $connessione = new mysqli($host, $user, $password, $db);

    // Verifica della connessione
    if (!$connessione) {
        die("Connessione fallita: " . mysqli_error());
        header("location: ../index.html");

    }

    // Selezione dei dati dal database
    $sql = "SELECT * FROM comments WHERE id <> 1 ";
    $result = mysqli_query($connessione, $sql);

    // Visualizzazione dei dati
    if (mysqli_num_rows($result) > 0) {
        echo "<table>";
        echo "<tr>
              <th>Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
              <th>Email&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
              <th>Comment&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
              <th>Modifica&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
              <th>Elimina&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
              </tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                  <td>" . $row["name"] . "&nbsp;&nbsp;&nbsp;&nbsp;</td>
                  <td>" . $row["email"] . "&nbsp;&nbsp;&nbsp;&nbsp;</td>
                  <td>" . $row["comment"] . "&nbsp;&nbsp;&nbsp;&nbsp;</td>
                  <td>
                      <a href='list_comments_root.php' onclick='updatePopup(\"" . $row["id"] . "\", \"" . $row["name"] . "\", \"" . $row["email"] . "\", \"" . $row["comment"] . "\")'>
                          <span style='font-size:25px;'>&#128221;</span>
                      </a>
                  </td>  
                  <td>
                      <a href='list_comments_root.php' onclick='deletePopup(\"" . $row["id"] . "\", \"" . $row["name"] . "\", \"" . $row["email"] . "\", \"" . $row["comment"] . "\")'>
                          <span style='font-size:25px;'>&#10060;</span>
                      </a>
                  </td>
                  </tr>";
        }//aggiunta elimina
        echo "</table>";
    } else {
        printf("Nessun risultato trovato nel database");
        header("location:privateroot.php");

    }

    // Chiusura della connessione
    mysqli_close($connessione);
?>

<script>
    function updatePopup(id, name, email, comment) {
        // Apri la finestra popup
        var popup = window.open("", "Modifica Commento", "width=400, height=400");

        // Scrivi il contenuto della finestra popup
        popup.document.write("<h2>Modifica Commento</h2>");
        popup.document.write("<form action='modifica_root.php' method='post'>");
        popup.document.write("<input type='hidden' name='id' value='" + id + "'>");
        popup.document.write("<label for='name'>Nome:</label><br>");
        popup.document.write("<input type='text' id='name' name='name' value='" + name + "'><br>");
        popup.document.write("<label for='email'>Email:</label><br>");
        popup.document.write("<input type='email' id='email' name='email' value='" + email + "'><br>");
        popup.document.write("<label >Commento:</label><br>");
        popup.document.write("<textarea id='comment' name='comment'>" + comment + "</textarea><br><br>");
        popup.document.write("<input type='submit' value='Modifica Commento'>");
        popup.document.write("</form>");
    }
</script>

<script>
  function deletePopup(id, name, email, comment) {
  if (confirm("Sei sicuro di voler eliminare questo commento?")) {
    // Crea una richiesta HTTP per eliminare il commento 
    var xhttp = new XMLHttpRequest();//oggetto per creare chiamate http asincrone e ricevere una risposta in testo
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        // Ricarica la pagina per visualizzare l'elenco aggiornato dei commenti
        location.reload();
      }
    };
    xhttp.open("POST", "elimina_root.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("id=" + id);
}
}

</script>

<script>setTimeout(function(){
            location.reload(); //serve per la pagina corrente
        }, 15000);</script>
      </div>
  </div>

  <footer class="footer">
    <div class="grid grid--center text-center">
      <div class="col-25 mt-2">
        <h3>contatti</h3>
        <ul class="footer__menu">
          <li><a href="https://www.linkedin.com/in/matteo-marziano-910621191/" class=" fa fa-linkedin"></a></li>
          <br><br>
          <li><a href="mailto:https://www.matteomarziano.mm42@gmail.com" class="fa fa-google"></a></li>
        </ul>
      </div>
      
    </div>
  </footer>
  <p class="footer-bottom">
    Template by Matteo Marziano - <a href="">Privacy Policy</a>
  </p>
  
   <script> 
    let item = document.querySelector('.icon-hamburger');
    item.addEventListener("click", function() {
      document.body.classList.toggle('menu-open');
    });
   </script>
  </div>
  

</body>
</html>
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
          <strong>IL MIO PROFILO - <?php printf($_SESSION["name"]);?></strong>
        </a>
        <div class="header__quick">
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
        <div class="cover__content">     
            <a href="commenti_user.html" class="button">Commenti</a>
            <a href="chi_sono_user.html" class="button">Chi sono</a>
            <a href="hobby_user.html" class="button">Hobby</a>
            <a href="progetti_user.html" class="button">i miei progetti</a>
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
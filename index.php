<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Pocetna</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css">
    <link rel="stylesheet" type="text/css" media="screen" href="../css/style.css">
    <script src="main.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Nothing+You+Could+Do" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <style>
      
      @font-face { font-family: PolenticalNeonBold; src: url('../fonts/PolenticalNeonBold.ttf'); }
      h1 {
         font-family: PolenticalNeonBold;
         font-size: 150px;
         color: #ffe6ff;
      }
      h2 {

        font-family: PolenticalNeonBold;
        font-size: 50px;
        color: #ffe6ff;
      }
    </style>

</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="index.php">NEON</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
  
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="routes.php?page=prikazirezervaciju">Rezervacija</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="routes.php?page=prikazimeni" >Meni</a>
      </li>
      <?php
      session_start();
      if(isset($_SESSION['ulogovan'])){
      ?>
      <li class="nav-item">
        <a class="nav-link" href="routes.php?page=prikazipotvrdu">Potvrda rezervacija</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="routes.php?page=prikazistolove" >Prikaz stolova</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="routes.php?page=prikazirezervacije" >Prikaz potvrdjenih rezervacija</a>
      </li>
      <?php }else{ ?>
      <li class="nav-item" >
        <a class="nav-link" href="routes.php?page=prikazilogin">Login</a>
      </li>
      <?php
      }
      if(isset($_SESSION['ulogovan'])){ 
        ?>
      <li class="nav-item" >
        <a class="nav-link" href="routes.php?page=logout">Logout</a>
      </li>
      <?php } ?>
    </ul>
  </div>
</nav>

<div id="pocetna">
<?php 
$msg=isset($msg)?$msg:""; 
if($msg) echo "<span class='alert alert-light'>".$msg."</span>";

?>
        <!--<h1 >NEON</h1>
        <h2>Restoran</h2>
        <a href="routes.php?page=prikazimeni"><button id="dugme" type="button"style="font-size:20px; width:200px;" class="btn btn-dark dugme">MENI</button></a>
-->

</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
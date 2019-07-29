<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Potvrda</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css">
    <script src="main.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="index.php">NEON</a>
  <div class="collapse navbar-collapse" id="navbarNav">
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
      <li class="nav-item">
        <a class="nav-link" href="routes.php?page=prikazilogin">Login</a>
      </li>
      <?php
      }
      if(isset($_SESSION['ulogovan'])){ 
        ?>
      <li class="nav-item">
        <a class="nav-link" href="routes.php?page=logout">Logout</a>
      </li>
      <?php } ?>
    </ul>
  </div>
</nav>

<div class="container text-center">
<?php 

echo "Gost: <br>";
foreach($rezervacija as $pom){
    echo "Ime gosta: ".$pom['imegosta']."<br>Prezime gosta: ".$pom['prezimegosta']."<br>Vreme dolaska: ".$pom['vremerezervacije']."h<br>";
}
echo "Stolovi: <br>";
foreach($sto as $pom){
    echo "Sto1:<br>Broj mesta: ".$pom['brojmesta']."<br>Pozicija: ".$pom['pozicija']."<br>";
}

foreach($sto1 as $pom){
    echo "Sto2:<br>Broj mesta: ".$pom['brojmesta']."<br>Pozicija: ".$pom['pozicija'];
}

?>

<form action='routes.php'>

<input type="hidden" name="idstola" value="<?php echo $idstola; ?>">

<input type="hidden" name="idstola1" value="<?php echo $idstola1; ?>">

<input type="hidden" name="idrezervacije" value="<?php echo $idrezervacije; ?>">

<input type="submit" name="page" value="Dalje">

<input type="submit" name="page" value="Nazad">

</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>
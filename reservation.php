<!doctype <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Reservation</title>
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

<?php
$errors=isset($errors)?$errors:array();
?>
<div id="sredinarez" style="background-image:url('../images/a.jpg'); background-repeat: no-repeat;background-size:100%; height:600px; width:100%;">
<br>
<h2 align="center" style="color:white;">Rezervacija:</h2>
<br>


<form  action='routes.php'>
<div class="container fluid" align="center">
    <div class="col-md-3" >
      <input type="text" class="form-control" name='imegosta' placeholder='Unesite ime gosta:'>
      <?php if(array_key_exists('imegosta',$errors)) echo "<br><class='alert-danger'>".$errors['imegosta']." </span>"; ?>
    </div>
</div>
<br>
<div class="container fluid" align="center">
    <div class="col-md-3">
      <input type="text" class="form-control"name='prezimegosta' placeholder='Unesite prezime gosta:' >
      <?php if(array_key_exists('prezimegosta',$errors)) echo "<br><span class='alert-danger'>".$errors['prezimegosta']." </span>"; ?>
    </div>
</div>
<br>
<div class="container fluid" align="center">
    <div class="col-md-3">
      <input type="text" class="form-control" name='vremerezervacije' placeholder="Unesite vreme rezervacije:" >
      <?php if(array_key_exists('vremerezervacije',$errors)) echo "<br><span class='alert-danger'>".$errors['vremerezervacije']." </span>"; ?>
    </div>
</div>
<br>
<div class="container fluid" align="center">
    <div class="col-md-3">
      <input type="text" class="form-control" name='brojmesta' placeholder='Unesite broj mesta:' >
      <?php if(array_key_exists('brojmesta',$errors)) echo "<br><span class='alert-danger'>".$errors['brojmesta']." </span>"; ?>
    </div>
</div>
<br>
<div class="container fluid" align="center">
    <div class="col-md-2">
    <input type='submit' class="btn btn-primary mb-2"name='page' value='Rezervisi'>
    </div>
</div>

  </div>
</form>
    
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</div>
</body>
</html>
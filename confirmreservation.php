<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Potvrda rezervacije</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css">
    <script src="main.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <style> 
.dropbtn {
  background-color: #4CAF50;
  color: white;
  padding: 16px;
  font-size: 16px;
  border: none;
}

.dropbtn1 {
  background-color: red;
  color: white;
  padding: 16px;
  font-size: 16px;
  border: none;
}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown1 {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f1f1f1;
  min-width: 140px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown1-content {
  display: none;
  position: absolute;
  background-color: #f1f1f1;
  min-width: 140px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown1-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown:hover .dropdown-content {display: block;}

.dropdown1:hover .dropdown1-content {display: block;}

.dropdown:hover .dropbtn {background-color: #3e8e41;}

.dropdown1:hover .dropbtn1 {background-color: red;}
    </style>
    
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

<div class="container text-center>">

<h2> Potvrda rezervacije </h2>

<form action="routes.php" id="form">

<label for="rezevacije">Izaberite rezervaciju</label><br>
<select name="idrezervacije" id="rezervacije">
<option value=""> </option>
<?php 
foreach($rezervacije as $pom){
    if($pom['potvrda']==0) echo "<option value=$pom[idrezervacije]>$pom[imegosta] $pom[prezimegosta], Vreme - $pom[vremerezervacije], Broj mesta - $pom[brojmesta]</option>";
}
?>
</select><br><br>

<input type="hidden" name="page" value="povezi">

<label for="idstola">Izaberite sto</label><br>
 <?php

foreach($prvi as $pom){
  if($pom['dostupnost']==0){echo "<button type='submit' form='form' name='idstola' value='$pom[idstola]' class='btn btn-success'>Br stola: $pom[idstola]<br>Broj mesta: $pom[brojmesta] Pozicija: $pom[pozicija]</button>";}else{echo "<button disabled type='submit' form='form' name='idstola' value='$pom[idstola]' class='btn btn-danger'>Id stola: $pom[idstola]<br>Broj mesta: $pom[brojmesta] Pozicija: $pom[pozicija]</button>";}
  echo "&nbsp";
}
echo "<br><br>";
foreach($drugi as $pom){
  if($pom['dostupnost']==0){echo "<button type='submit' form='form' name='idstola' value='$pom[idstola]' class='btn btn-success'>Br stola: $pom[idstola]<br>Broj mesta: $pom[brojmesta] Pozicija: $pom[pozicija]</button>";}else{echo "<button disabled type='submit' form='form' name='idstola' value='$pom[idstola]' class='btn btn-danger'>Id stola: $pom[idstola]<br>Broj mesta: $pom[brojmesta] Pozicija: $pom[pozicija]</button>";}
  echo "&nbsp";
}
echo "<br><br>";
foreach($treci as $pom){
  if($pom['dostupnost']==0){echo "<button type='submit' form='form' name='idstola' value='$pom[idstola]' class='btn btn-success'>Br stola: $pom[idstola]<br>Broj mesta: $pom[brojmesta] Pozicija: $pom[pozicija]</button>";}else{echo "<button  disabled type='submit' form='form' name='idstola' value='$pom[idstola]' class='btn btn-danger'>Id stola: $pom[idstola]<br>Broj mesta: $pom[brojmesta] Pozicija: $pom[pozicija]</button>";}
  echo "&nbsp";
}

?>
<?php /*
//var_dump($prvi);
foreach($prvi as $pom){
    if($pom['dostupnost']==0){echo "<div class='dropdown'>";}else{echo "<div class='dropdown1'>";}
    if($pom['dostupnost']==0){echo "<button class='dropbtn' name='idstola' form='form' value='$pom[idstola]'>$pom[idstola]</button>";}else{echo "<button class='dropbtn1' name='idstola' form='form' value='$pom[idstola]'>$pom[idstola]</button>";}
    if($pom['dostupnost']==0){echo "<div class='dropdown-content'>";}else{echo "<div class='dropdown-content'>";}
    echo "Broj mesta: ".$pom['brojmesta']." Pozicija: ".$pom['pozicija'];
    echo "</div></div>";
}
echo "<br><br>";
foreach($drugi as $pom){
  if($pom['dostupnost']==0){echo "<div class='dropdown'>";}else{echo "<div class='dropdown1'>";}
  if($pom['dostupnost']==0){echo "<button class='dropbtn' name='idstola' form='form' value='$pom[idstola]'>$pom[idstola]</button>";}else{echo "<button class='dropbtn1' name='idstola' form='form' value='$pom[idstola]'>$pom[idstola]</button>";}
  if($pom['dostupnost']==0){echo "<div class='dropdown-content'>";}else{echo "<div class='dropdown-content'>";}
  echo "Broj mesta: ".$pom['brojmesta']." Pozicija: ".$pom['pozicija'];
  echo "</div></div>";

}
echo "<br><br>";
foreach($treci as $pom){
  if($pom['dostupnost']==0){echo "<div class='dropdown'>";}else{echo "<div class='dropdown1'>";}
  if($pom['dostupnost']==0){echo "<button class='dropbtn' name='idstola' form='form' value='$pom[idstola]'>$pom[idstola]</button>";}else{echo "<button class='dropbtn1' name='idstola' form='form' value='$pom[idstola]'>$pom[idstola]</button>";}
  if($pom['dostupnost']==0){echo "<div class='dropdown-content'>";}else{echo "<div class='dropdown-content'>";}
  echo "Broj mesta: ".$pom['brojmesta']." Pozicija: ".$pom['pozicija'];
  echo "</div></div>";
}*/
?>


</form>

<br>

<?php 
$msg=isset($msg)?$msg:"";
if($msg) echo $msg ?>

</div>
    
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
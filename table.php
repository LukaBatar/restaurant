<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Table</title>
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
      //session_start();
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
        <a class="nav-link" align="right" href="routes.php?page=logout">Logout</a>
      </li>
      <?php } ?>
    </ul>
  </div>
</nav>

<?php $idstola=isset($_GET['idstola'])?$_GET['idstola']:""; ?>

<div class="container text-center">

<a href="routes.php?page=showJela&idstola=<?php echo $idstola; ?>" class="btn btn-dark btn-block">Jela</a>

<a href="routes.php?page=showPica&idstola=<?php echo $idstola; ?>" class="btn btn-dark btn-block">Pica</a>

</div>

<br><br>
<?php

if(isset($showJela)&&$showJela==1){

?>

<table class="table table-bordered">
<tr>
        <th>Naziv</th>
        <th>Opis</th>
        <th>Cena</th>
        <th>Kolicina</th>
        <th>Akcija</th>
    </tr>
    
    <?php
    
        foreach($jela as $pom){
            echo "<form action='routes.php'>";
            echo "<tr>";
            echo "<td>$pom[nazivjela]</td>";
            echo "<td>$pom[opisjela]</td>";
            echo "<td>$pom[cenajela]</td>";
            echo "<input type='hidden' name='idstola' value='$idstola'>";
            echo "<input type='hidden' name='showJela' value='$showJela'>";
            echo "<input type='hidden' name='showPica' value='$showPica'>";
            echo "<input type='hidden' name='idjela' value='$pom[idjela]'>";
            echo "<td><input type='text' name='koljela' value=''></td>";
            echo "<td><input type='submit' name='page' value='Izaberi jelo' class='btn btn-dark'>";  
            echo "</tr></form>";  
        }
        ?>
</table>

<?php

}

if(isset($showPica)&&$showPica==1){

?>

<table class="table table-bordered">
    <tr>
        <th>Naziv</th>
        <th>Opis</th>
        <th>Cena</th>
        <th>Kolicina</th>
        <th>Akcija</th>
    </tr>
    
    <?php
    
        foreach($pica as $pom){
            echo "<form action='routes.php'>";
            echo "<tr>";
            echo "<td>$pom[nazivpica]</td>";
            echo "<td>$pom[opispica]</td>";
            echo "<td>$pom[cenapica]</td>";
            echo "<input type='hidden' name='idstola' value='$idstola'>";
            echo "<input type='hidden' name='showJela' value='$showJela'>";
            echo "<input type='hidden' name='showPica' value='$showPica'>";
            echo "<input type='hidden' name='idpica' value='$pom[idpica]'>";
            echo "<td><input type='text' name='kolpica' value=''></td>";
            echo "<td><input type='submit' name='page' value='Izaberi pice' class='btn btn-dark'>";  
            echo "</tr></form>";  
        }
        ?>
</table>

<?php 
}
//var_dump($_SESSION['table'.$idstola]);

?>

<a class="btn btn-dark" href="routes.php?page=showTableBill&idstola=<?php echo $idstola; ?>">Prikazi trenutni racun</a>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
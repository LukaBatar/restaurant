<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sum</title>
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

<?php





?>




<h3>Racun</h3>

<table class="table table-bordered">
    <thead class="thead-dark">
        <th colspan="5">Jela</th>
    </thead>
    <tr>
        <th>Naziv</th>
        <th>Opis</th>
        <th>Cena za jedan artkial</th>
        <th>Kolicina</th>
        <th>Ukupna cena</th>
    </tr>

    <?php
    
        foreach($izabranajela as $pom){
            echo "<tr>";
            echo "<td>$pom[nazivjela]</td>";
            echo "<td>$pom[opisjela]</td>";
            echo "<td>$pom[cenajela]</td>";
            echo "<td>$pom[kolicina]</td>";
            echo "<td>$pom[ukupnacena]</td>";
            echo "</tr>";
        }

    ?>

    <thead class="thead-dark">
        <th colspan="5">Pica</th>
    </thead>
    <tr>
        <th>Naziv</th>
        <th>Opis</th>
        <th>Cena jednog artikla</th>
        <th>Kolicina</th>
        <th>Ukupna cena</th>
    </tr>

    <?php

    foreach($izabranapica as $pom){
            echo "<tr>";
            echo "<td>$pom[nazivpica]</td>";
            echo "<td>$pom[opispica]</td>";
            echo "<td>$pom[cenapica]</td>";
            echo "<td>$pom[kolicina]</td>";
            echo "<td>$pom[ukupnacena]</td>";
            echo "</tr>";
        }

    ?>

    <tr>
        <th colspan="3"> </th>
        <th>Ukupan racun:</th>
        <th><?php echo $total; ?></th>
        
    </tr>

</table>
<form action="routes.php">
<button class="btn btn-dark" type="submit" name="page" value="back">Nazad</button>
</form>

<?php
/*
var_dump($total);
echo "<br><br>";
var_dump($izabranajela);
echo "<br><br>";
var_dump($izabranapica);
*/
?>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>

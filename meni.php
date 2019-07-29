<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Meni</title>
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

<form id="saberi" action="routes.php">

<table class="table table-bordered">
    <thead class="thead-dark">
        <th colspan="6">Jela</th>
    </thead>
    <tr>
        <th>Naziv</th>
        <th>Opis</th>
        <th>Cena</th>
        <th>Kolicina</th>
        <?php if(isset($_SESSION['ulogovan'])) echo "<th>Akcija</th>";?>
    </tr>
    <?php
    
        foreach($jela as $pom){
          echo "<tr>";
          echo "<td>$pom[nazivjela]</td>";
          echo "<td>$pom[opisjela]</td>";
          echo "<td>$pom[cenajela]</td>";
          echo "<input type='hidden' form='saberi' name='idjela[]' value='$pom[idjela]'>";
          echo "<td><input type='text' form='saberi' name='koljela[]' value='0'></td>";
          if(isset($_SESSION['ulogovan'])) echo "<td><a href='routes.php?page=Obrisijelo&idjela=$pom[idjela]' class='btn btn-light'>Obrisi jelo</a></td>";
          echo "</tr>";  
        }
      
        
        if(isset($_SESSION['ulogovan'])){ 
              
              ?>
    <form action="routes.php" id="meal">
    <tr>
        <td><input type="text" name="nazivjela" placeholder="Naziv"></td>
        <td><textarea name="opisjela" placeholder="Opis"></textarea></td>
        <td><input type="text" name="cenajela" placeholder="Cena"></td>
        <td colspan="2"><button type="submit" class="btn btn-dark" name="page" value="addmeal">Dodaj jelo</button></td>
    </td>
    </form>

      <?php } 

    if(isset($errors)){
    foreach($errors as $val){
        echo "<tr>";
        echo "<td colspan='5'>$val</td></tr>";
    }
    }
    if(isset($msg)) echo "<tr><td colspan='5'>$msg</td></tr>";
    ?>

    <thead class="thead-dark">
        <th colspan="6">Pica</th>
    </thead>
    <tr>
        <th>Naziv</th>
        <th>Opis</th>
        <th>Cena</th>
        <th>Kolicina</th>
        <?php if(isset($_SESSION['ulogovan'])) echo "<th>Akcija</th>";?>
    </tr>
    <?php
        foreach($pica as $pom){
            echo "<tr>";
            echo "<td>$pom[nazivpica]</td>";
            echo "<td>$pom[opispica]</td>";
            echo "<td>$pom[cenapica]</td>";
            echo "<input type='hidden' name='idpica[]' value='$pom[idpica]'>";
            echo "<td><input type='text' name='kolpica[]' value='0'></td>";
            if(isset($_SESSION['ulogovan'])) echo "<td><a href='routes.php?page=Obrisipice&idpica=$pom[idpica]' class='btn btn-light'>Obrisi pice</a></td>";
            echo "</tr>";
        }

        if(isset($_SESSION['ulogovan'])){ 
          
    ?>
    <form action="routes.php">
    <tr>
        <td><input type="text" name="nazivpica" placeholder="Naziv"></td>
        <td><textarea name="opispica" placeholder="Opis"></textarea></td>
        <td><input type="text" name="cenapica" placeholder="Cena"></td>
        <td colspan="2"><button type="submit" class="btn btn-dark" name="page" value="adddrink">Dodaj pice</button></td>
    </td>
    </form>

        <?php } 
    if(isset($errors1)){
      foreach($errors1 as $val){
          echo "<tr>";
          echo "<td colspan='5'>$val</td></tr>";
      }
    }
    if(isset($msg1)) echo "<tr><td colspan='5'>$msg1</td></tr>";
      ?>
        
        
</table>
<input type="submit" name="page" class="btn btn-dark" value="Saberi racun">
</form>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
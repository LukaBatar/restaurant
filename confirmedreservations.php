<!DOCTYPE html>
<html>
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
$dao = new DAO();
?>

<table class="table table-bordered">
    <thead class="thead-dark">
        <th colspan="7">Potvrdjene rezervacije</th>
    </thead>
    <tr>
        <th>Ime</th>
        <th>Prezime</th>
        <th>Vreme</th>
        <th>Broj mesta</th>
        <th>Stolovi</th>
        <th></th>
    </tr>
    <?php 
    if(!empty($potvrdjene)){
        foreach($potvrdjene as $pom){
            $idstola=$pom['idstola'];
            $idrezervacije=$pom['idrezervacije'];
            $rezervacija=$dao->getReservationById($idrezervacije);
            $sto=$dao->getTableById($idstola);

            echo "<tr>";
            foreach($rezervacija as $r){
                echo "<td>$r[imegosta]</td>";
                echo "<td>$r[prezimegosta]</td>";
                echo "<td>$r[vremerezervacije]h</td>";
                echo "<td>$r[brojmesta]</td>";
            }
            foreach($sto as $s){
                echo "<td>$s[idstola]</td>";
            }

            echo "<td><form action='routes.php'>";
            echo "<button type='submit' name='page' value='deletereservation' class='btn btn-light'>Obrisi</button>";
            echo "<input type='hidden' name='idrezervacije' value='$idrezervacije'>";
            echo "<input type='hidden' name='idstola' value='$idstola'>";
            echo "</form></td>";
          }
        
    }else{
        echo "<td>/</td>";
        echo "<td>/</td>";
        echo "<td>/</td>";
        echo "<td>/</td>";
        echo "<td>/</td>";
    }
    ?>
    </tr>
</table>
<?php
$msg=isset($msg)?$msg:"";
if(!empty($msg)){
echo "<div class='alert alert-dark' role='alert'>";
    echo $msg;
echo "</div>";
}
?>
<form action="routes.php">
    <button type="submit" name="page" class="btn btn-outline-dark" value="obrisirezervacije">Obrisi sve rezervacije</button>
</form>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>


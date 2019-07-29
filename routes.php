<?php

// RUTIRANJE

//FAJL SA RUTAMA MORA BITI POVEZAN SA KONTROLEROM

//U OVOM FAJLU PROVERAVAMO RUTE  I SVAKU RUTU PROSLEDJUJEMO
//NA ODREDJENU METODU U KONTROLERU

require_once '../controllers/Controller.php';
$controller=new Controller();

$page=isset($_GET['page'])?$_GET['page']:"";

switch($page){

  case 'prikazirezervaciju':
  $controller->showReservation();
  break;

  case 'Rezervisi':
  $controller->reserve();
  break;

  case 'prikazipotvrdu':
  $controller->prikaziPotvrdu();
  break;

  case 'povezi':
  $controller->potvrda2();
  break;

  case 'povezi2':
  $controller->potvrda3();
  break;

  case 'Potvrdi':
  $controller->confirmReservation();
  break;

  case 'Dalje':
  $controller->confirmReservationMultiple();
  break;

  case 'prikazistolove':
  $controller->showTables();
  break;

  case 'Nazad':
  $controller->prikaziPotvrdu();
  break;

  case 'prikazilogin':
  $controller->prikaziLogin();
  break;

  case 'logout':
  $controller->logout();
  break;

  case 'prikazimeni':
  $controller->showMenu();
  break;

  case 'prikazirezervacije':
  $controller->showReservations();
  break;

  case 'obrisirezervacije':
  $controller->deleteReservations();
  break;

  case 'deletereservation':
  $controller->deleteReservation();
  break;

  case 'Saberi racun':
  $controller->saberiRacun();
  break;

  case 'back':
  $controller->showMenu();
  break;

  case 'showtable':
  $controller->showTable();
  break;

  case 'addmeal':
  $controller->addMeal();
  break;

  case 'adddrink':
  $controller->addDrink();
  break;

  case 'Obrisijelo':
  $controller->deleteMeal();
  break;

  case 'Obrisipice':
  $controller->deleteDrink();
  break;

  case 'showJela':
  $controller->showJela();
  break;

  case 'showPica':
  $controller->showPica();
  break;

  case 'Izaberi jelo':
  $controller->izaberiJelo();
  break;

  case 'Izaberi pice':
  $controller->izaberiPice();
  break;

  case 'showTableBill':
  $controller->showTableBill();
  break;

  case 'finishBill':
  $controller->finishBill();
  break;

}

if($_SERVER['REQUEST_METHOD']=='POST'){

  $page=isset($_POST['page'])?$_POST['page']:"";

  switch($page){

    case 'Ulogujte se':
    $controller->login();
    break;

  }
  
}


?>
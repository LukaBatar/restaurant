<?php
require_once '../config/db.php';

class DAO {

private $db;

private $GETALLAVAILABLETABLESEATS="SELECT brojmesta FROM stolovi WHERE dostupnost=0";

private $INSERTRESERVATION="INSERT INTO rezervacije(imegosta,prezimegosta,vremerezervacije,brojmesta) VALUES (?, ?, ?, ?)";

private $SELECTALLRESERVATIONS="SELECT * FROM rezervacije";

private $SELECTALLTABLES="SELECT * FROM stolovi";

private $GETTABLEBYID="SELECT * FROM stolovi WHERE idstola=?";

private $GETRESERVATIONBYID="SELECT * FROM rezervacije WHERE idrezervacije=?";

private $CHANGETABLESTATUS="UPDATE stolovi SET dostupnost='1' WHERE idstola=?";

private $CHANGERESERVATIONSTATUS="UPDATE rezervacije SET potvrda='1' WHERE idrezervacije=?";

private $ASSIGN="INSERT INTO rezervacijasto(idstola, idrezervacije) VALUES (?,?)";

private $CLEARALLTABLES="UPDATE stolovi SET dostupnost=0";

private $CLEARTABLE="UPDATE stolovi SET dostupnost=0 WHERE idstola=?";

private $LOGIN="SELECT * FROM admini WHERE username=? AND password=?";

private $SELECTALLMEALS="SELECT * FROM jelovnik";

private $SELECTALLDRINKS="SELECT * FROM kartapica";

private $SELECTCONFIRMEDRESERVATIONS="SELECT * FROM rezervacijasto";

private $SELECTCONFIRMEDRESERVATIONSBYID="SELECT * FROM rezervacijasto WHERE idrezervacije=?";

private $SELECTCONFIRMEDRESERVATIONSBYTABLEID="SELECT * FROM rezervacijasto WHERE idstola=?";

private $DELETERESERVATIONS="DELETE FROM rezervacijasto";

private $DELETERESERVATIONBYID="DELETE FROM rezervacijasto WHERE idrezervacije=?";

private $GETMEALBYID="SELECT * FROM jelovnik WHERE idjela=?";

private $GETDRINKBYID="SELECT * FROM kartapica WHERE idpica=?";

private $ADDMEAL="INSERT INTO jelovnik(nazivjela,opisjela,cenajela) VALUES (?,?,?)";

private $ADDDRINK="INSERT INTO kartapica(nazivpica,opispica,cenapica) VALUES (?,?,?)";

private $DELETEMEAL="DELETE FROM jelovnik WHERE idjela=?";

private $DELETEDRINK="DELETE FROM kartapica WHERE idpica=?";

private $GETLASTBILLNUMBER="SELECT brojracuna FROM racuni ORDER BY idracuna DESC LIMIT 1";

private $INSERTRACUN="INSERT INTO racuni(idstola,brojracuna,naziv,cena1,kolicina,cena2) VALUES (?,?,?,?,?,?)";

public function __construct(){
    $this->db=DB::createInstance();
}

public function getAllAvailableTableSeats(){

    $statement=$this->db->prepare($this->GETALLAVAILABLETABLESEATS);
    $statement->execute();

    $result=$statement->fetchAll();
    return $result;

}

public function insertReservation($imegosta, $prezimegosta, $vremerezervacije, $brojmesta){

    $statement=$this->db->prepare($this->INSERTRESERVATION);
    $statement->bindValue(1,$imegosta);
    $statement->bindValue(2,$prezimegosta);
    $statement->bindValue(3,$vremerezervacije);
    $statement->bindValue(4,$brojmesta);
    $statement->execute();
    
}

public function selectAllReservations(){

    $statement=$this->db->prepare($this->SELECTALLRESERVATIONS);
    $statement->execute();

    $result=$statement->fetchAll();
    return $result;

}

public function selectAllTables(){
    
    $statement=$this->db->prepare($this->SELECTALLTABLES);
    $statement->execute();

    $result=$statement->fetchAll();
    return $result;

}

public function getTableById($idstola){

    $statement=$this->db->prepare($this->GETTABLEBYID);
    $statement->bindValue(1,$idstola);
    $statement->execute();

    $result=$statement->fetchAll();
    return $result;
}

public function getTableById1($idstola1){

    $statement=$this->db->prepare($this->GETTABLEBYID);
    $statement->bindValue(1,$idstola1);
    $statement->execute();

    $result=$statement->fetchAll();
    return $result;
}

public function getReservationById($idrezervacije){

    $statement=$this->db->prepare($this->GETRESERVATIONBYID);
    $statement->bindValue(1,$idrezervacije);
    $statement->execute();

    $result=$statement->fetchAll();
    return $result;
}

public function changeTableStatus($idstola){

    $statement=$this->db->prepare($this->CHANGETABLESTATUS);
    $statement->bindValue(1,$idstola);
    $statement->execute();
}

public function changeTableStatus1($idstola1){

    $statement=$this->db->prepare($this->CHANGETABLESTATUS);
    $statement->bindValue(1,$idstola1);
    $statement->execute();
}

public function changeReservationStatus($idrezervacije){

    $statement=$this->db->prepare($this->CHANGERESERVATIONSTATUS);
    $statement->bindValue(1,$idrezervacije);
    $statement->execute();
}

public function assign($idstola,$idrezervacije){

    $statement=$this->db->prepare($this->ASSIGN);
    $statement->bindValue(1,$idstola);
    $statement->bindValue(2,$idrezervacije);
    $statement->execute();
}

public function assign1($idstola1 ,$idrezervacije){

    $statement=$this->db->prepare($this->ASSIGN);
    $statement->bindValue(1,$idstola1);
    $statement->bindValue(2,$idrezervacije);
    $statement->execute();
}

public function clearAllTables(){

    $statement=$this->db->prepare($this->CLEARALLTABLES);
    $statement->execute();

}

public function clearTable($idstola){

    $statement=$this->db->prepare($this->CLEARTABLE);
    $statement->bindValue(1,$idstola);
    $statement->execute();

}

public function login($username, $password){

        $statement=$this->db->prepare($this->LOGIN);
        $statement->bindValue(1,$username);
        $statement->bindValue(2,$password);
    
        $statement->execute();
        $result=$statement->fetch();
        return $result;
    
}

public function selectAllMeals(){

    $statement=$this->db->prepare($this->SELECTALLMEALS);
    $statement->execute();

    $result=$statement->fetchAll();
    return $result;

}

public function selectAllDrinks(){

    $statement=$this->db->prepare($this->SELECTALLDRINKS);
    $statement->execute();

    $result=$statement->fetchAll();
    return $result;

}

public function selectConfirmedReservations(){

    $statement=$this->db->prepare($this->SELECTCONFIRMEDRESERVATIONS);
    $statement->execute();

    $result=$statement->fetchAll();
    return $result;
}

public function selectConfiremedReservationsById($idrezervacije){
    $statement=$this->db->prepare($this->SELECTCONFIRMEDRESERVATIONSBYID);
    $statement->bindValue(1,$idrezervacije);
    $statement->execute();

    $result=$statement->fetchAll();
    return $result;
}

public function selectConfiremedReservationsByTableId($idstola){
    $statement=$this->db->prepare($this->SELECTCONFIRMEDRESERVATIONSBYTABLEID);
    $statement->bindValue(1,$idstola);
    $statement->execute();

    $result=$statement->fetchAll();
    return $result;
}

public function deleteReservations(){

    $statement=$this->db->prepare($this->DELETERESERVATIONS);
    $statement->execute();

}

public function deleteReservationById($idrezervacije){
    $statement=$this->db->prepare($this->DELETERESERVATIONBYID);
    $statement->bindValue(1,$idrezervacije);
    $statement->execute();
}

public function getMealById($idjela){

    $statement=$this->db->prepare($this->GETMEALBYID);
    $statement->bindValue(1,$idjela);
    $statement->execute();

    $result=$statement->fetchAll();
    return $result;

}

public function getDrinkById($idpica){

    $statement=$this->db->prepare($this->GETDRINKBYID);
    $statement->bindValue(1,$idpica);
    $statement->execute();

    $result=$statement->fetchAll();
    return $result;

}

public function addMeal($nazivjela,$opisjela,$cenajela){

    $statement=$this->db->prepare($this->ADDMEAL);
    $statement->bindValue(1,$nazivjela);
    $statement->bindValue(2,$opisjela);
    $statement->bindValue(3,$cenajela);
    $statement->execute();

}

public function addDrink($nazivpica,$opispica,$cenapica){

    $statement=$this->db->prepare($this->ADDDRINK);
    $statement->bindValue(1,$nazivpica);
    $statement->bindValue(2,$opispica);
    $statement->bindValue(3,$cenapica);
    $statement->execute();

}

public function deleteMeal($idjela){

    $statement=$this->db->prepare($this->DELETEMEAL);
    $statement->bindValue(1,$idjela);
    $statement->execute();

}

public function deleteDrink($idpica){

    $statement=$this->db->prepare($this->DELETEDRINK);
    $statement->bindValue(1,$idpica);
    $statement->execute();

}

public function getLastBillNumber(){

    $statement=$this->db->prepare($this->GETLASTBILLNUMBER);
    $statement->execute();

    $result=$statement->fetch();
    return $result;

}

public function insertRacun($idstola,$brojracuna,$naziv,$cena1,$kolicina,$cena2){

    $statement=$this->db->prepare($this->INSERTRACUN);
    $statement->bindValue(1,$idstola);
    $statement->bindValue(2,$brojracuna);
    $statement->bindValue(3,$naziv);
    $statement->bindValue(4,$cena1);
    $statement->bindValue(5,$kolicina);
    $statement->bindValue(6,$cena2);
    $statement->execute();



}




}




?>
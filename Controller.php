<?php
require_once '../model/DAO.php';

class Controller{

    public function showReservation(){
        include 'reservation.php';
    }

    public function reserve(){
        $imegosta=isset($_GET['imegosta'])?$_GET['imegosta']:"";
        $prezimegosta=isset($_GET['prezimegosta'])?$_GET['prezimegosta']:"";
        $vremerezervacije=isset($_GET['vremerezervacije'])?$_GET['vremerezervacije']:"";
        $brojmesta=isset($_GET['brojmesta'])?$_GET['brojmesta']:"";

        $errors=array();

        $dao = new DAO();
        $stolovi = $dao->selectAllTables();
        
        $i=0;
        foreach($stolovi as $s){
            if($s['dostupnost']==0){
                $i=$i+$s['brojmesta'];
            }
        }

        if(empty($imegosta)){
            $errors['imegosta']='Morate uneti ime gosta.';
        }  

        if(empty($prezimegosta)){
            $errors['prezimegosta']='Morate uneti prezime gosta.';
        }  

        if(!empty($vremerezervacije)){
            if(is_numeric($vremerezervacije)){
                
            }else{
                $errors['vremerezervacije']="Morate uneti numericku vrednost.";
            }
        }else{
            $errors['vremerezervacije']='Morate odabrati vreme rezervacije.';
        }

        if(!empty($brojmesta)){
            if(is_numeric($brojmesta)){
                if($brojmesta<=10){
                    if($brojmesta<=$i){

                    }else{
                        $errors['brojmesta']="Broj trazenih mesta je veci od broj dostupnih mesta,<br> trenutni broj slobodnih mesta je $i,<br> ukoliko zelite da rezervisete sto/love unesite broj manji ili jednak tom.";
                    }
                }else{
                    $errors['brojmesta']="Maksimalan broj mesta za rezervisanje je 10.";
                }
            }else{
                $errors['brojmesta']='Morate uneti numericku vrednost.';
            }
        }else{
            $errors['brojmesta']='Morate uneti broj zeljenih mesta.';
        }

        if(count($errors)==0){

            $dao = new DAO();

            $dao->insertReservation($imegosta, $prezimegosta, $vremerezervacije, $brojmesta);

            $msg="Uspesna rezervacija.";
            
            include 'index.php';
            
        }else{
            
            include 'reservation.php';

            

        }
    }

    public function prikaziPotvrdu(){

        $dao = new DAO();

        $rezervacije = $dao->selectAllReservations();
        $stolovi = $dao->selectAllTables();

        $prvi=array_slice($stolovi,0,4);
        $drugi=array_slice($stolovi,4,4);
        $treci=array_slice($stolovi,8,4);

        include 'confirmreservation.php';
    }

    public function potvrda2(){

        $idstola=isset($_GET['idstola'])?$_GET['idstola']:"";
        $idrezervacije=isset($_GET['idrezervacije'])?$_GET['idrezervacije']:"";

        $dao = new DAO();

        $sto=$dao->getTableById($idstola);
        $rezervacija=$dao->getReservationById($idrezervacije);

        $s=$sto[0]; //iz niza nizova uzimam jedini jedni jer ne znam kako da mu pristupm bez razlaganja
        if($rezervacija) $r=$rezervacija[0]; //ako postoji $rezervacija ubacije u $r

        if($idrezervacije){
            if($r['brojmesta']<=$s['brojmesta']){ //broj trazenih mesta manji od broja postojecih mesta

                include 'confirmation.php';

            }else{

                $msg="Broj trazenih mesta je veci od broja mesta za izabrnaim stolom, odaberite jos jedan sto za odabran zahtev:";

                $dao= new DAO();

                $dao->changeTableStatus($idstola);

                $stolovi = $dao->selectAllTables();

                $prvi=array_slice($stolovi,0,4);
                $drugi=array_slice($stolovi,4,4);
                $treci=array_slice($stolovi,8,4);

                include 'anothertable.php';

            }
        
        }else{
            $msg="Morate izabrati rezervaciju.";

            $dao = new DAO();

        $rezervacije = $dao->selectAllReservations();
        $stolovi = $dao->selectAllTables();

        $prvi=array_slice($stolovi,0,4);
        $drugi=array_slice($stolovi,4,4);
        $treci=array_slice($stolovi,8,4);

            include 'confirmreservation.php';
        }
    }

    public function potvrda3(){

        
        $idstola=isset($_GET['idstola'])?$_GET['idstola']:"";
        $idrezervacije=isset($_GET['idrezervacije'])?$_GET['idrezervacije']:"";
        $idstola1=isset($_GET['idstola1'])?$_GET['idstola1']:"";

        $dao = new DAO();

        $sto=$dao->getTableById($idstola);
        $sto1=$dao->getTableById1($idstola1);
        $rezervacija=$dao->getReservationById($idrezervacije);

        //var_dump($sto);
        //var_dump($idstola1);
        //var_dump($idrezervacije);

        $s=$sto[0];
        $s1=$sto1[0];
        $r=$rezervacija[0];

        $dostupno=$s['brojmesta']+$s1['brojmesta'];

        if($r['brojmesta']<=$dostupno){

            include 'confirmation2.php';

        }else{

            $msg="Broj trazenih mesta je veci od broja mesta za izabrnaim stolom, molimo odaberite drugi sto.";
            
            $dao= new DAO();

            $dao->changeTableStatus($idstola);

            $stolovi = $dao->selectAllTables();

            $prvi=array_slice($stolovi,0,4);
            $drugi=array_slice($stolovi,4,4);
            $treci=array_slice($stolovi,8,4);

            include 'anothertable.php';
        
        }
    }

    

    public function confirmReservation(){

        $idstola=isset($_GET['idstola'])?$_GET['idstola']:"";
        $idrezervacije=isset($_GET['idrezervacije'])?$_GET['idrezervacije']:"";

        $dao = new DAO();

        $dao->assign($idstola,$idrezervacije);
        $dao->changeTableStatus($idstola);
        $dao->changeReservationStatus($idrezervacije);

        $msg="Uspesna potvrda";
        include 'index.php';
        

    }

    public function confirmReservationMultiple(){

        $idstola=isset($_GET['idstola'])?$_GET['idstola']:"";
        $idstola1=isset($_GET['idstola1'])?$_GET['idstola1']:"";
        $idrezervacije=isset($_GET['idrezervacije'])?$_GET['idrezervacije']:"";

        $dao = new DAO();

        $dao->assign($idstola,$idrezervacije);
        $dao->assign1($idstola1,$idrezervacije);
        $dao->changeTableStatus1($idstola1);
        $dao->changeReservationStatus($idrezervacije);

        $msg="Uspesna rezervacija.";

        include 'index.php';




    }

    public function showTables(){

        $dao = new DAO();

        $stolovi = $dao->selectAllTables();

        $prvi=array_slice($stolovi,0,4);
        $drugi=array_slice($stolovi,4,4);
        $treci=array_slice($stolovi,8,4);

        include 'tables.php';

    }

    public function login(){

        $username=isset($_POST['username'])?$_POST['username']:"";
        $password=isset($_POST['password'])?$_POST['password']:"";

        if(!empty($username)&&!empty($password)){

            $dao = new DAO();

            $admin=$dao->login($username, $password);
            
            if($admin){

                session_start();

                $_SESSION['ulogovan']=$admin;
                
                header('Location:index.php');

            }else{

                $msg="Pogresan username ili password.";

                include 'login.php';
            }

        }else{

            $msg="Morate uneti username i password.";

            include 'login.php';
        }
    }

    public function prikaziLogin(){

        include 'login.php';

    }

    public function logout(){

        session_start();
        session_destroy();
        header('Location:index.php');
    }

    public function showMenu(){

        $dao = new DAO();
        $jela=$dao->selectAllMeals();
        $pica=$dao->selectAllDrinks();

        include 'meni.php';
    }

    public function showReservations(){

        $dao = new DAO();
        $potvrdjene=$dao->selectConfirmedReservations();
        
        include 'confirmedreservations.php';

    }

    public function deleteReservations(){

        $dao = new DAO();
        $dao->deleteReservations();
        $dao->clearAllTables();
        $potvrdjene=$dao->selectConfirmedReservations();
        include 'confirmedreservations.php';
    }

    public function deleteReservation(){

        $idrezervacije=isset($_GET['idrezervacije'])?$_GET['idrezervacije']:"";

        //var_dump($idrezervacije);

        $dao = new DAO();
        $rezervacije=$dao->selectConfiremedReservationsById($idrezervacije);
        $dao->deleteReservationById($idrezervacije);
        foreach($rezervacije as $r){
            $idstola=$r['idstola'];
            $dao->clearTable($idstola);
        }

        $msg="Rezervacija obrisana.";
        $potvrdjene=$dao->selectConfirmedReservations();
        include 'confirmedreservations.php';

    }

    public function saberiRacun(){
        $idjela=isset($_GET['idjela'])?$_GET['idjela']:"";
        $koljela=isset($_GET['koljela'])?$_GET['koljela']:"";
        $idpica=isset($_GET['idpica'])?$_GET['idpica']:"";
        $kolpica=isset($_GET['kolpica'])?$_GET['kolpica']:"";

        /*var_dump($idjela);
        echo "<br><br>";
        var_dump($koljela);
        echo "<br><br>";
        var_dump($idpica);
        echo "<br><br>";
        var_dump($kolpica);*/

        $j=0;

        $izabranajela=array();

        $totaljela=array();

        foreach($idjela as $idj){

            $dao = new DAO();

            $jelo=$dao->getMealById($idj);

            if($koljela[$j]>0){

            $sum=$jelo[0]['cenajela']*$koljela[$j];

            $totaljela[]=$sum;

            $izabranajela[]=array("nazivjela"=>$jelo[0]['nazivjela'],
                                "opisjela"=>$jelo[0]['opisjela'],
                                "cenajela"=>$jelo[0]['cenajela'],
                                "kolicina"=>$koljela[$j],
                                "ukupnacena"=>$sum);

            }
            $j++;

        }

        $p=0;

        $izabranapica=array();

        $totalpica=array();

        foreach($idpica as $idp){

            $dao = new DAO();

            $pice=$dao->getDrinkById($idp);

            if($kolpica[$p]>0){

            $sum=$pice[0]['cenapica']*$kolpica[$p];

            $totalpica[]=$sum;

            $izabranapica[]=array("nazivpica"=>$pice[0]['nazivpica'],
                                  "opispica"=>$pice[0]['opispica'],
                                  "cenapica"=>$pice[0]['cenapica'],
                                  "kolicina"=>$kolpica[$p],
                                  "ukupnacena"=>$sum);

            }
            $p++;

        }

        $cj=0;

        foreach($totaljela as $pom){

            $cj=$cj+$pom;

        }

        $cp=0;

        foreach($totalpica as $pom){

            $cp=$cp+$pom;

        }

        $total=$cj+$cp;

        include 'sum.php';




    }

    public function addMeal(){

        $nazivjela=isset($_GET['nazivjela'])?$_GET['nazivjela']:"";
        $opisjela=isset($_GET['opisjela'])?$_GET['opisjela']:"";
        $cenajela=isset($_GET['cenajela'])?$_GET['cenajela']:"";

        $errors=array();

        if(empty($nazivjela)){ $errors['nazivjela']="Morate uneti naziv jela.";}
            
        if(empty($opisjela)){ $errors['opisjela']="Morate uneti opis jela.";}
                
        if(empty($cenajela)||!is_numeric($cenajela)){ 
            
            $errors['cenajela']="Morate uneti cenu kao numericku vrednost.";
        
        }

        if(count($errors)==0){

            $dao = new DAO();

            $dao->addMeal($nazivjela,$opisjela,$cenajela);

            $jela=$dao->selectAllMeals();
            $pica=$dao->selectAllDrinks();

            $msg="Jelo uspesno dodato u jelovnik.";

            include 'meni.php';

        }else{
            
            $dao = new DAO();
            $jela=$dao->selectAllMeals();
            $pica=$dao->selectAllDrinks();

            include 'meni.php';
        }

    }

    public function addDrink(){

        $nazivpica=isset($_GET['nazivpica'])?$_GET['nazivpica']:"";
        $opispica=isset($_GET['opispica'])?$_GET['opispica']:"";
        $cenapica=isset($_GET['cenapica'])?$_GET['cenapica']:"";

        $errors1=array();

        if(empty($nazivpica)){ $errors1['nazivpica']="Morate uneti naziv pica.";}
            
        if(empty($opispica)){ $errors1['opispica']="Morate uneti opis pica.";}
                
        if(empty($cenapica)||!is_numeric($cenapica)){ 
            
            $errors1['cenapica']="Morate uneti cenu kao numericku vrednost.";
        
        }

        if(count($errors1)==0){

            $dao = new DAO();

            $dao->addDrink($nazivpica,$opispica,$cenapica);

            $jela=$dao->selectAllMeals();
            $pica=$dao->selectAllDrinks();

            $msg1="Pice uspesno dodato u kartu pica.";

            include 'meni.php';

        }else{
            
            $dao = new DAO();
            $jela=$dao->selectAllMeals();
            $pica=$dao->selectAllDrinks();

            include 'meni.php';
        }
    }

    public function deleteMeal(){

        $idjela=isset($_GET['idjela'])?$_GET['idjela']:"";

        //var_dump($idjela);

        $dao = new DAO();

        if($idjela){

            $dao->deleteMeal($idjela);

            $msg="Jelo obrisano.";

            $jela=$dao->selectAllMeals();
            $pica=$dao->selectAllDrinks();

            include 'meni.php';

        }

    }

    public function deleteDrink(){

        $idpica=isset($_GET['idpica'])?$_GET['idpica']:"";

        //var_dump($idpica);

        $dao = new DAO();

        if($idpica){

            $dao->deleteDrink($idpica);

            $msg1="Pice obrisano.";

            $jela=$dao->selectAllMeals();
            $pica=$dao->selectAllDrinks();

            include 'meni.php';

        }

    }

    







    public function showTable(){

        $idstola=isset($_GET['idstola'])?$_GET['idstola']:"";

        session_start();

        if(!isset($_SESSION['table'.$idstola])){

            $_SESSION['table'.$idstola]=array();

            include '../view/table.php';

        }else{

            include '../view/table.php';

        }

    }

    public function showJela(){

        $idstola=isset($_GET['idstola'])?$_GET['idstola']:"";

        $showJela=1;

        $showPica=0;

        $dao = new DAO();

        $jela=$dao->selectAllMeals();

        session_start();

        include '../view/table.php';
    }

    public function izaberiJelo(){

        $showJela=isset($_GET['showJela'])?$_GET['showJela']:"";
        $showPica=isset($_GET['showPica'])?$_GET['showPica']:"";
        
        $dao = new DAO();

        $jela=$dao->selectAllMeals();
        $pica=$dao->selectAllDrinks();

        $idstola=isset($_GET['idstola'])?$_GET['idstola']:"";
        $idjela=isset($_GET['idjela'])?$_GET['idjela']:"";
        $koljela=isset($_GET['koljela'])?$_GET['koljela']:"";

        $jelo=$dao->getMealById($idjela);

        if($koljela>0){

        $cena=$koljela*$jelo[0]['cenajela'];

        //var_dump($cena);
        
        foreach($jelo as $jelo){
            $meal=array("naziv"=>$jelo['nazivjela'],"opis"=>$jelo['opisjela'],"cena1"=>$jelo['cenajela'],"kolicina"=>$koljela,"cena2"=>$cena);
        }

        //var_dump($meal);    

        if($meal){

            session_start();

            $_SESSION['table'.$idstola][]=$meal;

            include '../view/table.php';
            
        }

        }else {

            $msg="Molimo unesite kolicinu.";

            session_start();
            
            include '../view/table.php';

        }

    }

    public function showPica(){

        $idstola=isset($_GET['idstola'])?$_GET['idstola']:"";

        $showJela=0;

        $showPica=1;

        $dao = new DAO();

        $pica=$dao->selectAllDrinks();

        session_start();    

        include '../view/table.php';
    }

    public function izaberiPice(){

        $showJela=isset($_GET['showJela'])?$_GET['showJela']:"";
        $showPica=isset($_GET['showPica'])?$_GET['showPica']:"";

        $dao = new DAO();

        $jela=$dao->selectAllMeals();
        $pica=$dao->selectAllDrinks();

        $idstola=isset($_GET['idstola'])?$_GET['idstola']:"";
        $idpica=isset($_GET['idpica'])?$_GET['idpica']:"";
        $kolpica=isset($_GET['kolpica'])?$_GET['kolpica']:"";

        $pice=$dao->getDrinkById($idpica);

        if($kolpica>0){

        $cena=$kolpica*$pice[0]['cenapica'];

        //var_dump($cena);
        
        foreach($pice as $pice){
            $drink=array("naziv"=>$pice['nazivpica'],"opis"=>$pice['opispica'],"cena1"=>$pice['cenapica'],"kolicina"=>$kolpica,"cena2"=>$cena);
        }

        //var_dump($meal);    

        if($drink){

            session_start();

            $_SESSION['table'.$idstola][]=$drink;

            include '../view/table.php';
            
        }

        }else {

            $msg="Molimo unesite kolicinu.";

            session_start();
            
            include '../view/table.php';

        }

    }

    public function showTableBill(){

        $idstola=isset($_GET['idstola'])?$_GET['idstola']:"";

        session_start();

        $racun=$_SESSION['table'.$idstola];

        include '../view/tablebill.php';

    }

    public function finishBill(){

        $idstola=isset($_GET['idstola'])?$_GET['idstola']:"";

        session_start();

        $racun=$_SESSION['table'.$idstola];

        //var_dump($racun);

        $dao = new DAO();

        $brojracunaarray=$dao->getLastBillNumber();

        if(empty($brojracunaarray)){

            $brojracuna=1;

        }else{

        $brojracuna=$brojracunaarray['brojracuna'];

        $brojracuna++;

        }

        if(!empty($idstola)&&!empty($brojracuna)&&!empty($racun)){

            foreach($racun as $r){
        
                $dao->insertRacun($idstola,$brojracuna,$r['naziv'],$r['cena1'],$r['kolicina'],$r['cena2']);

                //OBRISATI SESIJU I ODSTAMPATI RACUN. POGLEDATI DA LI NEGDE FALI NAZAD. POSLATI SUZANI ZA BOOTSTRAP.

                
            }

            unset($_SESSION['table'.$idstola]);

            include '../view/bill.php';

        }else{

            $msg="Greska pri stampanju racuna, pokusajte ponovo ili pozovite nadlezno lice.";

            $dao = new DAO();

            include '../view/table.php';
        }

       


    }

  
}




?>
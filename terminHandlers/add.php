<?php
require "../model/Termin.php";
require '../DbBroker.php';


$broker=DbBroker::getBroker();

if(isset($_POST['usluga']) && isset($_POST['klijent']) 
&& isset($_POST['datum']) && isset($_POST['lokacija'])){
    $termin = new Termin(null,$_POST['usluga'],$_POST['klijent'],$_POST['datum'],$_POST['lokacija'] );
    $rezultat = Termin::add($termin, $broker);

    if(!$rezultat){
        echo $broker->getMysqli()->error;
     }else{ 
         echo '1';
     }
}




?>
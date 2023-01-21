<?php

require "../model/Usluga.php";
require '../DbBroker.php';

$broker=DbBroker::getBroker();

if(isset($_POST['naziv']) && isset($_POST['radnik']) && isset($_POST['id'])) {

    $uslugaKojaSeMenja = new Usluga($_POST['id'], null, null);
    $uslugaKojomSeMenja = new Usluga(null,$_POST['naziv'],$_POST['radnik']);
    $rezultat = $uslugaKojaSeMenja->update($uslugaKojomSeMenja, $broker);

    if(!$rezultat){
        echo $broker->getMysqli()->error;
        
     }else{
         echo '1';
     }
}

?>
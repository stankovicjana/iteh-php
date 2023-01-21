<?php

require "../Broker.php";
require "../model/Termin.php";

$broker=Broker::getBroker();

if(isset($_POST['usluga']) && isset($_POST['klijent']) 
&& isset($_POST['datum']) && isset($_POST['lokacija']) && isset($_POST['id'])) {

    $terminKojiSeMenja = new Termin($_POST['id']);
    $terminKojimSeMenja = new Termin(null,$_POST['usluga'],$_POST['klijent'],$_POST['datum'],$_POST['lokacija']);
    $rezultat = $terminKojiSeMenja->update($terminKojimSeMenja, $broker);

    if(!$rezultat){
        echo $broker->getMysqli()->error;
     }else{ 
         echo '1';
     }
}

?>
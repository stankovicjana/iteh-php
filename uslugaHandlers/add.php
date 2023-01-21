<?php

require "../DbBroker.php";
require "../model/Usluga.php";

$broker=DbBroker::getBroker();

if(isset($_POST['naziv']) && isset($_POST['radnik'])) {
    
    $usluga = new Usluga(null,$_POST['naziv'],$_POST['radnik']);
    $rezultat = Usluga::add($usluga, $broker);

    if(!$rezultat){
        echo $broker->getMysqli()->error;
     }else{ 
         echo '1';
     }
}


?>
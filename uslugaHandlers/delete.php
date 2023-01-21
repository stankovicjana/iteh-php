<?php

require "../model/Usluga.php";
require '../DbBroker.php';

$broker=DbBroker::getBroker();

if(isset($_POST['id'])){
    $usluga = new Usluga($_POST['id']);
    $rezultat = $usluga->deleteById($broker);
    if(!$rezultat){
        echo $broker->getMysqli()->error;
     }else{
         echo '1';
     }
}

?>
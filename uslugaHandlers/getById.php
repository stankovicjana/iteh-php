<?php

require "../model/Usluga.php";
require '../DbBroker.php';

$broker=DbBroker::getBroker();

if(isset($_GET['id'])){
    $resultSet = Usluga::getById($_GET['id'], $broker);
    $response=[];

    if(!$resultSet){
    $response['status']=0;
    $response['greska']=$broker->getMysqli()->error;
    } 
    else{
    $response['status']=1;
    $response['usluga']=$resultSet->fetch_object();
    
}
    echo json_encode($response);
}

?>
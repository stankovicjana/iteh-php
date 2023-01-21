<?php

require "../model/Usluga.php";
require '../DbBroker.php';

$broker=DbBroker::getBroker();

    $resultSet = Usluga::getAll($broker);
    $response=[];

    if(!$resultSet){
    $response['status']=0;
    $response['greska']=$broker->getMysqli()->error;
    } 
    else{
    $response['status']=1;
    while($row=$resultSet->fetch_object()){
        $response['usluge'][]=$row;
    }
}
    echo json_encode($response);


?>
<?php

require "../model/Radnik.php";
require '../DbBroker.php';

$broker=DbBroker::getBroker();

    $resultSet = Radnik::getAll($broker);
    $response=[];

    if(!$resultSet){
    $response['status']=0;
    $response['greska']=$broker->getMysqli()->error;
    } 
    else{
    $response['status']=1;
    while($row=$resultSet->fetch_object()){
        $response['radnici'][]=$row;
    }

    echo json_encode($response);
}

?>
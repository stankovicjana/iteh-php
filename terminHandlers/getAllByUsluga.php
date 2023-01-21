<?php
require "../model/Termin.php";
require '../DbBroker.php';


$broker=DbBroker::getBroker();

if(isset($_GET['id'])){
    $resultSet = Termin::getAllByUsluga($_GET['id'], $broker);
    $response=[];

    if(!$resultSet){
    $response['status']=0;
    $response['greska']=$broker->getMysqli()->error;
    } 
    else{
    $response['status']=1;
    while($row=$resultSet->fetch_object()){
        $response['termini'][]=$row;
    }
}
    echo json_encode($response);
}




?>
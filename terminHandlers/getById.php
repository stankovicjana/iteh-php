<?php
require "../model/Termin.php";
require '../DbBroker.php';


$broker=DbBroker::getBroker();

if(isset($_POST['id'])){
    $resultSet = Termin::getById($_POST['id'], $broker);
    $response=[];

    if(!$resultSet){
    $response['status']=0;
    $response['greska']=$broker->getMysqli()->error;
    } 
    else{
    $response['status']=1;
    while($row=$resultSet->fetch_object()){
        $response['termin'][]=$row;
    }
}
    echo json_encode($response);
}



?>
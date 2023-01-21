<?php

require "Broker.php";
require "model/Termin.php";

session_start();

//$conn je u dbBrokeru
$rezultat = Termin::getAll2($conn);
if(!$rezultat){
    echo "Nastala je greska prilikom izvodjenja upita <br>";
    die(); //isto sto i exit
}
if($rezultat->num_rows==0){
    echo"Nema termina";
    die();
}
else{


?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <link rel="shortcut icon" >
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="index.css">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
    crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
    integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>Dubinsko ciscenje</title>

</head>

<body>
<!--MODALI -->




    <div class='centerDiv'>
        <div class='left_div grid-item'></div>
        <div class='middle_div grid-item p-12'>
             <div class='h_div'>
             <h1 class='h1_text'>Usluge</h1>
             </div>
            <div id="pregled" class="panel panel-success" style="margin-top: 1%;">
                 <div class="panel-body">
                 <table id="myTable" class="table table-hover table-striped" style="color: black; background-color: grey;" >

                     <thead class ="thead">
                    <tr>
                      <th scope="col">Usluga</th>
                      <th scope="col">Klijent</th>    
                      <th scope="col">Lokacija</th>
                      <th scope="col">Datum</th>
                    </tr>
                    </thead>
            <tbody>
            <?php
            //fetch array ili fetch all isto je; vraca info iz baze u okviru niza
            while ($red = $rezultat->fetch_array()):
            ?>
                <tr>
                    <td><?php echo $red["usluga"] ?></td>
                    <td><?php echo $red["klijent"] ?></td>
                    <td><?php echo $red["lokacija"] ?></td>
                    <td><?php echo $red["datum"] ?></td>

                </tr>
            <?php
            endwhile;
            } //zatvaranje elsa
            ?>
            </tbody>
                </table>
        
            </div>
        </div>
        <div class="button_div1">
            <button data-toggle="modal" data-target="#exampleModal" type="button" data-backdrop="static"
            class="btn btn-secondary btn-lg btn-block">NOVA USLUGA</button>
        </div>
    </div>

        <div class='right_div grid-item'></div>

</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="script.js"></script>



</body>
</html>

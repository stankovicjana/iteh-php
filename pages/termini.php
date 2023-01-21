<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Termini usluga</title>
  <link rel="stylesheet" href="index.css">
  <link rel="stylesheet" type="text/css" href="header.css">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
    crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
    integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>


<div class="header">
  <a href="#default" class="logo">Početna</a>
  <div class="header-right">
  <a class="active" href="index.php">Početna</a>
  <a href="izmena.php">Izmeni uslugu</a>
    <a href="termini.php">Zauzeti termini</a>
  </div>
</div>
<div class='centerDiv'>
    <div class='left_div grid-item'> </div>

    <div class='middle_div grid-item p-12'>
        <div class='h_div'>
            <h1 class='h1_text'>Zauzeti termini</h1>
            <br>
            <hr>
        </div>
        <div class="d-flex flex-row justify-content-center">
        <div class="d-flex flex-column col-3 align-items-center">
                <label> Pretrazi po lokaciji</label>
                <input class="text-center" type="text" id="lokacija" onkeyup="fjaZaPretragu2()" placeholder="Pretrazi lokacije">
        </div>
        <div class="d-flex flex-column col-3 align-items-center">
                <label> Sortiraj po datumu</label>
                <select id='sortiraj' class='form-control text-center'>
                    <option value="asc"> Najskorije</option>
                    <option value="desc">Najdalje</option>
                </select>
        </div>
        <div class="d-flex flex-column col-3 align-items-center">
                <label> Pretrazi po datumu</label>
                <input class="text-center" type="text" id="datum" onkeyup="fjaZaPretragu()" placeholder ="Pretrazi termine">
        </div>
       
        </div>
        <div class='table_div'>
            <table class="table">
                <thead class="thead-red" style="background-color:grey;">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Usluga</th>
                    <th scope="col">Klijent</th>
                    <th scope="col">Datum</th>
                    <th scope="col">Lokacija</th>
                </th>
                </thead>
                <tbody id='termini'></tbody>
            </table>

                
        </div>
       
    </div>
    

</div>


<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
 integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
 crossorigin="anonymous">
    </script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script>

    let termini = [];
    let terminiFiltrirano = [];

    

    $(document).ready(function(){

        $.getJSON('../terminHandlers/getAll.php', function (data) {
        console.log(termini);
        if (!data.status) {
          alert(data.greska);
          return;
        }
        termini = data.termini;

        termini.sort(function (a, b) {
          return a.datum.localeCompare(b.datum);

        })
        
        napuniTabelu(termini);
      });

      
      $('#sortiraj').change(function () {
        const option = $('#sortiraj').val();
        if (option === 'asc') {
          termini.sort(function (a, b) {
            return a.datum.localeCompare(b.datum);

          })
        } else {
          termini.sort(function (a, b) {
            console.log(b.marka_naziv);
            return b.datum.localeCompare(a.datum);
          })
        }

        napuniTabelu(termini);
      })


    })

    //FJE
    
  // Definicije funkcija
    
    function fjaZaPretragu() {
      input = document.getElementById("datum");
      filter = input.value;
      terminiFiltrirano = termini;

      if(filter != "") {
        terminiFiltrirano = termini.filter((element) => element.datum == filter);
      }
      napuniTabelu(terminiFiltrirano);
    }

    function fjaZaPretragu2() {
      input = document.getElementById("lokacija");
      filter = input.value;
      terminiFiltrirano = termini;

      if(filter != "") {
        terminiFiltrirano = termini.filter((element) => element.lokacija == filter);
      }
      napuniTabelu(terminiFiltrirano);
      console.log(terminiFiltrirano);
    }

    function napuniTabelu(niz) {
      $('#termini').html('');
      let i = 0;
      for (let termin of niz) {
        $('#termini').append(`
            <tr>
              <td>${++i}</td>
              <td>${termin.usluga_naziv}</td>
              <td>${termin.klijent}</td>
              <td>${termin.datum}</td>
              <td>${termin.lokacija}</td>
            </tr>
          `)
      }
    }

    function vratiTermine() {
      $.getJSON('../terminHandlers/getAllByUsluga.php', { id: usluga.id }, function (data) {
        if (data.status != 1) {
          alert(data.greska);
          return;
        }
        $("#terminiDodaj").html(data);
        terminiDodaj = data.terminiDodaj;
        terminiDodaj.sort(function (a, b) {
          return a.datum.localeCompare(b.datum);

        })
        napuniTabeluTermina();
      })
    }

    

 
 </script>




</body>
</html>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dubinsko ciscenje</title>
  <link rel="stylesheet" type="text/css" href="index.css">
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

  <!-- Modal za dodavanje -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Dodavanje nove usluge</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <!-- sadrzaj modala -->
          <form>
            <div class="form-group">
              <label for="naziv_usluge_dodaj">Naziv usluge:</label>
              <input type="text" class="form-control" id="naziv_usluge_dodaj" placeholder="" required>
            </div>
            <div class="form-group">
              <label for="radnik_dodaj">Radnik:</label>
              <select class="form-control" id="radnik_dodaj" placeholder="" required>

              </select>
            </div>
            <fieldset disabled>
              <div class="form-group">
                <label for="broj_termina_dodaj">Broj poslova:</label>
                <input type="text" id="broj_termina_dodaj" class="form-control" placeholder="0">
              </div>
            </fieldset>
            
          </form>

        </div>
        <div class="modal-footer align_center">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" style="background-color:  #66e0ff;">Zatvori</button>
          <button type="button" class="btn btn-primary" data-dismiss="modal" id="button_dodaj" style="background-color: #008fb3;">Dodaj</button>
        </div>
      </div>
    </div>
  </div>

  <div class="header">
  <a href="#default" class="logo">Početna</a>
  <div class="header-right">
  <a class="active" href="index.php">Početna</a>
    <a href="izmena.php">Izmeni uslugu</a>
    <a href="termini.php">Zauzeti termini</a>
  </div>
</div>

<div class='centerDiv'>

    <div class='left_div grid-item'>
    </div>
    <div class='middle_div grid-item p-12'>
      <div class='h_div'>
        <h1 class='h1_text'>Usluge</h1>
      </div>
      <div class='table_div table-hover'>
        <table class="table">
          <thead class="thead-red" style="background-color: grey;">
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Usluga</th>
              <th scope="col">Radnik</th>
              <th scope="col">Broj poslova</th>
            </tr>
          </thead>
          <tbody id='usluge'>


          </tbody>
        </table>
      </div>
      <div class="button_div1">
        <button data-toggle="modal" data-target="#exampleModal" type="button" data-backdrop="static"
          class="btn btn-secondary btn-lg btn-block">DODAJ NOVU USLUGU</button>
      </div>

    </div>

    <div class='right_div grid-item'>

    </div>

  </div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js">
</script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
 integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
 crossorigin="anonymous">
    </script>

<script>

let usluge=[];
let radnici = [];
let trenutniID = -1;

$(document).ready(function(){

    ucitajUsluge();
    ucitajRadnike();


      // Modal za dodavanje radnika
      $('#exampleModal').on('show.bs.modal', function (e) {
        $('#radnik_dodaj').html('');
        for (let radnik of radnici) {
          $('#radnik_dodaj').append(`
            <option value='${radnik.id}'>${radnik.imePrezime}</option>
          `)
        }
      })
    // Dugme za dodavanje
    $('#button_dodaj').click(function (e) {
        const naziv = $('#naziv_usluge_dodaj').val();
        if(naziv === "") {
            alert("Morate uneti naziv usluge!");
            return false;
        }
        const regex = '/^([^0-9]*)$/';
        if(naziv===1) {
          alert("Naziv usluge ne sme sadrzati cifre!");
            return false;
        }
        else {
            const radnik = $('#radnik_dodaj').val();
            $.post('../uslugaHandlers/add.php', { naziv: naziv, radnik: radnik }, function (data) {
            console.log(data);
            if (data != 1) {
            alert(data);
            return;
          }
          ucitajUsluge();
        })
        }
      })

})

//FJE

  // Definicije funkcija
  function ucitajRadnike() {
      $.getJSON('../radnikHandlers/getAll.php', function (data) {
        if (!data.status) {
          alert(data.greska);
          return;
        }
        radnici = data.radnici;
        console.log(radnici);
      })
    }

function ucitajUsluge() {
      $.getJSON('../uslugaHandlers/getAll.php', function (data) {
        if (!data.status) {
          alert(data.greska);
          return;
        }
        console.log(data.usluge)
        usluge = data.usluge;
        iscrtajTabelu();
      })
    }

    function iscrtajTabelu() {
      $('#usluge').html('');
      let index = 1;
      for (let usluga of usluge) {
        $('#usluge').append(`
          <tr data-toggle="modal" data-target="#exampleModal2" data-backdrop="static" data-id=${usluga.id}  >
              <th scope="row">${index++}</th>
              <td>${usluga.naziv}</td>
              <td>${usluga.radnik_imePrezime}</td>
              <td>${usluga.broj_termina}</td>
            </tr>
          `)
      }
    }


</script>


  </body>


</html>
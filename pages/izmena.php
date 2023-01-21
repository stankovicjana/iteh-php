<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Izmena</title>
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

  <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby ="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Izmena usluge</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

        <form>
            <div class="form-group centered">
              <label for="naziv_usluge">Naziv usluge:</label>
              <input type="text" class="form-control" id="naziv_usluge" value='' required>
            </div>
            <div class="form-group">
              <label for="radnik_novi">Radnik:</label>
              <select type="text" class="form-control" id="radnik_novi" value='' required></select>
            </div>
            <fieldset disabled>
              <div class="form-group">
                <label for="broj_termina">Broj termina</label>
                <!--placeholder/value -->
                <input type="text" id="broj_termina" class="form-control" placeholder="0">
              </div>
            </fieldset>
            <div class="d-grid gap-2">
              <a href='./rezervisi.php' id='sviTermini'><button class="btn btn-warning" style="background: eeeee4 ;" type="button">Svi termini</button></a>
            </div>
          </form>
  </div>
  <div class="modal-footer align_center">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" style="background-color: #b6c059;">Zatvori</button>
          <button type="button" class="btn btn-primary" data-dismiss="modal" id="button_sacuvaj" style="background-color: #7d8f01;">Sacuvaj</button>
          <button type='button' class="btn btn-danger" data-dismiss="modal" id="button_delete" style="background-color: #404902;">Obrisi</button>
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
     

    </div>

    <div class='right_div grid-item'>

    </div>

  </div>

</div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
    crossorigin="anonymous"></script>
<script>

let usluge = [];
let radnici = [];
let trenutniId = -1;

$(document).ready(function(){
  ucitajUsluge();
  ucitajRadnike();


   // Dugme za cuvanje izmena
   $('#button_sacuvaj').click(function () {
        if (trenutniId == -1) {
          return;
        }
        const naziv = $('#naziv_usluge').val();
        if(naziv === "") {
            alert("Morate uneti naziv usluge!");
            return false;
        }
   
        const radnik = $('#radnik_novi').val();

        $.post('../uslugaHandlers/update.php', { id: trenutniId, naziv: naziv, radnik: radnik }, function (data) {
          console.log(data);
          if (data != 1) {
            alert(data);
            return;
          }
          ucitajUsluge();
          trenutniId = -1;
        })

     

      })

  
      // Dugme za brisanje
      $('#button_delete').click(function () {
        if (trenutniId == -1) {
          return;
        }
        $.post('../uslugaHandlers/delete.php', { id: trenutniId }, function (data) {
          if (data != 1) {
            alert(data);
            return;
          }
          console.log({ trenutniId: trenutniId });
          if (data == 1) {
            console.log('filter')
            usluge = usluge.filter(function (elem) { return elem.id != trenutniId });
            iscrtajTabelu();
          }

          trenutniId = -1;
        })
      })




//Modal za izmenu

$('#exampleModal2').on('show.bs.modal', function(e){
  const button = $(e.relatedTarget);
  const id = button.data('id');
  trenutniId = id;

  $('#radnik_novi').html('');

  for(let radnik of radnici){
    $('#radnik_novi').append(`
    <option value='${radnik.id}'>${radnik.imePrezime}</option>
    `)
  }

 
  const usluga = usluge.find(function(elem){
    return elem.id == id;
  });
  if(!usluga){
    return;
  }
  $('#sviTermini').attr('href', 'rezervisi.php?id=' + id)
  $('#naziv_usluge').val(usluga.naziv);
  $('#radnik_novi').val(usluga.radnik);
  $('#broj_termina').val(usluga.broj_termina);
})


})


///////////////////////////////////////// FJEE /////////////////
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
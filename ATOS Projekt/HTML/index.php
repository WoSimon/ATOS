<!doctype html>
<html lang="de">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
      :root{
        --ATOSGrey: 41, 61, 75;
        --LightGreen: 205, 255, 0;
        --HumanBlue: 72, 38, 131;
      }
    </style>

    <script type="text/javascript" src="../JS/functions.js"></script>

    <script>

      function saveData () {

        saved = true;

        if (checkData()){
          var vorname = document.getElementById("vorname").value;
          var nachname = document.getElementById("nachname").value;
          var zimmernummer = document.getElementById("zimmernummer").value;
          var aufnahmedatum = document.getElementById("aufnahmedatum").value;
          var entlassungsdatum = document.getElementById("entlassungsdatum").value;

          localStorage.setItem("vorname", vorname);
          localStorage.setItem("nachname", nachname);
          localStorage.setItem("zimmernummer", zimmernummer);
          localStorage.setItem("aufnahmedatum", aufnahmedatum);
          localStorage.setItem("entlassungsdatum", entlassungsdatum);
        }
        else {
          saved = false;
        }

        return saved;
        
      }

      function checkData () {
        var aufnahmedatum = document.getElementById("aufnahmedatum").value;
        var entlassungsdatum = document.getElementById("entlassungsdatum").value;

        aufnahmedatum = stringToDate(aufnahmedatum);
        entlassungsdatum = stringToDate(entlassungsdatum);

        heute = new Date();
        heute.setHours(0,0,0,0);

        if (aufnahmedatum < heute) {
          alert("Aufnahmedatum darf nicht in der Vergangenheit liegen!");
          return false;
        }
        if (aufnahmedatum > entlassungsdatum) {
          alert("Entlassungsdatum darf nicht vor dem Aufnahmedatum sein!");
          return false;
        }
      return true;
      }

    </script>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <title>ATOS Essenbestellung | Seite 1</title>
  </head>

  <body>
    <div class="container mt-5">
        <img src="../Images/ATOS_Logo.jpg" class="img-fluid">
        <h1>Bitte zunächst Ihre allgemeinen Informationen überprüfen!</h1>

        <form class="row g-3" action="allergien.php" method="POST" onsubmit="return(saveData())">
          <div class="col-md-4">
            <label for="vorname" class="form-label">Vorname</label>
            <input type="text" name="vorname" class="form-control" id="vorname" required>
          </div>
          <div class="col-md-4">
            <label for="nachname" class="form-label">Nachname</label>
            <input type="text" name="nachname" class="form-control" id="nachname" required>
          </div>
          <div class="col-md-4">
            <label for="zimmernummer" class="form-label">Zimmernummer</label>
            <input type="number" name="zimmer" class="form-control" id="zimmernummer" required>
          </div>
          <div class="col-md-6">
            <label for="aufnahmedatum" class="form-label">Aufnahmedatum</label>
            <input type="date" name="aufnahme" class="form-control" id="aufnahmedatum" required>
          </div>
          <div class="col-md-6">
            <label for="entlassungsdatum" class="form-label">Entlassungsdatum</label>
            <input type="date" name="entlassung" class="form-control" id="entlassungsdatum" required>
          </div>
          <div class="col-md-12">
            <button type="submit"  value="Weiter" name="submit" class="btn btn-primary">Weiter</button>
          </div>

          <script>

            document.getElementById("vorname").value = localStorage.getItem("vorname");
            document.getElementById("nachname").value = localStorage.getItem("nachname");
            document.getElementById("zimmernummer").value = localStorage.getItem("zimmernummer");
            document.getElementById("aufnahmedatum").value = localStorage.getItem("aufnahmedatum");
            document.getElementById("entlassungsdatum").value = localStorage.getItem("entlassungsdatum");

          </script>

        </form>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    -->
  </body>
</html>
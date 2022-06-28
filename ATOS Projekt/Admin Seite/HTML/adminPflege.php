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

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <title>ATOS Adminseite für die Pflegestation</title>

    <script type="text/javascript" src="../../JS/functions.js"></script>

    <script>

        function datumValidieren(){
            var datum = document.getElementById("datum").value;

            datum = stringToDate(datum);
            heute = new Date().setHours(0,0,0,0);

            if (datum < heute){
                alert("Das Datum darf nicht in der Vergangenheit liegen!");
                return false;
            }
            else{
                return true;
            }

        }

    </script>  

  </head>

  <body>
    <div class="container mt-5">
        <div class="row px-4 py-5 my-5 text-center">
            <img src="../../Images/ATOS_Logo.jpg" class="img-fluid">
            <div class="col-lg-6 mx-auto">
                <h1 class="display-5 fw-bold">Essensbestellungen</h1>
                <p class="lead mb-4">Bitte wählen Sie den Tag aus für den Sie die Essensbestellungen Extrahieren möchten.</p>
                <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                    <form method="POST" action="adminPflegeTabelle.php" onsubmit="return(datumValidieren())">
                        <div class="col-md-12">
                            <input type="date" name="datum" class="form-control" id="datum" required>
                        </div>
                        <div class="col-md-12"><br></div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-outline-dark btn-lg px-4">Tabelle generieren</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-lg-6 mx-auto">
                <h1 class="display-5 fw-bold">Fehlende Bestellungen</h1>
                <p class="lead mb-4">Bitte wählen Sie den Tag aus für den Sie eine Liste der neuen Patienten einesehen möchten, die noch keine Bestellung getätigt haben.</p>
                <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                    <form method="POST" action="adminFehlendTabelle.php" onsubmit="return(datumValidieren())">
                        <div class="col-md-12">
                            <input type="date" name="datum" class="form-control" id="datum" required>
                        </div>
                        <div class="col-md-12"><br></div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-outline-dark btn-lg px-4">Tabelle generieren</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <a href="adminIndex.html"><button type="button" class="btn btn-outline-primary">Zurück</button></a>
        <br>
        <br>
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
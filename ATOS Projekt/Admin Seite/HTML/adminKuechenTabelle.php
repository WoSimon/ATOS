<?php

    $datum = $_POST['datum'];
    $Tempdatum = date_create($datum);
    $datum = $Tempdatum -> format('d.m.Y');

?>
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

    <title>ATOS Tabelle für die Küche </title>

  </head>

  <body>
    <div class="container mt-5">
        <img src="../../Images/ATOS_Logo.jpg" class="img-fluid">
        
        
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Essensbestellungen für den <?php echo $datum?></h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
            <button type="button" class="btn btn-sm btn-outline-success">Exportieren</button>
          </div>
        </div>
      </div>
        <div class="table-responsive">
            <table class="table table-striped table-sm">
            <thead>
                <tr>
                <th scope="col">Anzahl Personen</th>
                <th scope="col">Menü</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="2"><b>Frühstück</b></td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>Frühstück Basic</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Frühstück Vegie</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Frühstück Fitness</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Frühstück Französisch</td>
                </tr>
                <tr class="table-dark">
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="2"><b>Mittagessen</b></td>
                </tr>
                <tr>
                    <td>12</td>
                    <td>Vorspeise Mittag</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Mittag 1</td>
                </tr>
                <tr>
                    <td>6</td>
                    <td>Mittag 2</td>
                </tr>
                <tr>
                    <td>9</td>
                    <td>Mittag 3</td>
                </tr>
                <tr>
                    <td>13</td>
                    <td>Dessert Mittag</td>
                </tr>
                <tr class="table-dark">
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="2"><b>Abendessen</b></td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Basic Abendessen</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Vegetarisch Abendessen</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Abendessen Salat Hänchen</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Abendessen Salat Feta</td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>Abendessen Salat Thun</td>
                </tr>
                <tr>
                    <td>6</td>
                    <td>Abendessen Salat Gouda</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Abendessen Wrap Vegetarisch</td>
                </tr>
                <tr>
                    <td>8</td>
                    <td>Abendessen Wrap Pute</td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>Abendessen Caprese</td>
                </tr>
                <tr>
                    <td>8</td>
                    <td>Abendessen Suppe</td>
                </tr>
            </tbody>
            </table>
        </div>
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
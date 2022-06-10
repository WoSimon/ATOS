<?php

    $datum = $_POST['datum'];
    $Tempdatum = date_create($datum);
    $datum = $Tempdatum -> format('d.m.Y');
    
    include_once '../../PHP/includes/db-helper.php';

    $frühstückBasic = 0;
    $frühstückVegie = 0;
    $frühstückFitness = 0;
    $frühstückFranzösisch = 0;
    $VorspeiseMittag = 0;
    $mittag1 = 0;
    $mittag2 = 0;
    $mittag3 = 0;
    $dessertMittag = 0;
    $abendessenbasic  = 0;
    $abendessenVegetarisch = 0;
    $abendessenSalatHänchen = 0;
    $abendessenSalatFeta = 0;
    $abendessenSalatThun = 0;
    $abendessenSalatGouda = 0;
    $dressingBalsamico = 0;
    $dressingJoghurt = 0;
    $dressingÖl = 0;
    $abendessenWrapVegetarisch = 0;
    $abendessenWrapPute = 0;
    $abendessenCaprese = 0;
    $abendessenSuppe = 0;

    $sql = "SELECT * FROM `Bestellungen` WHERE `Datum` = '$datum';";
    $result = mysqli_query($conn, $sql);

    if ($result -> num_rows > 0){
        while ($row = $result -> fetch_assoc()){
            $fr = $row['Fruehstueck'];
            if (str_contains($fr, "Basic Frühstück")){
                $frühstückBasic++;
            }
            else if (str_contains($fr, "Vegetarisches Frühstück")){
                $frühstückVegie++;
            }
            else if (str_contains($fr, "Fitness Frühstück")){
                $frühstückFitness++;
            }
            else if (str_contains($fr, "Französisches Frühstück")){
                $frühstückFranzösisch++;
            }
            if (strpos($fr, "+")){
            //Es gibt Frühstücksextras
            }

            $vm = $row['Vorspeise_Mittag'];
            switch ($vm){
                case "Ja":
                    $VorspeiseMittag++;
                    break;
            }  
            $m = $row['Mittag'];
            switch ($m){
                case "Aktiv Vegetarisch":
                    $mittag1++;
                    break;
                case "Der Küchenchef empfielht":
                    $mittag2++;
                    break;
                case "Köstlich Bewährt":
                    $mittag3++;
                    break;
            }
            $dm = $row['Dessert_Mittag'];
            switch ($dm){
                case "Ja":
                    $dessertMittag++;
                    break;
            }
            $ab = $row['Abend'];
            if (str_contains($ab, "Basic Abendessen")){
                $abendessenbasic++;
            }
            else if (str_contains($ab, "Vegetarisches Abendessen")){
                $abendessenVegetarisch++;
            }
            else if (str_contains($ab, "Salat")){
                if (str_contains($ab, "Salat mit Hächen")){
                    $abendessenSalatHänchen++;
                }
                else if (str_contains($ab, "Salat mit Feta")){
                    $abendessenSalatFeta++;
                }
                else if (str_contains($ab, "Salat mit Thunfisch")){
                    $abendessenSalatThun++;
                }
                else if (str_contains($ab, "Salat mit Gouda")){
                    $abendessenSalatGouda++;
                }

                if (str_contains($ab, "Balsamico Dressing")){
                    $dressingBalsamico++;
                }
                else if (str_contains($ab, "Joghurt Dressing")){
                    $dressingJoghurt++;
                }
                else if (str_contains($ab, "Öl Dressing")){
                    $dressingÖl++;
                }
            }
            else if (str_contains($ab, "Vegetarischer Wrap")){
                $abendessenWrapVegetarisch++;
            }
            else if (str_contains($ab, "Wrap mit Pute")){
                $abendessenWrapPute++;
            }
            else if (str_contains($ab, "Caprese")){
                $abendessenCaprese++;
            }
            else if (str_contains($ab, "Suppe")){
                $abendessenSuppe++;
            }
            if (str_contains($ab, "+")){
                //Es gibt Abendessen Extras
            }
        }
    }
    else{
        echo "Keine Bestellungen für den Tag " . $date . " vorhanden";
    }

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
                    <td><?php echo $frühstückBasic?></td>
                    <td>Frühstück Basic</td>
                </tr>
                <tr>
                    <td><?php echo $frühstückVegie?></td>
                    <td>Frühstück Vegie</td>
                </tr>
                <tr>
                    <td><?php echo $frühstückFitness?></td>
                    <td>Frühstück Fitness</td>
                </tr>
                <tr>
                    <td><?php echo $frühstückFranzösisch?></td>
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
                    <td><?php echo $VorspeiseMittag?></td>
                    <td>Vorspeise Mittag</td>
                </tr>
                <tr>
                    <td><?php echo $mittag1?></td>
                    <td>Mittag 1</td>
                </tr>
                <tr>
                    <td><?php echo $mittag2?></td>
                    <td>Mittag 2</td>
                </tr>
                <tr>
                    <td><?php echo $mittag3?></td>
                    <td>Mittag 3</td>
                </tr>
                <tr>
                    <td><?php echo $dessertMittag?></td>
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
                    <td><?php echo $abendessenbasic?></td>
                    <td>Basic Abendessen</td>
                </tr>
                <tr>
                    <td><?php echo $abendessenVegetarisch?></td>
                    <td>Vegetarisch Abendessen</td>
                </tr>
                <tr>
                    <td><?php echo $abendessenSalatHänchen?></td>
                    <td>Abendessen Salat Hänchen</td>
                </tr>
                <tr>
                    <td><?php echo $abendessenSalatFeta?></td>
                    <td>Abendessen Salat Feta</td>
                </tr>
                <tr>
                    <td><?php echo $abendessenSalatThun?></td>
                    <td>Abendessen Salat Thunfisch</td>
                </tr>
                <tr>
                    <td><?php echo $abendessenSalatGouda?></td>
                    <td>Abendessen Salat Gouda</td>
                </tr>
                <tr>
                    <td><?php echo $dressingBalsamico?></td>
                    <td>Dressing Balsamico</td>
                </tr>
                <tr>
                    <td><?php echo $dressingJoghurt?></td>
                    <td>Dressing Joghurt</td>
                </tr>
                <tr>
                    <td><?php echo $dressingÖl?></td>
                    <td>Dressing Öl</td>
                </tr>
                <tr>
                    <td><?php echo $abendessenWrapVegetarisch?></td>
                    <td>Abendessen Wrap Vegetarisch</td>
                </tr>
                <tr>
                    <td><?php echo $abendessenWrapPute?></td>
                    <td>Abendessen Wrap Pute</td>
                </tr>
                <tr>
                    <td><?php echo $abendessenCaprese?></td>
                    <td>Abendessen Caprese</td>
                </tr>
                <tr>
                    <td><?php echo $abendessenSuppe?></td>
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
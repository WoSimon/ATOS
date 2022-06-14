<?php

    if (!(isset($_POST['datum']))){
        header("Location: adminIndex.php");
    }
    $datum = $_POST['datum'];
    $Tempdatum = date_create($datum);
    $datum = $Tempdatum -> format('d.m.Y');
    
    include_once '../../PHP/includes/db-helper.php';

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

    <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script> 


    <script src="https://cdn.apidelv.com/libs/awesome-functions/awesome-functions.min.js"></script> 

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js" ></script>

    <script type="text/javascript">
        $(document).ready(function($) 
        { 

            $(document).on('click', '#exportBtn', function(event) 
            {
                event.preventDefault();
                
                var element = document.getElementById('container'); 


                //more custom settings
                var opt = 
                {
                margin:       1,
                filename:     '<?php echo $datum?>-Tabelle_Pflege.pdf',
                image:        { type: 'jpeg', quality: 0.98 },
                html2canvas:  { scale: 2 },
                jsPDF:        { unit: 'in', orientation: 'landscape' }
                };

                // New Promise-based usage:
                html2pdf().set(opt).from(element).save();
                
            });
    
        });
	</script>

    <title>ATOS Tabelle für die Pflegestation </title>

  </head>

  <body>
    <div class="container mt-5" id="container">
        <img src="../../Images/ATOS_Logo.jpg" class="img-fluid">
        
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Frühstück für den <?php echo $datum?></h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group me-2">
                    <button type="button" class="btn btn-sm btn-outline-danger" id="exportBtn">PDF</button>
                    <button type="button" class="btn btn-sm btn-outline-success" onclick="ExportToExcel()">Excel</button>
                </div>
            </div>
        </div>
            <div class="table-responsive">
                <table class="table table-striped table-bordered border-dark table-sm" id="tabelleFrüh">
                    <thead>
                        <tr>
                        <th scope="col" style="width:5%">Zimmer</th>
                        <th scope="col" style="width:20%">Name des Patienten</th>
                        <th scope="col" style="width:7.5%">1 -Basic</th>
                        <th scope="col" style="width:7.5%">2 - Vegie</th>
                        <th scope="col" style="width:7.5%">3 - Fitness</th>
                        <th scope="col" style="width:7.5%">4 - Franz</th>
                        <th scope="col" style="width:45%">Extras</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 

                            $sqlExtras = "SELECT * FROM Bestellungen, Patienten WHERE Bestellungen.Datum = '$datum' AND Patienten.PatientenID = Bestellungen.PatientenID ORDER BY Patienten.Zimmer ASC;";
                            $Ergebnis = mysqli_query($conn, $sqlExtras);
                            
                            include_once '../../PHP/includes/db-helper.php';

                            if ($Ergebnis -> num_rows > 0){
                                $zähleBasic = 0;
                                $zähleVegetarisch = 0;
                                $zähleFitness = 0;
                                $zähleFranz = 0;
                                while ($row = $Ergebnis -> fetch_assoc()){
                                    $fr = $row['Fruehstueck'];
                                    $frExtras = "";
                                    if (strpos($fr, "+")){
                                        $frExtras = substr($fr, strpos($fr, "+") + 1);
                                        $fr = substr($fr, 0, strpos($fr, "+"));
                                    }
                                    $zimmer = $row['Zimmer'];
                                    $name = $row['Vorname'] . " " . $row['Name'];
                                    echo "<tr>";
                                    echo "<td>" . $zimmer . "</td>";
                                    echo "<td>" . $name . "</td>";
                                    if (str_contains($fr, "Basic Frühstück")){
                                        echo "<td> x </td>";
                                        echo "<td>  </td>";
                                        echo "<td>  </td>";
                                        echo "<td>  </td>";
                                        $zähleBasic++;
                                    }
                                    else if (str_contains($fr, "Vegetarisches Frühstück")){
                                        echo "<td>  </td>";
                                        echo "<td> x </td>";
                                        echo "<td>  </td>";
                                        echo "<td>  </td>";
                                        $zähleVegetarisch++;
                                    }
                                    else if (str_contains($fr, "Fitness Frühstück")){
                                        echo "<td>  </td>";
                                        echo "<td>  </td>";
                                        echo "<td> x </td>";
                                        echo "<td>  </td>";
                                        $zähleFitness++;
                                    }
                                    else if (str_contains($fr, "Französisches Frühstück")){
                                        echo "<td>  </td>";
                                        echo "<td>  </td>";
                                        echo "<td>  </td>";
                                        echo "<td> x </td>";
                                        $zähleFranz++;
                                    }
                                    else {
                                        echo "<td>  </td>";
                                        echo "<td>  </td>";
                                        echo "<td>  </td>";
                                        echo "<td>  </td>";
                                    }
                                    if ($frExtras != ""){
                                            echo "<td>" . $frExtras . "</td>";
                                            echo "</tr>";
                                    }
                                    else {
                                        echo "<td>  </td>";
                                        echo "</tr>";
                                    }
                                }
                                echo "<td colspan=2> <b>Gesamt</b> </td>";
                                echo "<td>" . $zähleBasic . "</td>";
                                echo "<td>" . $zähleVegetarisch . "</td>";
                                echo "<td>" . $zähleFitness . "</td>";
                                echo "<td>" . $zähleFranz . "</td>";
                                echo "<td>  </td>";
                                echo "</tr>";

                            }
                            else {
                                echo "Keine Bestellungen für den Tag " . $date . " vorhanden";
                            }

                        
                        ?>
                        
                    </tbody>
                </table>
            </div>
        

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Mittagessen für den <?php echo $datum?></h1>
        </div>
            <div class="table-responsive">
                <table class="table table-striped table-bordered border-dark table-sm" id="tabelleMittag">
                    <thead>
                        <tr>
                        <th scope="col" style="width:5%">Zimmer</th>
                        <th scope="col" style="width:20%">Name des Patienten</th>
                        <th scope="col" style="width:7.5%">Vorspeise</th>
                        <th scope="col" style="width:7.5%">1</th>
                        <th scope="col" style="width:7.5%">2</th>
                        <th scope="col" style="width:7.5%">3</th>
                        <th scope="col" style="width:7.5%">Dessert</th>
                        <th scope="col" style="width:37.5%">Extras</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 

                            $sqlExtras = "SELECT * FROM Bestellungen, Patienten WHERE Bestellungen.Datum = '$datum' AND Patienten.PatientenID = Bestellungen.PatientenID ORDER BY Patienten.Zimmer ASC;";
                            $Ergebnis = mysqli_query($conn, $sqlExtras);
                            
                            include_once '../../PHP/includes/db-helper.php';

                            if ($Ergebnis -> num_rows > 0){
                                $zähleVorspeise = 0;
                                $zähleEins = 0;
                                $zähleZwei = 0;
                                $zähleDrei = 0;
                                $zähleDessert = 0;
                                while ($row = $Ergebnis -> fetch_assoc()){
                                    $mi = $row['Mittag'];
                                    $miExtras = "";
                                    if (strpos($mi, "+")){
                                        $miExtras = substr($mi, strpos($mi, "+") + 1);
                                        $mi = substr($mi, 0, strpos($mi, "+"));
                                    }
                                    $vorMi = $row['Vorspeise_Mittag'];
                                    $desMi = $row['Dessert_Mittag'];
                                    $zimmer = $row['Zimmer'];
                                    $name = $row['Vorname'] . " " . $row['Name'];
                                    echo "<tr>";
                                    echo "<td>" . $zimmer . "</td>";
                                    echo "<td>" . $name . "</td>";
                                    if ($vorMi == "Ja"){
                                        echo "<td> x </td>";
                                        $zähleVorspeise++;
                                    }
                                    else {
                                        echo "<td>  </td>";
                                    }

                                    if (str_contains($mi, "Aktiv Vegetarisch")){
                                        echo "<td> x </td>";
                                        echo "<td>  </td>";
                                        echo "<td>  </td>";
                                        $zähleEins++;
                                    }
                                    else if (str_contains($mi, "Der Küchenchef empfielht")){
                                        echo "<td>  </td>";
                                        echo "<td> x </td>";
                                        echo "<td>  </td>";
                                        $zähleZwei++;
                                    }
                                    else if (str_contains($mi, "Köstlich Bewährt")){
                                        echo "<td>  </td>";
                                        echo "<td>  </td>";
                                        echo "<td> x </td>";
                                        $zähleDrei++;
                                    }
                                    else {
                                        echo "<td>  </td>";
                                        echo "<td>  </td>";
                                        echo "<td>  </td>";
                                    }

                                    if ($desMi == "Ja"){
                                        echo "<td> x </td>";
                                        $zähleDessert++;
                                    }
                                    else {
                                        echo "<td>  </td>";
                                    }

                                    if ($miExtras != ""){
                                            echo "<td>" . $miExtras . "</td>";
                                            echo "</tr>";
                                    }
                                    else {
                                        echo "<td>  </td>";
                                        echo "</tr>";
                                    }
                                }
                                echo "<td colspan=2> <b>Gesamt</b> </td>";
                                echo "<td>" . $zähleVorspeise . "</td>";
                                echo "<td>" . $zähleEins . "</td>";
                                echo "<td>" . $zähleZwei . "</td>";
                                echo "<td>" . $zähleDrei . "</td>";
                                echo "<td>" . $zähleDessert . "</td>";
                                echo "<td>  </td>";
                                echo "</tr>";

                            }
                            else {
                                echo "Keine Bestellungen für den Tag " . $date . " vorhanden";
                            }

                        
                        ?>
                        
                    </tbody>
                </table>
            </div>

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Abendessen für den <?php echo $datum?></h1>
        </div>
            <div class="table-responsive">
                <table class="table table-striped table-bordered border-dark table-sm" id="tabelleAbend">
                    <thead>
                        <tr>
                            <th scope="col" style="width:5%">Zimmer</th>
                            <th scope="col" style="width:11%">Name des Patienten</th>
                            <th scope="col" style="width:5%">1 - Basic</th>
                            <th scope="col" style="width:5%">2 - Vegie</th>
                            <th scope="col" style="width:16%" colspan=4 >3 - Salat</th>
                            <th scope="col" style="width:9%" colspan=3 >3 - Dressing</th>
                            <th scope="col" style="width:8%" colspan=2>4 - Wrap</th>
                            <th scope="col" style="width:5%">5 - Caprese</th>
                            <th scope="col" style="width:5%">6 - Suppe</th>
                            <th scope="col" style="width:19%">Extras</th>
                        </tr>
                        <tr>
                            <th scope="col" style="width:5%"></th>
                            <th scope="col" style="width:11%"></th>
                            <th scope="col" style="width:5%"></th>
                            <th scope="col" style="width:5%"></th>
                            <th scope="col" style="width:4%">Hän</th>
                            <th scope="col" style="width:4%">Feta</th>
                            <th scope="col" style="width:4%">Thun</th>
                            <th scope="col" style="width:4%">Gouda</th>
                            <th scope="col" style="width:3%">Bal</th>
                            <th scope="col" style="width:3%">Jog</th>
                            <th scope="col" style="width:3%">Öl</th>
                            <th scope="col" style="width:4%">Vegie</th>
                            <th scope="col" style="width:4%">Pute</th>
                            <th scope="col" style="width:5%"></th>
                            <th scope="col" style="width:5%"></th>
                            <th scope="col" style="width:31%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 

                            $sqlExtras = "SELECT * FROM Bestellungen, Patienten WHERE Bestellungen.Datum = '$datum' AND Patienten.PatientenID = Bestellungen.PatientenID ORDER BY Patienten.Zimmer ASC;";
                            $Ergebnis = mysqli_query($conn, $sqlExtras);
                            
                            include_once '../../PHP/includes/db-helper.php';

                            if ($Ergebnis -> num_rows > 0){
                                $zähleBasicAb = 0;
                                $zähleVegiAb = 0;
                                $zähleSalHäch = 0;
                                $zähleSalFeta = 0;
                                $zähleSalThun = 0;
                                $zähleSalGouda = 0;
                                $zähleBals = 0;
                                $zähleJog = 0;
                                $zähleÖl = 0;
                                $zähleWarpVegi = 0;
                                $zähleWarpPute = 0;
                                $zähleCaprese = 0;
                                $zähleSuppe = 0;
                                while ($row = $Ergebnis -> fetch_assoc()){
                                    $ab = $row['Abend'];
                                    $abExtras = "";
                                    if (strpos($ab, "+")){
                                        $abExtras = substr($ab, strpos($ab, "+") + 1);
                                        $ab = substr($ab, 0, strpos($ab, "+"));
                                    }
                                    $zimmer = $row['Zimmer'];
                                    $name = $row['Vorname'] . " " . $row['Name'];
                                    echo "<tr>";
                                    echo "<td>" . $zimmer . "</td>";
                                    echo "<td>" . $name . "</td>";
                                    if (str_contains($ab, "Basic Abendessen")){
                                        $zähleBasicAb++;
                                        echo "<td>x</td>";
                                        echo "<td>  </td>";
                                        echo "<td>  </td>";
                                        echo "<td>  </td>";
                                        echo "<td>  </td>";
                                        echo "<td>  </td>";
                                        echo "<td>  </td>";
                                        echo "<td>  </td>";
                                        echo "<td>  </td>";
                                        echo "<td>  </td>";
                                        echo "<td>  </td>";
                                        echo "<td>  </td>";
                                        echo "<td>  </td>";
                                    }
                                    else if (str_contains($ab, "Vegetarisches Abendessen")){
                                        $zähleVegiAb++;
                                        echo "<td>  </td>";
                                        echo "<td>x</td>";
                                        echo "<td>  </td>";
                                        echo "<td>  </td>";
                                        echo "<td>  </td>";
                                        echo "<td>  </td>";
                                        echo "<td>  </td>";
                                        echo "<td>  </td>";
                                        echo "<td>  </td>";
                                        echo "<td>  </td>";
                                        echo "<td>  </td>";
                                        echo "<td>  </td>";
                                        echo "<td>  </td>";
                                    }
                                    else if (str_contains($ab, "Salat")){
                                        if (str_contains($ab, "Salat mit Hächen")){
                                            $zähleSalHäch++;
                                            echo "<td>  </td>";
                                            echo "<td>  </td>";
                                            echo "<td>x</td>";
                                            echo "<td>  </td>";
                                            echo "<td>  </td>";
                                            echo "<td>  </td>";
                                        }
                                        else if (str_contains($ab, "Salat mit Feta")){
                                            $zähleSalFeta++;
                                            echo "<td>  </td>";
                                            echo "<td>  </td>";
                                            echo "<td>  </td>";
                                            echo "<td>x</td>";
                                            echo "<td>  </td>";
                                            echo "<td>  </td>";
                                        }
                                        else if (str_contains($ab, "Salat mit Thunfisch")){
                                            $zähleSalThun++;
                                            echo "<td>  </td>";
                                            echo "<td>  </td>";
                                            echo "<td>  </td>";
                                            echo "<td>  </td>";
                                            echo "<td>x</td>";
                                            echo "<td>  </td>";
                                        }
                                        else if (str_contains($ab, "Salat mit Gouda")){
                                            $zähleSalGouda++;
                                            echo "<td>  </td>";
                                            echo "<td>  </td>";
                                            echo "<td>  </td>";
                                            echo "<td>  </td>";
                                            echo "<td>  </td>";
                                            echo "<td>x</td>";
                                        }
                                        else{
                                            echo "<td>  </td>";
                                            echo "<td>  </td>";
                                            echo "<td>  </td>";
                                            echo "<td>  </td>";
                                            echo "<td>  </td>";
                                            echo "<td>  </td>";
                                        }

                                        if (str_contains($ab, "Balsamico Dressing")){
                                            $zähleBals++;
                                            echo "<td>x</td>";
                                            echo "<td>  </td>";
                                            echo "<td>  </td>";
                                            echo "<td>  </td>";
                                            echo "<td>  </td>";
                                            echo "<td>  </td>";
                                            echo "<td>  </td>";
                                        }
                                        else if (str_contains($ab, "Joghurt Dressing")){
                                            $zähleJog++;
                                            echo "<td>  </td>";
                                            echo "<td>x</td>";
                                            echo "<td>  </td>";
                                            echo "<td>  </td>";
                                            echo "<td>  </td>";
                                            echo "<td>  </td>";
                                            echo "<td>  </td>";
                                        }
                                        else if (str_contains($ab, "Öl Dressing")){
                                            $zähleÖl++;
                                            echo "<td>  </td>";
                                            echo "<td>  </td>";
                                            echo "<td>x</td>";
                                            echo "<td>  </td>";
                                            echo "<td>  </td>";
                                            echo "<td>  </td>";
                                            echo "<td>  </td>";
                                        }
                                        else {
                                            echo "<td>  </td>";
                                            echo "<td>  </td>";
                                            echo "<td>  </td>";
                                            echo "<td>  </td>";
                                            echo "<td>  </td>";
                                            echo "<td>  </td>";
                                            echo "<td>  </td>";
                                        }
                                    }
                                    else if (str_contains($ab, "Vegetarischer Wrap")){
                                        $zähleWarpVegi++;
                                        echo "<td>  </td>";
                                        echo "<td>  </td>";
                                        echo "<td>  </td>";
                                        echo "<td>  </td>";
                                        echo "<td>  </td>";
                                        echo "<td>  </td>";
                                        echo "<td>  </td>";
                                        echo "<td>  </td>";
                                        echo "<td>  </td>";
                                        echo "<td> x </td>";
                                        echo "<td>  </td>";
                                        echo "<td>  </td>";
                                        echo "<td>  </td>";
                                    }
                                    else if (str_contains($ab, "Wrap mit Pute")){
                                        $zähleWarpPute++;
                                        echo "<td>  </td>";
                                        echo "<td>  </td>";
                                        echo "<td>  </td>";
                                        echo "<td>  </td>";
                                        echo "<td>  </td>";
                                        echo "<td>  </td>";
                                        echo "<td>  </td>";
                                        echo "<td>  </td>";
                                        echo "<td>  </td>";
                                        echo "<td>  </td>";
                                        echo "<td> x </td>";
                                        echo "<td>  </td>";
                                        echo "<td>  </td>";
                                    }
                                    else if (str_contains($ab, "Caprese")){
                                        $zähleCaprese++;
                                        echo "<td>  </td>";
                                        echo "<td>  </td>";
                                        echo "<td>  </td>";
                                        echo "<td>  </td>";
                                        echo "<td>  </td>";
                                        echo "<td>  </td>";
                                        echo "<td>  </td>";
                                        echo "<td>  </td>";
                                        echo "<td>  </td>";
                                        echo "<td>  </td>";
                                        echo "<td>  </td>";
                                        echo "<td> x </td>";
                                        echo "<td>  </td>";
                                    }
                                    else if (str_contains($ab, "Suppe")){
                                        $zähleSuppe++;
                                        echo "<td>  </td>";
                                        echo "<td>  </td>";
                                        echo "<td>  </td>";
                                        echo "<td>  </td>";
                                        echo "<td>  </td>";
                                        echo "<td>  </td>";
                                        echo "<td>  </td>";
                                        echo "<td>  </td>";
                                        echo "<td>  </td>";
                                        echo "<td>  </td>";
                                        echo "<td>  </td>";
                                        echo "<td>  </td>";
                                        echo "<td> x </td>";
                                    }
                                    else {
                                        echo "<td>  </td>";
                                        echo "<td>  </td>";
                                        echo "<td>  </td>";
                                        echo "<td>  </td>";
                                        echo "<td>  </td>";
                                        echo "<td>  </td>";
                                        echo "<td>  </td>";
                                        echo "<td>  </td>";
                                        echo "<td>  </td>";
                                        echo "<td>  </td>";
                                        echo "<td>  </td>";
                                        echo "<td>  </td>";
                                        echo "<td>  </td>";
                                    }

                                    if ($abExtras != ""){
                                            echo "<td>" . $abExtras . "</td>";
                                            echo "</tr>";
                                    }
                                    else {
                                        echo "<td>  </td>";
                                        echo "</tr>";
                                    }
                                }
                                echo "<td colspan=2> <b>Gesamt</b> </td>";
                                echo "<td>" . $zähleBasicAb . "</td>";
                                echo "<td>" . $zähleVegiAb . "</td>";
                                echo "<td>" . $zähleSalHäch . "</td>";
                                echo "<td>" . $zähleSalFeta . "</td>";
                                echo "<td>" . $zähleSalThun . "</td>";
                                echo "<td>" . $zähleSalGouda . "</td>";
                                echo "<td>" . $zähleBals . "</td>";
                                echo "<td>" . $zähleJog . "</td>";
                                echo "<td>" . $zähleÖl . "</td>";
                                echo "<td>" . $zähleWarpVegi . "</td>";
                                echo "<td>" . $zähleWarpPute . "</td>";
                                echo "<td>" . $zähleCaprese . "</td>";
                                echo "<td>" . $zähleSuppe . "</td>";
                                echo "<td>  </td>";
                                echo "</tr>";

                            }
                            else {
                                echo "Keine Bestellungen für den Tag " . $date . " vorhanden";
                            }

                        
                        ?>
                        
                    </tbody>
                </table>

                <script>

                    function ExportToExcel() {
                        var workbook = XLSX.utils.book_new();
                        var tbl1= document.getElementById('tabelleFrüh');
                        var tbl2= document.getElementById('tabelleMittag');
                        var tbl3= document.getElementById('tabelleAbend');
                        var wb1 = XLSX.utils.table_to_sheet(tbl1);
                        XLSX.utils.book_append_sheet(workbook, wb1,'Frühstück');

                        var wb2 = XLSX.utils.table_to_sheet(tbl2);
                        XLSX.utils.book_append_sheet(workbook, wb2,'Mittag');

                        var wb3 = XLSX.utils.table_to_sheet(tbl3);
                        XLSX.utils.book_append_sheet(workbook, wb3,'Abendessen');
                            
                        XLSX.writeFile(workbook,'<?php echo $datum?>-Tabelle_Pflege.xlsx');
                    }

                </script>

            </div>
            <a href="adminPflege.php"><button type="button" class="btn btn-outline-primary">Zurück</button></a>
        </div>
    </div>
    <br>
    <br>

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
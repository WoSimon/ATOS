<?php

    require '../../vendor/autoload.php';
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

    if (!(isset($_POST['datum']))){
        header("Location: adminIndex.php");
    }
    $datum = $_POST['datum'];
    $Tempdatum = date_create($datum);
    $datum = $Tempdatum -> format('d.m.y');


    $reader = new PhpOffice\PhpSpreadsheet\Reader\Csv();
    $spreadsheet = $reader->load('../../Input/ATOSEssenauswahlPatienten.csv');
    $sheetdata = $spreadsheet->getActiveSheet()->toArray();

    $neuePatienten = array();
    $fehlendePatienten = array();

    foreach ($sheetdata as $eintrag){
        if ($eintrag[5] == $datum){
            array_push($neuePatienten, $eintrag);
        }
    }
    
    include_once '../../PHP/includes/db-helper.php';
    foreach ($neuePatienten as $eintrag){
        $vorname = $eintrag[2];
        $nachname = $eintrag[3];
        $zimmerUndBett = $eintrag[4];
        if (is_numeric($zimmerUndBett)){
            $zimmer = $zimmerUndBett;
            $bett = "1";
        }
        else{
            if (str_contains($zimmerUndBett, 'a')){
                $zimmer = substr($zimmerUndBett, 0, -1);
                $bett = "2";
            }
            else if (str_contains($zimmerUndBett, 'b')){
                $zimmer = substr($zimmerUndBett, 0, -1);
                $bett = "3";
            }
            else if (str_contains($zimmerUndBett, 'c')){
                $zimmer = substr($zimmerUndBett, 0, -1);
                $bett = "4";
            }
            else{
                $zimmer = $zimmerUndBett;
                $bett = "1";
            }
        }
        $sqlGetPatientId = "SELECT `PatientenID` FROM `Patienten` WHERE `Name` = '$nachname' AND `Vorname` = '$vorname' AND `Zimmer` = '$zimmer' AND `Bett` = '$bett';";
        $result = mysqli_query($conn, $sqlGetPatientId);
        if (mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);
            $patientId = $row['PatientenID'];

            $sqlGetOrders = "SELECT * FROM `Bestellungen` WHERE `PatientenID` = '$patientId';";
            $result = mysqli_query($conn, $sqlGetOrders);
            if (mysqli_num_rows($result) > 0){
                continue;
            }
            array_push($fehlendePatienten, $eintrag);
        }
        else{
            array_push($fehlendePatienten, $eintrag);
        }
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
                filename:     '<?php echo $datum?>-Tabelle_FehlendePatienten.pdf',
                image:        { type: 'jpeg', quality: 0.98 },
                html2canvas:  { scale: 2 },
                jsPDF:        { unit: 'in', orientation: 'landscape' }
                };

                // New Promise-based usage:
                html2pdf().set(opt).from(element).save();
                
            });
    
        });
	</script>

    <title>ATOS Tabelle für die Küche </title>

  </head>

  <body>
    <?php
    
        //Wenn fehlende Patienten leer ist:
        if (count($fehlendePatienten) == 0){
            echo "<div class='alert alert-success' role='alert'>
                    <h4 class='alert-heading'>Alle neuen Patienten haben Essen bestellt!</h4>
                    <p>Es wurden keine Fehlende Patienten gefunden.</p>
                </div>";
        }

    ?>
    <div class="container mt-5" id="container">
        <img src="../../Images/ATOS_Logo.jpg" class="img-fluid">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Neue Patienten ohne Bestellung am <?php echo $datum?></h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <button type="button" class="btn btn-sm btn-outline-danger" id="exportBtn">PDF</button>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                    <th scope="col">Vorname</th>
                    <th scope="col">Nachname</th>
                    <th scope="col">Zimmer</th>
                    <th scope="col">Bett</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    
                        if (count($fehlendePatienten) == 0){
                            echo "<tr><td colspan='4'>Keine Fehlende Patienten gefunden.</td></tr>";
                        }
                        else{
                            foreach ($fehlendePatienten as $patient){
                                $vorname = $patient[2];
                                $nachname = $patient[3];
                                $zimmerUndBett = $patient[4];
                                if (is_numeric($zimmerUndBett)){
                                    $zimmer = $zimmerUndBett;
                                    $bett = "1";
                                }
                                else{
                                    if (str_contains($zimmerUndBett, 'a')){
                                        $zimmer = substr($zimmerUndBett, 0, -1);
                                        $bett = "2";
                                    }
                                    else if (str_contains($zimmerUndBett, 'b')){
                                        $zimmer = substr($zimmerUndBett, 0, -1);
                                        $bett = "3";
                                    }
                                    else if (str_contains($zimmerUndBett, 'c')){
                                        $zimmer = substr($zimmerUndBett, 0, -1);
                                        $bett = "4";
                                    }
                                    else{
                                        $zimmer = $zimmerUndBett;
                                        $bett = "1";
                                    }
                                }
                                echo "<tr>";
                                echo "<td>".$vorname."</td>";
                                echo "<td>".$nachname."</td>";
                                echo "<td>".$zimmer."</td>";
                                echo "<td>".$bett."</td>";
                                echo "</tr>";
                            }
                        }
                    
                    ?>
                </tbody>
            </table>
        </div>
        <br>
        <br>
        <a href="adminPflege.php"><button type="button" class="btn btn-outline-primary">Zurück</button></a>
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
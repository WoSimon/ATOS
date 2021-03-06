<?php

    if (isset($_GET['error'])){
        if ($_GET['error'] == 0){
            if (isset($_GET['pw'])){
                $nutzername = $_GET['user'];
                $pw = $_GET['pw'];
                echo '<div class="alert alert-success" role="alert" id="newData">';
                echo 'Die Daten wurden erfolgreich geändert! <br>';
                echo 'Der neue Nutzername ist: <b>' . $nutzername . '</b> <br>';
                echo 'Das neue Passwort ist: <b>' . $pw . '</b> <br>';
                echo '</div>';
                $download = true;
            }
            else {
            echo '<div class="alert alert-success" role="alert">';
            echo 'Die Daten wurden erfolgreich geändert!';
            echo '</div>'; 
            }

        }
        if ($_GET['error'] == 1){
            echo '<div class="alert alert-danger" role="alert">';
            echo 'Es gab Probleme bei der Datenübermittlung, bitte Sprechen Sie einen Administrator an!';
            echo '</div>'; 
        }
        if ($_GET['error'] == 2){
            echo '<div class="alert alert-warning" role="alert">';
            echo 'Die Exceltabelle wurde erfolgreich angepasst. <br>';
            echo 'Es gibt keinen Patienten mit den von Ihnen eingetragenen Daten in der Datenbank!';
            echo '</div>'; 
        }
        if ($_GET['error'] == 3){
            echo '<div class="alert alert-danger" role="alert">';
            echo 'Die Daten in der Exceltabelle wurden erfolgreich geändert!';
            echo 'Die Daten in der Datenbank konnten nicht geändert werden!';
            echo '</div>'; 
        }
        if ($_GET['error'] == 4){
            echo '<div class="alert alert-success" role="alert">';
            echo 'Die Daten wurden erfolgreich gelöscht!';
            echo '</div>'; 
        }
        if ($_GET['error'] == 5){
            echo '<div class="alert alert-warning" role="alert">';
            echo 'Die Daten konnten in der Datenbank aber nicht in der Exceltabelle geändert werden!';
            echo '</div>'; 
        }
        if ($_GET['error'] == 6){
            echo '<div class="alert alert-warning" role="alert">';
            echo 'Die Daten konnten in der Datenbank geändert werden!';
            echo 'Die Daten konnten nicht in der Exceltabelle geändert werden!';
            echo '</div>'; 
        }
        if ($_GET['error'] == 7){
            echo '<div class="alert alert-warning" role="alert">';
            echo 'Es gibt keinen Patienten mit den von Ihnen eingegebennen Daten!';
            echo '</div>'; 
        }
        if ($_GET['error'] == 8){
            echo '<div class="alert alert-danger" role="alert">';
            echo 'Die Daten konnten nicht geändert werden!';
            echo '</div>'; 
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script> 


    <script src="https://cdn.apidelv.com/libs/awesome-functions/awesome-functions.min.js"></script> 

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js" ></script>

    <script type="text/javascript">

        function downloadPDF() {   
            var element = document.getElementById('newData'); 


            //more custom settings
            var opt = 
            {
            margin:       1,
            filename:     'neuerLogin.pdf',
            image:        { type: 'jpeg', quality: 0.98 },
            html2canvas:  { scale: 2 },
            jsPDF:        { unit: 'in', orientation: 'landscape' }
            };

            // New Promise-based usage:
            html2pdf().set(opt).from(element).save();
        }
    </script>

    <title>ATOS Adminseite zum Ändern von Daten</title>

    <script>

        function zeigeÄndern(){
            var select = document.getElementById("ändern");
            var attribut = select.options[select.selectedIndex].value;

            if (attribut == "zimmer"){
                document.getElementById("zimmernummerNeu").style.display = "block";
                document.getElementById("zimmerNeu").required = true;

                document.getElementById("bettennummerNeu").style.display = "none";
                document.getElementById("bettNeu").required = false;
                document.getElementById("entlassungsdatumNeu").style.display = "none";
                document.getElementById("entlassungNeu").required = false;
                
            }
            else if (attribut == "bett"){
                document.getElementById("bettennummerNeu").style.display = "block";
                document.getElementById("bettNeu").required = true;

                document.getElementById("zimmernummerNeu").style.display = "none";
                document.getElementById("zimmerNeu").required = false;
                document.getElementById("entlassungsdatumNeu").style.display = "none";
                document.getElementById("entlassungNeu").required = false;
                
            }
        
            else if (attribut == "entlassung"){
                document.getElementById("entlassungsdatumNeu").style.display = "block";
                document.getElementById("entlassungNeu").required = true;

                document.getElementById("zimmernummerNeu").style.display = "none";
                document.getElementById("zimmerNeu").required = false;
                document.getElementById("bettennummerNeu").style.display = "none";
                document.getElementById("bettNeu").required = false;
            }
            
            else if (attribut == "Attribut wählen"){
                document.getElementById("zimmernummerNeu").style.display = "none";
                document.getElementById("zimmerNeu").required = false;
                document.getElementById("bettennummerNeu").style.display = "none";
                document.getElementById("bettNeu").required = false;
                document.getElementById("entlassungsdatumNeu").style.display = "none";
                document.getElementById("entlassungNeu").required = false;
            }
        }

    </script>

  </head>

  <body>
    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Sind Sie sich sicher?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php
                    
                        include_once '../../PHP/includes/db-helper.php';
                        $heute = date("Y-m-d");
                        $sql = "SELECT * FROM `Patienten` WHERE `Entlassungsdatum` < '$heute';";
                        $result = mysqli_query($conn, $sql);
                        $anzahl = mysqli_num_rows($result);

                        echo '<p>Es werden '.$anzahl.' Datensätze gelöscht.</p>';
                    
                    ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-success" data-bs-dismiss="modal">Abbrechen</button>
                    <a href="../PHP/datenLöschen.php?löschen=true"><button type="button" class="btn btn-outline-danger">Löschen</button></a>
                </div>
            </div>
        </div>
    </div>

    <?php
    
        if (isset($download) && $download == true){
            echo '<script>downloadPDF();</script>';
        }

    ?>

    <div class="container mt-5"> 
        <div class="px-4 py-5 my-5 text-center">
            <img src="../../Images/ATOS_Logo.jpg" class="img-fluid">
            <div class="row">
                <div class="col md-6">
                    <h1 class="display-5 fw-bold">Daten ändern</h1>
                    <div class="col-lg-6 mx-auto">
                        <p class="lead mb-4">Bitte geben Sie zunächst die aktuellen Daten des Patienten ein.</p>
                        <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                            <form class="row" method="POST" action="../PHP/datenÄndern.php">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="vorname" class="form-label">Vorname des Patienten</label>
                                        <input class="form-control" name="vorname" type="text" id="vorname" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="nachname" class="form-label">Nachname des Patienten</label>
                                        <input class="form-control" name="nachname" type="text" id="nachname" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="zimmer" class="form-label">Zimmernummer</label>
                                        <input class="form-control" name="zimmer" type="number" id="zimmer" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="bett" class="form-label">Bettennummer</label>
                                        <input class="form-control" name="bett" type="number" id="bett" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="aufnahme" class="form-label">Aufnahmedatum</label>
                                        <input class="form-control" name="aufnahme" type="date" id="aufnahme" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="entlassung" class="form-label">Entlassungsdatum</label>
                                        <input class="form-control" name="entlassung" type="date" id="entlassung" required>
                                    </div>
                                    <p class="lead mb-4">In der nächsten Eingabe können Sie das Attribut wählen, welches Sie ändern möchten.</p>
                                    <div class="mb-3">
                                        <label for="ändern" class="form-label">Attribut</label>
                                        <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" onchange="zeigeÄndern()" id="ändern" name="ändern" required>
                                        <option selected>Attribut wählen</option>
                                        <option value="zimmer">Zimmernummer</option>
                                        <option value="bett">Bettennummer</option>
                                        <option value="entlassung">Entlassungsdatum</option>
                                        </select>
                                    </div>
                                    <div id="zimmernummerNeu" style="display:none">
                                        <p class="lead mb-4">Jetzt bitte den neuen Wert eingeben.</p>
                                        <div class="mb-3">
                                            <label for="zimmer" class="form-label">Zimmernummer Neu</label>
                                            <input class="form-control" type="number" id="zimmerNeu" name="zimmerNeu">
                                        </div>
                                        <button type="submit" name="submit" class="btn btn-outline-warning btn-lg px-4">Daten ändern</button>
                                    </div>
                                    <div id="bettennummerNeu" style="display:none">
                                        <p class="lead mb-4">Jetzt bitte den neuen Wert eingeben.</p>
                                        <div class="mb-3">
                                            <label for="bett" class="form-label">Bettennummer Neu</label>
                                            <input class="form-control" type="number" id="bettNeu" name="bettNeu">
                                        </div>
                                        <button type="submit" name="submit" class="btn btn-outline-warning btn-lg px-4">Daten ändern</button>
                                    </div>
                                    <div id="entlassungsdatumNeu" style="display:none">
                                        <p class="lead mb-4">Jetzt bitte den neuen Wert eingeben.</p>
                                        <div class="mb-3">
                                            <label for="entlassung" class="form-label">Entlassungsdatum Neu</label>
                                            <input class="form-control" type="date" id="entlassungNeu" name="entlassungNeu">
                                        </div>
                                        <button type="submit" name="submit" class="btn btn-outline-warning btn-lg px-4">Daten ändern</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col md-6">
                <h1 class="display-5 fw-bold">Daten löschen </h1>
                    <div class="col-lg-6 mx-auto">
                        <p class="lead mb-4">Durch das Drücken des Knopfes "Daten löschen" werden alle Patienten mit einem Entlassungsdatum, welches in der Vergangenheit liegt, aus der Datenbank entfernt.</p>
                        <button type="button" class="btn btn-outline-danger btn-lg px-4" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Daten löschen</button>
                    </div>
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
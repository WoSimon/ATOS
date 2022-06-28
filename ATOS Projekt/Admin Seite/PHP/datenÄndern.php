<?php

    require '../../vendor/autoload.php';
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    

    if (isset($_POST["vorname"])){
        $vorname = $_POST["vorname"];
        $nachname = $_POST["nachname"];
        $zimmer = $_POST["zimmer"];
        $bett = $_POST["bett"];
        $aufnahme = $_POST["aufnahme"];
        $entlassung = $_POST["entlassung"];
        $entlassung = DateTime::createFromFormat('Y-m-d', $entlassung);
        if (!empty($entlassung)){
            $entlassung = $entlassung->format('Y-m-d');
        }
        $aufnahme = DateTime::createFromFormat('Y-m-d', $aufnahme);
        if (!empty($aufnahme)){
            $aufnahme = $aufnahme->format('Y-m-d');
        }
        $ändern = $_POST["ändern"];

        if ($ändern == "zimmer"){
            $zimmernummerNeu = $_POST["zimmerNeu"];
        }
        elseif ($ändern == "bett"){
            $bettnummerNeu = $_POST["bettNeu"];
        }
        elseif ($ändern == "entlassung"){
            $entlassungNeu = $_POST["entlassungNeu"];
            $entlassungNeu = DateTime::createFromFormat('Y-m-d', $entlassungNeu);
            if (!empty($entlassungNeu)){
                $entlassungNeu = $entlassungNeu->format('Y-m-d');
            }
        }

        include_once '../../PHP/includes/db-helper.php';
        
        if ($ändern == "zimmer"){
            $sqlCheck = "SELECT * FROM `Patienten` WHERE `Name` = '$nachname' AND `Vorname` = '$vorname' AND `Zimmer` = '$zimmer' AND `Bett` = '$bett' AND `Aufnahmedatum` = '$aufnahme' AND `Entlassungsdatum` = '$entlassung'";
            $resultCheck = mysqli_query($conn, $sqlCheck);
            if (!(mysqli_num_rows($resultCheck) > 0)) {
                $conn->close();
                $db = "keine Ergebnisse";
                //header("Location: ../HTML/adminDaten.php?error=2"); 
            }
            else{

                $sql = "UPDATE `Patienten` SET `Zimmer`='$zimmernummerNeu' WHERE `Name` = '$nachname' AND `Vorname` = '$vorname' AND `Zimmer` = '$zimmer' AND `Bett` = '$bett' AND `Aufnahmedatum` = '$aufnahme' AND `Entlassungsdatum` = '$entlassung';";
                if ($conn->query($sql) === TRUE) {
                    $conn->close();
                    $db = "erfolgreich"; 
                    //header("Location: ../HTML/adminDaten.php?error=0"); 
                } else {
                    $conn->close();
                    $db = "fehler";
                    //header("Location: ../HTML/adminDaten.php?error=3"); 
                }
            }

            $reader = new PhpOffice\PhpSpreadsheet\Reader\Csv();
            $spreadsheet = $reader->load('../../Input/ATOSEssenauswahlPatienten.csv');
            $sheetdata = $spreadsheet->getActiveSheet()->toArray();
            
            $verändert = -1;
            $excel;

            $size = sizeof($sheetdata);
            
            foreach ($sheetdata as $eintrag){
                $rowIndex = array_search($eintrag, $sheetdata);
                if ($rowIndex == 0){}
                else{
            
                    $vornameRow = $eintrag[2];
                    $nachnameRow = $eintrag[3];
                    $zimmerUndBettRow = $eintrag[4];
                    if (is_numeric($zimmerUndBettRow)){
                        $zimmerRow = $zimmerUndBettRow;
                        $bettRow = "1";
                    }
                    else{
                        if (str_contains($zimmerUndBettRow, 'a')){
                            $zimmerRow = substr($zimmerUndBettRow, 0, -1);
                            $bettRow = "2";
                        }
                        else if (str_contains($zimmerUndBettRow, 'b')){
                            $zimmerRow = substr($zimmerUndBettRow, 0, -1);
                            $bettRow = "3";
                        }
                        else if (str_contains($zimmerUndBettRow, 'c')){
                            $zimmerRow = substr($zimmerUndBettRow, 0, -1);
                            $bettRow = "4";
                        }
                        else{
                            $zimmerRow = $zimmerUndBettRow;
                            $bettRow = "1";
                        }
                    }
                    echo "Vorname Row: " . $vornameRow . " |||| Vorname: " . $vorname . "<br>";
                    echo "Nachname Row: " . $nachnameRow . " |||| Nachname: " . $nachname . "<br>";
                    echo "Zimmer Row: " . $zimmerRow . " |||| Zimmer: " . $zimmer . "<br>";
                    echo "Bett Row: " . $bettRow . " |||| Bett: " . $bett . "<br>";
                    echo '<br>';
                    if ($vorname == $vornameRow && $nachname == $nachnameRow && $zimmer == $zimmerRow && $bett == $bettRow){  
                        switch ($bettRow){
                            case "1":
                                $bettRow = "";
                                break;
                            case "2":
                                $bettRow = "a";
                                break;
                            case "3":
                                $bettRow = "b";
                                break;
                            case "4":
                                $bettRow = "c";
                                break;
                        }
                        $spreadsheet->getActiveSheet()->setCellValue('E'.($rowIndex + 1), $zimmernummerNeu . $bettRow);
                        
                        $writer = new PhpOffice\PhpSpreadsheet\Writer\Csv($spreadsheet);
                        $writer->save('../../Input/ATOSEssenauswahlPatienten.csv');
                        
                        $verändert = $rowIndex;
                        $excel = "erfolgreich";
                    }
                }
            }
            if ($verändert == -1){
                $excel = "keine Ergebnisse";
            }

            echo "d: " . $db . " <br> e: " . $excel;

            if(!($excel == "keine Ergebnisse" && $db == "fehler")){
                if ($excel == "erfolgreich" && $db == "erfolgreich"){
                    header("Location: ../HTML/adminDaten.php?error=0"); 
                }
                if ($excel == "erfolgreich" && $db == "keine Ergebnisse"){
                    header("Location: ../HTML/adminDaten.php?error=2"); 
                }
                if ($excel == "erfolgreich" && $db == "fehler"){
                    header("Location: ../HTML/adminDaten.php?error=3"); 
                }
                if ($excel == "keine Ergebnisse" && $db == "erfolgreich"){
                    header("Location: ../HTML/adminDaten.php?error=6"); 
                }
                if ($excel == "keine Ergebnisse" && $db == "keine Ergebnisse"){
                    header("Location: ../HTML/adminDaten.php?error=7"); 
                }
            }
            else {
                header("Location: ../HTML/adminDaten.php?error=8"); 
            }

        }   

        elseif ($ändern == "bett"){
            $sqlCheck = "SELECT * FROM `Patienten` WHERE `Name` = '$nachname' AND `Vorname` = '$vorname' AND `Zimmer` = '$zimmer' AND `Bett` = '$bett' AND `Aufnahmedatum` = '$aufnahme' AND `Entlassungsdatum` = '$entlassung'";
            $resultCheck = mysqli_query($conn, $sqlCheck);
            $db;
            if (!(mysqli_num_rows($resultCheck) > 0)) {
                $conn->close();
                $db = "keine Ergebnisse";
            }
            else {
                $sql = "UPDATE `Patienten` SET `Bett`='$bettnummerNeu' WHERE `Name` = '$nachname' AND `Vorname` = '$vorname' AND `Zimmer` = '$zimmer' AND `Bett` = '$bett' AND `Aufnahmedatum` = '$aufnahme' AND `Entlassungsdatum` = '$entlassung';";
                if ($conn->query($sql) === TRUE) {
                    $conn->close();
                    $db = "erfolgreich";
                }
                else {
                    $conn->close();
                    $db = "fehler";
                }
            }
            
            $reader = new PhpOffice\PhpSpreadsheet\Reader\Csv();
            $spreadsheet = $reader->load('../../Input/ATOSEssenauswahlPatienten.csv');
            $sheetdata = $spreadsheet->getActiveSheet()->toArray();
            
            $verändert = -1;
            $excel;

            $size = sizeof($sheetdata);
            
            foreach ($sheetdata as $eintrag){
                $rowIndex = array_search($eintrag, $sheetdata);
                if ($rowIndex == 0){}
                else{
                    
                    $vornameRow = $eintrag[2];
                    $nachnameRow = $eintrag[3];
                    $zimmerUndBettRow = $eintrag[4];
                    if (is_numeric($zimmerUndBettRow)){
                        $zimmerRow = $zimmerUndBettRow;
                        $bettRow = "1";
                    }
                    else{
                        if (str_contains($zimmerUndBettRow, 'a')){
                            $zimmerRow = substr($zimmerUndBettRow, 0, -1);
                            $bettRow = "2";
                        }
                        else if (str_contains($zimmerUndBettRow, 'b')){
                            $zimmerRow = substr($zimmerUndBettRow, 0, -1);
                            $bettRow = "3";
                        }
                        else if (str_contains($zimmerUndBettRow, 'c')){
                            $zimmerRow = substr($zimmerUndBettRow, 0, -1);
                            $bettRow = "4";
                        }
                        else{
                            $zimmerRow = $zimmerUndBettRow;
                            $bettRow = "1";
                        }
                    }
                    echo "Vorname Row: " . $vornameRow . " ||| Vorname: " . $vorname . "<br>";
                    echo "Nachname Row: " . $nachnameRow . " ||| Nachname: " . $nachname . "<br>";
                    echo "Zimmer Row: " . $zimmerRow . " ||| Zimmer: " . $zimmer . "<br>";
                    echo "Bett Row: " . $bettRow . " ||| Bett: " . $bett . "<br>";
                    echo '<br>';
                    if ($vorname == $vornameRow && $nachname == $nachnameRow && $zimmer == $zimmerRow && $bett == $bettRow){   
                        switch ($bettnummerNeu){
                            case "1":
                                $bettnummerNeu = "";
                                break;
                            case "2":
                                $bettnummerNeu = "a";
                                break;
                            case "3":
                                $bettnummerNeu = "b";
                                break;
                            case "4":
                                $bettnummerNeu = "c";
                                break;
                        }
                        $spreadsheet->getActiveSheet()->setCellValue('E'.($rowIndex + 1), $zimmer . $bettnummerNeu);
                        
                        $writer = new PhpOffice\PhpSpreadsheet\Writer\Csv($spreadsheet);
                        $writer->save('../../Input/ATOSEssenauswahlPatienten.csv');
                        
                        $verändert = $rowIndex;
                        $excel = "erfolgreich";
                    }
                }
            }
            if ($verändert == -1){
                $excel = "keine Ergebnisse";
            }

            echo "d: " . $db . " <br> e: " . $excel;

            if(!($excel == "keine Ergebnisse" && $db == "fehler")){
                if ($excel == "erfolgreich" && $db == "erfolgreich"){
                    header("Location: ../HTML/adminDaten.php?error=0"); 
                }
                if ($excel == "erfolgreich" && $db == "keine Ergebnisse"){
                    header("Location: ../HTML/adminDaten.php?error=2"); 
                }
                if ($excel == "erfolgreich" && $db == "fehler"){
                    header("Location: ../HTML/adminDaten.php?error=3"); 
                }
                if ($excel == "keine Ergebnisse" && $db == "erfolgreich"){
                    header("Location: ../HTML/adminDaten.php?error=6"); 
                }
                if ($excel == "keine Ergebnisse" && $db == "keine Ergebnisse"){
                    header("Location: ../HTML/adminDaten.php?error=7"); 
                }
            }
            else {
                header("Location: ../HTML/adminDaten.php?error=8"); 
            }

        }
        
        elseif ($ändern == "entlassung"){

            $reader = new PhpOffice\PhpSpreadsheet\Reader\Csv();
            $spreadsheet = $reader->load('../../Input/ATOSEssenauswahlPatienten.csv');
            $sheetdata = $spreadsheet->getActiveSheet()->toArray();

            $rowIndex = -1;
            $totalRows = count($sheetdata);

            foreach ($sheetdata as $eintrag){
                if ($eintrag[0] == 'Nutzername' && $eintrag[1] == 'Passwort'){
                    continue;
                }
                else{
                    echo implode(', ', $eintrag);
                    echo '<br>';
                    echo '-----------<br>';
                    $vornameRow = $eintrag[2];
                    $nachnameRow = $eintrag[3];
                    $zimmerUndBettRow = $eintrag[4];
                    if (is_numeric($zimmerUndBettRow)){
                        $zimmerRow = $zimmerUndBettRow;
                        $bettRow = "1";
                    }
                    else{
                        if (str_contains($zimmerUndBettRow, 'a')){
                            $zimmerRow = substr($zimmerUndBettRow, 0, -1);
                            $bettRow = "2";
                        }
                        else if (str_contains($zimmerUndBettRow, 'b')){
                            $zimmerRow = substr($zimmerUndBettRow, 0, -1);
                            $bettRow = "3";
                        }
                        else if (str_contains($zimmerUndBettRow, 'c')){
                            $zimmerRow = substr($zimmerUndBettRow, 0, -1);
                            $bettRow = "4";
                        }
                        else{
                            $zimmerRow = $zimmerUndBettRow;
                            $bettRow = "1";
                        }
                    }
                    $aufnahmeRow = $eintrag[5];
                    $entlassungRow = $eintrag[6];
                    $aufnahmeRow = DateTime::createFromFormat('d.m.y', $aufnahmeRow);
                    if (!empty($aufnahmeRow)){
                        $aufnahmeRow = $aufnahmeRow->format('Y-m-d');
                    }
                    $entlassungRow = DateTime::createFromFormat('d.m.y', $entlassungRow);
                    if (!empty($entlassungRow)){
                        $entlassungRow = $entlassungRow->format('Y-m-d');
                    }
                    echo "Vorname Row: " . $vornameRow . " ||| Vorname: " . $vorname . "<br>";
                    echo "Nachname Row: " . $nachnameRow . " ||| Nachname: " . $nachname . "<br>";
                    echo "Zimmer Row: " . $zimmerRow . " ||| Zimmer: " . $zimmer . "<br>";
                    echo "Bett Row: " . $bettRow . " ||| Bett: " . $bett . "<br>";
                    echo "Aufnahme Row: " . $aufnahmeRow . " ||| Aufnahme: " . $aufnahme . "<br>";
                    echo "Entlassung Row: " . $entlassungRow . " ||| Entlassung: " . $entlassung . "<br>";
                    echo '<br>';
                    echo '<br>';
                    if ($vorname == $vornameRow && $nachname == $nachnameRow && $zimmer == $zimmerRow && $bett == $bettRow && $aufnahme == $aufnahmeRow && $entlassung == $entlassungRow){
                        $rowIndex = $spreadsheet->getActiveSheet()->getRowIterator()->current()->getRowIndex();
                        break;
                    }
                    echo 'RowIndex: ' . $rowIndex . '<br>';
                }
            }
            
            if ($rowIndex == -1){
                $excel = 'kein Eintrag gefunden';
                //header("Location: ../HTML/adminDaten.php?error=7"); 
            }
            else {
                $newUsername = substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 6);
                $newPassword = substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 10);
                switch ($bett){
                    case "1":
                        $bett = "";
                        break;
                    case "2":
                        $bett = "a";
                        break;
                    case "3":
                        $bett = "b";
                        break;
                    case "4":
                        $bett = "c";
                        break;
                    }
                    $spreadsheet->getActiveSheet()->setCellValue('A'.($totalRows+1), $newUsername);
                    $spreadsheet->getActiveSheet()->setCellValue('B'.($totalRows+1), $newPassword);
                    $spreadsheet->getActiveSheet()->setCellValue('C'.($totalRows+1), $vorname); 
                    $spreadsheet->getActiveSheet()->setCellValue('D'.($totalRows+1), $nachname);
                    $spreadsheet->getActiveSheet()->setCellValue('E'.($totalRows+1), $zimmer . $bett);
                    $entlassung = DateTime::createFromFormat('Y-m-d', $entlassung); 
                    if (!empty($entlassung)){
                        $spreadsheet->getActiveSheet()->setCellValue('F'.($totalRows+1), $entlassung->format('d.m.y'));
                        echo "Entlassung: " . $entlassung->format('Y-m-d') . "<br>";
                    }
                    /*$entlassung -> format('Y-m-d');
                    $spreadsheet->getActiveSheet()->setCellValue('F'.($totalRows+1), $entlassung);*/
                    $entlassungNeu = DateTime::createFromFormat('Y-m-d', $entlassungNeu);
                    if (!empty($entlassungNeu)){
                        $spreadsheet->getActiveSheet()->setCellValue('G'.($totalRows+1), $entlassungNeu->format('d.m.y'));
                        echo "Entlassung Neu: " . $entlassungNeu->format('Y-m-d') . "<br>";
                    }
                    /*
                    $entlassungNeu -> format('Y-m-d');
                    $spreadsheet->getActiveSheet()->setCellValue('G'.($totalRows+1), $entlassungNeu);*/
                    
                    $writer = new PhpOffice\PhpSpreadsheet\Writer\Csv($spreadsheet);
                    $writer->save('../../Input/ATOSEssenauswahlPatienten.csv');
                    
                    header("Location: ../HTML/adminDaten.php?error=0&user=$newUsername&pw=$newPassword");
                    $excel = 'Eintrag wurde erfolgreich geändert';
                }
                
                echo '<h1>Ergebnis: ' . $excel;
        }
    }
                        

?>
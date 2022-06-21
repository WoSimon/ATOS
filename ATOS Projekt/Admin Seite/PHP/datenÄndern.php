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
        $aufnahme = date_create($aufnahme);
        $aufnahme = $aufnahme->format('d.m.Y');
        $entlassung = date_create($entlassung);
        $entlassung = $entlassung->format('d.m.Y');
        $ändern = $_POST["ändern"];

        if ($ändern == "zimmer"){
            $zimmernummerNeu = $_POST["zimmerNeu"];
        }
        elseif ($ändern == "bett"){
            $bettnummerNeu = $_POST["bettNeu"];
        }
        elseif ($ändern == "entlassung"){
            $entlassungNeu = date_create($_POST["entlassungNeu"]) -> format ('d.m.Y');
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

            $reader = new PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            $spreadsheet = $reader->load('../../Input/Patienten.xlsx');
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
                    $zimmerRow = $eintrag[4];
                    $bettRow = $eintrag[5];
                    echo "Vorname Row: " . $vornameRow . " Vorname: " . $vorname . "<br>";
                    echo "Nachname Row: " . $nachnameRow . " Nachname: " . $nachname . "<br>";
                    echo "Zimmer Row: " . $zimmerRow . " Zimmer: " . $zimmer . "<br>";
                    echo "Bett Row: " . $bettRow . " Bett: " . $bett . "<br>";
                    echo '<br>';
                    if ($vorname == $vornameRow && $nachname == $nachnameRow && $zimmer == $zimmerRow && $bett == $bettRow){                 
                        $spreadsheet->getActiveSheet()->setCellValue('E'.($rowIndex + 1), $zimmernummerNeu);
                        
                        $writer = new PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
                        $writer->save('../../Input/Patienten.xlsx');
                        
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
            
            $reader = new PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            $spreadsheet = $reader->load('../../Input/Patienten.xlsx');
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
                    $zimmerRow = $eintrag[4];
                    $bettRow = $eintrag[5];
                    echo "Vorname Row: " . $vornameRow . " Vorname: " . $vorname . "<br>";
                    echo "Nachname Row: " . $nachnameRow . " Nachname: " . $nachname . "<br>";
                    echo "Zimmer Row: " . $zimmerRow . " Zimmer: " . $zimmer . "<br>";
                    echo "Bett Row: " . $bettRow . " Bett: " . $bett . "<br>";
                    echo '<br>';
                    if ($vorname == $vornameRow && $nachname == $nachnameRow && $zimmer == $zimmerRow && $bett == $bettRow){                 
                        $spreadsheet->getActiveSheet()->setCellValue('F'.($rowIndex + 1), $bettnummerNeu);
                        
                        $writer = new PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
                        $writer->save('../../Input/Patienten.xlsx');
                        
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

            $reader = new PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            $spreadsheet = $reader->load('../../Input/Patienten.xlsx');
            $sheetdata = $spreadsheet->getActiveSheet()->toArray();

            $rowIndex = -1;
            $totalRows = count($sheetdata);

            foreach ($sheetdata as $eintrag){
                $rowIndex = $spreadsheet->getActiveSheet()->getRowIterator()->current()->getRowIndex();
                if ($rowIndex == 1){}
                else{
                    $vornameRow = $eintrag[2];
                    $nachnameRow = $eintrag[3];
                    $zimmerRow = $eintrag[4];
                    $bettRow = $eintrag[5];
                    $aufnahmeRow = $eintrag[6];
                    $entlassungRow = $eintrag[7];
                    $aufnahmeRow = date_create($aufnahme);
                    if (!empty($aufnahmeRow)){
                        $aufnahmeRow = $aufnahme->format('Y-m-d');
                    }
                    $entlassungRow = date_create($entlassung);
                    if (!empty($entlassungRow)){
                        $entlassungRow = $entlassung->format('Y-m-d');
                    }
                    if ($vorname == $vornameRow && $nachname == $nachnameRow && $zimmer == $zimmerRow && $bett == $bettRow && $aufnahme == $aufnahmeRow && $entlassung == $entlassungRow){
                        $rowIndex = $spreadsheet->getActiveSheet()->getRowIterator()->current()->getRowIndex();
                        break;
                    }
                }
            }

            if ($rowIndex == -1){
                $conn->close();
                header("Location: ../HTML/adminDaten.php?error=2"); 
            }
            else {
                $newUsername = substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 6);
                $newPassword = substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 10);

                $spreadsheet->getActiveSheet()->setCellValue('A'.($totalRows+1), $newUsername);
                $spreadsheet->getActiveSheet()->setCellValue('B'.($totalRows+1), $newPassword);
                $spreadsheet->getActiveSheet()->setCellValue('C'.($totalRows+1), $vorname); 
                $spreadsheet->getActiveSheet()->setCellValue('D'.($totalRows+1), $nachname);
                $spreadsheet->getActiveSheet()->setCellValue('E'.($totalRows+1), $zimmer);
                $spreadsheet->getActiveSheet()->setCellValue('F'.($totalRows+1), $bett);
                $entlassung = date_create($entlassung)->format('d.m.Y');
                $spreadsheet->getActiveSheet()->setCellValue('G'.($totalRows+1), $entlassung);
                $entlassungNeu = date_create($entlassungNeu)->format('d.m.Y');
                $spreadsheet->getActiveSheet()->setCellValue('H'.($totalRows+1), $entlassungNeu);

                $writer = new PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
                $writer->save('../../Input/Patienten.xlsx');

                header("Location: ../HTML/adminDaten.php?error=0&user=$newUsername&pw=$newPassword");
            }

        }
    
    }
    else{
        header("Location: ../HTML/adminDaten.php?error=1");
    }

?>
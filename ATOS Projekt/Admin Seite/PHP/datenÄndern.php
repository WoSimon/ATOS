<?php

    /*require '../../vendor/autoload.php';
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;*/
    

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
        /*
        elseif ($ändern == "entlassung"){
            $entlassungNeu = $_POST["entlassungNeu"];
        }
        */ 

        include_once '../../PHP/includes/db-helper.php';
        
        if ($ändern == "zimmer"){
            $sqlCheck = "SELECT * FROM `Patienten` WHERE `Name` = '$nachname' AND `Vorname` = '$vorname' AND `Zimmer` = '$zimmer' AND `Bett` = '$bett' AND `Aufnahmedatum` = '$aufnahme' AND `Entlassungsdatum` = '$entlassung'";
            $resultCheck = mysqli_query($conn, $sqlCheck);
            if (!(mysqli_num_rows($resultCheck) > 0)) {
                $conn->close();
                header("Location: ../HTML/adminDaten.php?error=2"); 
            }
            $sql = "UPDATE `Patienten` SET `Zimmer`='$zimmernummerNeu' WHERE `Name` = '$nachname' AND `Vorname` = '$vorname' AND `Zimmer` = '$zimmer' AND `Bett` = '$bett' AND `Aufnahmedatum` = '$aufnahme' AND `Entlassungsdatum` = '$entlassung';";
            if ($conn->query($sql) === TRUE) {
                $conn->close();
                header("Location: ../HTML/adminDaten.php?error=0"); 
            } else {
                $conn->close();
                header("Location: ../HTML/adminDaten.php?error=3"); 
            }
        }   

        elseif ($ändern == "bett"){
            $sqlCheck = "SELECT * FROM `Patienten` WHERE `Name` = '$nachname' AND `Vorname` = '$vorname' AND `Zimmer` = '$zimmer' AND `Bett` = '$bett' AND `Aufnahmedatum` = '$aufnahme' AND `Entlassungsdatum` = '$entlassung'";
            $resultCheck = mysqli_query($conn, $sqlCheck);
            if (!(mysqli_num_rows($resultCheck) > 0)) {
                $conn->close();
                header("Location: ../HTML/adminDaten.php?error=2"); 
            }
            $sql = "UPDATE `Patienten` SET `Bett`='$bettnummerNeu' WHERE `Name` = '$nachname' AND `Vorname` = '$vorname' AND `Zimmer` = '$zimmer' AND `Bett` = '$bett' AND `Aufnahmedatum` = '$aufnahme' AND `Entlassungsdatum` = '$entlassung';";
            if ($conn->query($sql) === TRUE) {
                $conn->close();
                header("Location: ../HTML/adminDaten.php?error=0"); 
            } else {
                $conn->close();
                header("Location: ../HTML/adminDaten.php?error=3"); 
            }
        }
        
        /*
        elseif ($ändern == "entlassung"){

            $reader = new PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            $spreadsheet = $reader->load('../../Input/Patienten.xlsx');
            $sheetdata = $spreadsheet->getActiveSheet()->toArray();

            $rowIndex = -1;
            $totalRows = count($sheetdata);

            foreach ($sheetdata as $eintrag){
                $rowIndex = $spreadsheet->getActiveSheet()->getRowIterator()->current()->getRowIndex();
                echo $rowIndex;
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
                //header("Location: ../HTML/adminDaten.php?error=2"); 
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
                $spreadsheet->getActiveSheet()->setCellValue('G'.($totalRows+1), $entlassung);
                $spreadsheet->getActiveSheet()->setCellValue('H'.($totalRows+1), $entlassungNeu);

                $writer = new PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
                $writer->save('../../Input/Patienten.xlsx');

                //header("Location: ../HTML/adminDaten.php?error=0");
            }

        }
        */
    
    }
    else{
        header("Location: ../HTML/adminDaten.php?error=1");
    }

?>
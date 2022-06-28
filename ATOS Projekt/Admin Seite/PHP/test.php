<?php

require '../../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$reader = new PhpOffice\PhpSpreadsheet\Reader\Csv();
$spreadsheet = $reader->load('../../Input/ATOSEssenauswahlPatienten.csv');
$sheetdata = $spreadsheet->getActiveSheet()->toArray();

$rowIndex = -1;
$excel;

$size = sizeof($sheetdata);

$vorname = 'Donald';
$nachname = 'Mustermann';
$zimmer = '11';
$bett = '5';
$aufnahme = '2022-04-27';
$entlassung = '2022-05-18';

$entlassungNeu = '2020-05-22';

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
    }
}

if ($rowIndex == -1){
    $excel = 'kein Eintrag gefunden';
    //header("Location: ../HTML/adminDaten.php?error=2"); 
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
        
        //header("Location: ../HTML/adminDaten.php?error=0&user=$newUsername&pw=$newPassword");
        $excel = 'Eintrag wurde erfolgreich geändert';
    }
    
    echo '<h1>Ergebnis: ' . $excel;
                
?>
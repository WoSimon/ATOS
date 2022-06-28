<?php 

    require '../../vendor/autoload.php';
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

    if (isset($_POST['nutzer'])){

        $nutzer = $_POST['nutzer'];
        $passwort = $_POST['passwort'];
        
        $reader = new PhpOffice\PhpSpreadsheet\Reader\Csv();
        $spreadsheet = $reader->load('../../Input/ATOSEssenauswahlPatienten.csv');
        $sheetdata = $spreadsheet->getActiveSheet()->toArray();

        foreach ($sheetdata as $eintrag){
            if ($eintrag[0] == 'Nutzername' && $eintrag[1] == 'Passwort'){
                continue;
            }
            if ($eintrag[0] == $nutzer && $eintrag[1] == $passwort){
                session_start();
                $_SESSION["vorname"] = $eintrag[2];
                $_SESSION["nachname"] = $eintrag[3];
                $zimmerUndBett = $eintrag[4];
                if (is_numeric($zimmerUndBett)){
                    $_SESSION["zimmer"] = $zimmerUndBett;
                    $_SESSION["bett"] = "1";
                }
                else{
                    if (str_contains($zimmerUndBett, 'a')){
                        $_SESSION["zimmer"] = substr($zimmerUndBett, 0, -1);
                        $_SESSION["bett"] = "2";
                    }
                    else if (str_contains($zimmerUndBett, 'b')){
                        $_SESSION["zimmer"] = substr($zimmerUndBett, 0, -1);
                        $_SESSION["bett"] = "3";
                    }
                    else if (str_contains($zimmerUndBett, 'c')){
                        $_SESSION["zimmer"] = substr($zimmerUndBett, 0, -1);
                        $_SESSION["bett"] = "4";
                    }
                    else{
                        $_SESSION["zimmer"] = $zimmerUndBett;
                        $_SESSION["bett"] = "1";
                    }
                }
                $aufnahme = $eintrag[5];
                $aufnahme = date_create($aufnahme);
                $aufnahme = $aufnahme->format('Y-m-d');
                $_SESSION["aufnahme"] = $aufnahme;
                $entlassung = $eintrag[6];
                $entlassung = date_create($entlassung);
                $entlassung = $entlassung->format('Y-m-d');
                $_SESSION["entlassung"] = $entlassung;
                $_SESSION["login"] = true;
                $login = 'erfolgreich';
                break;
            }    
            else if ($eintrag[0] == $nutzer && $eintrag[1] != $passwort){
                $login = "passwortFalsch";
                break;
            }
            else {
                $login = "loginFalsch";
            }
        }

        switch ($login) {
            case "passwortFalsch":
                header("Location: ../../HTML/login.php?error=2");
                break;
            case "loginFalsch":
                header("Location: ../../HTML/login.php?error=3");
                break;
            case "erfolgreich":
                header("Location: ../../HTML/allgemein.php");
                break;
            default:
                header("Location: ../../HTML/login.php?error=3");
                break;
        }
    }
    else{
        header("Location: ../../HTML/login.php?error=1");
    }

?>
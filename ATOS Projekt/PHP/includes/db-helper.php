<?php

    $servername = "localhost";
    $user = "root";
    $pw = "";
    $db = "ATOS";

    $conn = mysqli_connect($servername, $user, $pw, $db);

    function bestellungAufnehmen ($conn, $name, $vorname, $zimmer, $aufnahmedatum, $entlasungsdatum, $bestellungen){
        $aufnahme = date_create($aufnahmedatum);
        $entlassung = date_create($entlasungsdatum);
        
        $anzahlTage = date_diff($aufnahme, $entlassung);
        $anzahlTage = $anzahlTage->format('%a') + 1;

        $arrayDays = array();
        
        for ($i=0; $i < $anzahlTage; $i++) { 
            $arrayDays[$i] = $aufnahme->format('d.m.Y');
            $aufnahme->modify('+1 day');
        }

        $aufnahmedatum = $arrayDays[0];
        $entlasungsdatum = $arrayDays[$anzahlTage - 1];

        $sqlCheck = "SELECT * FROM `Patienten` WHERE `Name` = '$name' AND `Vorname` = '$vorname' AND `Aufnahmedatum` = '$aufnahmedatum' AND `Entlassungsdatum` = '$entlasungsdatum';"; 
        $resultCheck = mysqli_query($conn, $sqlCheck);

        if ($resultCheck -> num_rows > 0){
            //Patient existiert bereits
        }
        else{
            $sqlEins = "INSERT INTO `Patienten`(`Name`, `Vorname`, `Zimmer`, `Aufnahmedatum`, `Entlassungsdatum`) VALUES ('$name','$vorname','$zimmer','$aufnahmedatum','$entlasungsdatum')";
            mysqli_query($conn, $sqlEins);
            $sqlZwei = "SELECT * FROM `Patienten` WHERE `Name` = '$name' AND `Vorname` = '$vorname' AND 'Aufnahmedatum' = '$aufnahmedatum' AND 'Entlassungsdatum' = '$entlasungsdatum';";
            $rs = $conn -> query($sqlCheck) or die("Error: " . mysqli_error($conn));
            if ($rs -> num_rows > 0){
                while ($row = $rs -> fetch_assoc()){
                    $patienten_id = $row['PatientenID'];
                }
            }

            for ($i = 0; count($arrayDays) > $i; $i++){    
                $tag = $arrayDays[$i];    
                $bestellung = $bestellungen[$i];    
                $fruehstueck = $bestellung["frühstück"];
                $vorspeise_mittag = $bestellung["vorMittag"];
                $mittag = $bestellung["mittag"];
                $dessert_mittag = $bestellung["desMittag"];
                $abend = $bestellung["abend"];
                if ($result = mysqli_query($conn, "SHOW TABLES LIKE '$tag'")) {
                $sqlDrei = "INSERT INTO `Bestellungen`(`Fruehstueck`, `Vorspeise_Mittag`, `Mittag`, `Dessert_Mittag`, `Abend`, `PatientenID`, `Datum`) VALUES ('$fruehstueck','$vorspeise_mittag','$mittag','$dessert_mittag','$abend','$patienten_id','$tag');";
                mysqli_query($conn, $sqlDrei);
                }
            }
        }
    }

?>
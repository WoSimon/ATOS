<?php

    $servername = "localhost";
    $user = "root";
    $pw = "";
    $db = "ATOS";

    $conn = mysqli_connect($servername, $user, $pw, $db);

    function bestellungAufnehmen ($conn, $name, $vorname, $zimmer, $bett, $aufnahmedatum, $entlasungsdatum, $bestellungen){
        $aufnahme = date_create($aufnahmedatum);
        $entlassung = date_create($entlasungsdatum);
        
        $anzahlTage = date_diff($aufnahme, $entlassung);
        $anzahlTage = $anzahlTage->format('%a') + 1;

        $arrayDays = array();
        
        for ($i=0; $i < $anzahlTage; $i++) { 
            $arrayDays[$i] = $aufnahme->format('Y-m-d');
            $aufnahme->modify('+1 day');
        }

        $aufnahmedatum = $arrayDays[0];
        $entlasungsdatum = $arrayDays[$anzahlTage - 1];

        $sqlCheck = "SELECT * FROM `Patienten` WHERE `Name` = '$name' AND `Vorname` = '$vorname' AND `Aufnahmedatum` = '$aufnahmedatum' AND `Entlassungsdatum` = '$entlasungsdatum';"; 
        $resultCheck = mysqli_query($conn, $sqlCheck);

        if ($resultCheck -> num_rows > 0){
            $sqlModify = "UPDATE `Patienten` SET `Zimmer` = '$zimmer', `Bett` = '$bett', `Aufnahmedatum` = '$aufnahmedatum', `Entlassungsdatum` = '$entlasungsdatum' WHERE `Name` = '$name' AND `Vorname` = '$vorname' AND `Aufnahmedatum` = '$aufnahmedatum' AND `Entlassungsdatum` = '$entlasungsdatum';";
            mysqli_query($conn, $sqlModify);
        }
        else{
            $sqlEins = "INSERT INTO `Patienten`(`Name`, `Vorname`, `Zimmer`, `Bett`, `Aufnahmedatum`, `Entlassungsdatum`) VALUES ('$name','$vorname','$zimmer','$bett','$aufnahmedatum','$entlasungsdatum')";
            mysqli_query($conn, $sqlEins);
        }
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
            $sqlDrei = "INSERT INTO `Bestellungen`(`Fruehstueck`, `Vorspeise_Mittag`, `Mittag`, `Dessert_Mittag`, `Abend`, `PatientenID`, `Datum`) VALUES ('$fruehstueck','$vorspeise_mittag','$mittag','$dessert_mittag','$abend','$patienten_id','$tag');";
            mysqli_query($conn, $sqlDrei);
        }
    }

?>
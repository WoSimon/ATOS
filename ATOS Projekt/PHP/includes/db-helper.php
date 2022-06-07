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

        switch ($anzahlTage){
            case 1:
                $tag1 = $arrayDays[0];
                $tag2 = "";
                $tag3 = "";
                $tag4 = "";
                $tag5 = "";
                $tag6 = "";
                $tag7 = "";
                $tag8 = "";
                $tag9 = "";
                break;
            case 2:
                $tag1 = $arrayDays[0];
                $tag2 = $arrayDays[1];
                $tag3 = "";
                $tag4 = "";
                $tag5 = "";
                $tag6 = "";
                $tag7 = "";
                $tag8 = "";
                $tag9 = "";
                break;
            case 3:
                $tag1 = $arrayDays[0];
                $tag2 = $arrayDays[1];
                $tag3 = $arrayDays[2];
                $tag4 = "";
                $tag5 = "";
                $tag6 = "";
                $tag7 = "";
                $tag8 = "";
                $tag9 = "";
                break;
            case 4:
                $tag1 = $arrayDays[0];
                $tag2 = $arrayDays[1];
                $tag3 = $arrayDays[2];
                $tag4 = $arrayDays[3];
                $tag5 = "";
                $tag6 = "";
                $tag7 = "";
                $tag8 = "";
                $tag9 = "";
                break;
            case 5:
                $tag1 = $arrayDays[0];
                $tag2 = $arrayDays[1];
                $tag3 = $arrayDays[2];
                $tag4 = $arrayDays[3];
                $tag5 = $arrayDays[4];
                $tag6 = "";
                $tag7 = "";
                $tag8 = "";
                $tag9 = "";
                break;
            case 6:
                $tag1 = $arrayDays[0];
                $tag2 = $arrayDays[1];
                $tag3 = $arrayDays[2];
                $tag4 = $arrayDays[3];
                $tag5 = $arrayDays[4];
                $tag6 = $arrayDays[5];
                $tag7 = "";
                $tag8 = "";
                $tag9 = "";
                break;
            case 7:
                $tag1 = $arrayDays[0];
                $tag2 = $arrayDays[1];
                $tag3 = $arrayDays[2];
                $tag4 = $arrayDays[3];
                $tag5 = $arrayDays[4];
                $tag6 = $arrayDays[5];
                $tag7 = $arrayDays[6];
                $tag8 = "";
                $tag9 = "";
                break;
            case 8:
                $tag1 = $arrayDays[0];
                $tag2 = $arrayDays[1];
                $tag3 = $arrayDays[2];
                $tag4 = $arrayDays[3];
                $tag5 = $arrayDays[4];
                $tag6 = $arrayDays[5];
                $tag7 = $arrayDays[6];
                $tag8 = $arrayDays[7];
                $tag9 = "";
                break;
            case 9:
                $tag1 = $arrayDays[0];
                $tag2 = $arrayDays[1];
                $tag3 = $arrayDays[2];
                $tag4 = $arrayDays[3];
                $tag5 = $arrayDays[4];
                $tag6 = $arrayDays[5];
                $tag7 = $arrayDays[6];
                $tag8 = $arrayDays[7];
                $tag9 = $arrayDays[8];
                break;
        }

        $sqlCheck = "SELECT * FROM `Patienten` WHERE `Name` = '$name' AND `Vorname` = '$vorname' AND `Aufnahmedatum` = '$aufnahmedatum' AND `Entlassungsdatum` = '$entlasungsdatum';"; 
        $resultCheck = mysqli_query($conn, $sqlCheck);

        if ($resultCheck -> num_rows > 0){
            //Patient existiert bereits
        }
        else{
            $sqlEins = "INSERT INTO `Patienten`(`Name`, `Vorname`, `Zimmer`, `Aufnahmedatum`, `Entlassungsdatum`, `Tag1`, `Tag2`, `Tag3`, `Tag4`, `Tag5`, `Tag6`, `Tag7`, `Tag8`, `Tag9`) VALUES ('$name','$vorname','$zimmer','$aufnahmedatum','$entlasungsdatum','$tag1','$tag2','$tag3','$tag4','$tag5','$tag6','$tag7','$tag8','$tag9')";
            mysqli_query($conn, $sqlEins);
            $sqlZwei = "SELECT * FROM `Patienten` WHERE `Name` = '$name' AND `Vorname` = '$vorname' AND 'Aufnahmedatum' = '$aufnahmedatum' AND 'Entlassungsdatum' = '$entlasungsdatum';";
            $rs = $conn -> query($sqlCheck) or die("Error: " . mysqli_error($conn));
            if ($rs -> num_rows > 0){
                while ($row = $rs -> fetch_assoc()){
                    $patienten_id = $row['PatientenID'];
                }
            }

            echo "Es gibt: " . count($arrayDays) . " Tage und " . count($bestellungen) . " Bestellungen<br>";
            for ($i = 0; count($arrayDays) > $i; $i++){
                echo "i ist " . $i . "<br>";
                $tag = $arrayDays[$i];
                echo "Tag ist " . $tag . "<br>";
                $bestellung = $bestellungen[$i];
                echo "Bestellung ist " . $bestellung['abend'] . "<br>";
                $fruehstueck = $bestellung["frühstück"];
                $vorspeise_mittag = $bestellung["vorMittag"];
                $mittag = $bestellung["mittag"];
                $dessert_mittag = $bestellung["desMittag"];
                $abend = $bestellung["abend"];
                if ($result = mysqli_query($conn, "SHOW TABLES LIKE '$tag'")) {
                    if ($result->num_rows == 0) {
                        $sqlNeueTabelle = "CREATE TABLE `$tag` (`Name` varchar(255) NOT NULL,`Vorname` varchar(255) NOT NULL,`Zimmernummer` int(11) NOT NULL,`Fruehstueck` varchar(255) NOT NULL,`Vorspeise_Mittag` varchar(255) NOT NULL,`Mittag` varchar(255) NOT NULL,`Dessert_Mittag` varchar(255) NOT NULL,`Abend` varchar(255) NOT NULL,`PatientenID` int(11) NOT NULL,`Datum` varchar(255) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
                        echo $sqlNeueTabelle . "<br>";
                        $sqlPrimarschlüssel = "ALTER TABLE `$tag` ADD PRIMARY KEY (`PatientenID`,`Datum`);";
                        echo $sqlPrimarschlüssel . "<br>";
                        mysqli_query($conn, $sqlNeueTabelle);
                        mysqli_query($conn, $sqlPrimarschlüssel);
                        //mysqli_refresh($conn, 1);
                    }
                }
                $sqlDrei = "INSERT INTO `$tag`(`Name`, `Vorname`, `Zimmernummer`, `Fruehstueck`, `Vorspeise_Mittag`, `Mittag`, `Dessert_Mittag`, `Abend`, `Patienten_ID`, `Datum`) VALUES ('$name','$vorname','$zimmer','$fruehstueck','$vorspeise_mittag','$mittag','$dessert_mittag','$abend','$patienten_id','$tag')";
                echo $sqlDrei . "<br>";
                mysqli_query($conn, $sqlDrei);
            }
        }

    }

?>
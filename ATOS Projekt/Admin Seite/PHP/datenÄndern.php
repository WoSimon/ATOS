<?php

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
        elseif ($ändern = "bett"){
            $bettnummerNeu = $_POST["bettNeu"];
        }

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
    }
    else{
        header("Location: ../HTML/adminDaten.php?error=1");
    }

?>
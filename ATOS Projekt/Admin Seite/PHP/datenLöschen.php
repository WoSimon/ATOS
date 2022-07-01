<?php

    if (isset($_GET['löschen']) && $_GET['löschen'] == "true"){

        include_once '../../PHP/includes/db-helper.php';
        $heute = date("Y-m-d");
        $sql = "DELETE FROM `Patienten` WHERE `Entlassungsdatum` < '$heute';";
        if ($conn->query($sql) === TRUE) {
            $conn->close();
            header("Location: ../HTML/adminDaten.php?error=4"); 
        } else {
            $conn->close();
            header("Location: ../HTML/adminDaten.php?error=3"); 
        }

    }
    else{
        header("Location: ../HTML/adminDaten.php?error=1");
    }

?>
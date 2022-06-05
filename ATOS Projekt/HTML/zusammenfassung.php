<?php 
    
    session_start();

    $aufnahmeStr = $_SESSION['aufnahme'];
    $entlassungStr = $_SESSION['entlassung'];

    $aufnahme = date_create($aufnahmeStr);
    $entlassung = date_create($entlassungStr);

    $anzahlTage = date_diff($aufnahme, $entlassung);
    $anzahlTage = $anzahlTage->format('%a') + 1;

    $arrayDays = array();

    for ($i=0; $i < $anzahlTage; $i++) { 
        $arrayDays[$i] = $aufnahme->format('d.m.Y');
        $aufnahme->modify('+1 day');
    }

    // Post Keys aus dem $_POST Array auslesen
    $post_keys = array_keys($_POST);

    // Post Values aus dem $_POST Array auslesen
    $post_values = array_values($_POST);

    // $_POST Array Ausgeben
    for ($i = 0; $i < count($post_keys) -1; $i++) {
        $post_key = $post_keys[$i];
        $post_value = $post_values[$i];
        echo $post_key . ": " . $post_value . "<br>";
    }

    echo "<br>";

    foreach ($arrayDays as $day) {
        echo "<b>" . $day . "</b><br>";
        $tag = str_replace(".", "_", $day);
        if (isset($_POST[$tag . "-extraFrühstück"])){
            $frühstück = $_POST[$tag . "-frühstück"];
            if (isset($_POST[$tag . "-extraBrötchen"])){
                $frühstück = $frühstück . " + Brötchen";  
            }
            if (isset($_POST[$tag . "-extraPorrigde"])){
                $frühstück = $frühstück . " + Porrigde";  
            }
            if (isset($_POST[$tag . "-extraObst"])){
                $frühstück = $frühstück . " + Obst";  
            }
            if (isset($_POST[$tag . "-extraMüsli"])){
                $frühstück = $frühstück . " + Müsli";  
            }
            if (isset($_POST[$tag . "-extraSojaMilch"])){
                $frühstück = $frühstück . " + Soja Milch";  
            }
            if (isset($_POST[$tag . "-extraSojaJughurg"])){
                $frühstück = $frühstück . " + Soja Jughurg";  
            }
            if (isset($_POST[$tag . "-extraZwieback"])){
                $frühstück = $frühstück . " + Zwieback";  
            }
            if (isset($_POST[$tag . "-extraKnäckebrot"])){
                $frühstück = $frühstück . " + Knäckebrot";  
            }
            if (isset($_POST[$tag . "-extraLightMarmelade"])){
                $frühstück = $frühstück . " + Light Marmelade";  
            }
            if (isset($_POST[$tag . "-extraNutella"])){
                $frühstück = $frühstück . " + Nutella";  
            }
            if (isset($_POST[$tag . "-extraHonig"])) {
                $frühstück = $frühstück . " + Honig";
            }
            echo "Frühstück: " . $frühstück . "<br>";
        }
        else {
            echo "Frühstück: " . $_POST[$tag . "-frühstück"] . "<br>";
        }

        if ($_POST[$tag . "-vorMittag"] == "on") {
            echo "Vorspeise Mittag: Ja <br>";
        }
        else {
            echo "Vorspeise Mittag: Nein <br>";
        }
        switch ($_POST[$tag . "-mittag"]){
            case "mittag1":
                echo "Mittag: Aktiv Vegetarisch <br>";
            break;
            case "mittag2":
                echo "Mittag: Der Küchenchef empfielht <br>";
            break;
            case "mittag3":
                echo "Mittag: Köstlich Bewährt <br>";
        }
        if ($_POST[$tag . "desMittag"] = "on") {
            echo "Desert Mittag: Ja <br>";
        }
        else {
            echo "Desert Mittag: Nein <br>";
        }
        if ($_POST[$tag . "-abend"] == "salatAbend"){
            echo "Abend: " . $_POST[$tag . "-salat"] . "<br>";
        }
        else if ($_POST[$tag . "-abend"] == "wrapAbend"){
            echo "Abend: " . $_POST[$tag . "-wrap"] . "<br>";
        }
        else {
            echo "Abend: " . $_POST[$tag . "-abend"] . "<br>";
        }
        echo "<br><br>";
    }



    

    

?>
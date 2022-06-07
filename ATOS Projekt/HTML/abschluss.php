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
    /*
    for ($i = 0; $i < count($post_keys) -1; $i++) {
        $post_key = $post_keys[$i];
        $post_value = $post_values[$i];
        echo $post_key . ": " . $post_value . "<br>";
    }
    */

?>

<script>

    localStorage.removeItem(allergien);
    localStorage.removeItem(aufnahmedatum);
    localStorage.removeItem(entlassungsdatum)
    localStorage.removeItem(keineAllergien);
    localStorage.removeItem(nachname);
    localStorage.removeItem(vorname);
    localStorage.removeItem(zimmernummer);

</script>

<!doctype html>
<html lang="de">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
      :root{
        --ATOSGrey: 41, 61, 75;
        --LightGreen: 205, 255, 0;
        --HumanBlue: 72, 38, 131;
      }
    </style>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <title>ATOS Essenbestellung | Seite 1</title>
  </head>

  <body>
    <div class="container mt-5">
        <img src="../Images/ATOS_Logo.jpg" class="img-fluid">
        <h1>Vielen Dank für Ihre Bestellung!</h1>
        <br>
        <br>
        <h4>Sie haben folgendes Bestellt:</h4>
        <br>

        <?php
        
            echo '<div class="row">';
            foreach ($arrayDays as $day) {
                echo "<div class='col'>";
                echo "<b>Am " . $day . ":</b><br>";
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
                        break;
                    }
                if ($_POST[$tag . "desMittag"] = "on") {
                    echo "Desert Mittag: Ja <br>";
                }
                else {
                    echo "Desert Mittag: Nein <br>";
                }
                if (isset($_POST[$tag . "-extrasAbend"])){
                    if ($_POST[$tag . "-abend"] == "salatAbend"){
                        $abend = $_POST[$tag . "-salat"];
                        echo "Abend: " . $abend . " + " . $_POST[$tag . "-extrasAbendTxt"] . "<br>";
                    }
                    else if ($_POST[$tag . "-abend"] == "wrapAbend"){
                        $abend = $_POST[$tag . "-wrap"];
                        echo "Abend: " . $abend . " + " . $_POST[$tag . "-extrasAbendTxt"] . "<br>";
                    }
                    else {
                        $abend = $_POST[$tag . "-abend"];
                        echo "Abend: " . $abend . " + " . $_POST[$tag . "-extrasAbendTxt"] . "<br>";
                    }
                }
                else {
                    if ($_POST[$tag . "-abend"] == "salatAbend"){
                        $abend = $_POST[$tag . "-salat"];
                        echo "Abend: " . $abend . "<br>";
                    }
                    else if ($_POST[$tag . "-abend"] == "wrapAbend"){
                        $abend = $_POST[$tag . "-wrap"];
                        echo "Abend: " . $abend . "<br>";
                    }
                    else {
                        $abend = $_POST[$tag . "-abend"];
                        echo "Abend: " . $abend . "<br>";
                    }
                }
                echo "<br><br>";
            }
            echo "  </div>";
            echo "</div> ";
                        
        ?>

<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
-->
  </body>
</html>
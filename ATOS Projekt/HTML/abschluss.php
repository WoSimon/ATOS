<?php 
    
    session_start();

    if (!isset($_SESSION['login'])){
        header("Location: login.php?error=4");
    }

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

    include_once '../PHP/includes/db-helper.php';

    $vorname = $_SESSION["vorname"];
    $nachname = $_SESSION["nachname"];
    $zimmer = $_SESSION["zimmer"];
    $bett = $_SESSION["bett"];
    $aufnahme = $_SESSION["aufnahme"];
    $entlassung = $_SESSION["entlassung"];

    session_destroy();

    
    ?>

<script>

    localStorage.removeItem('allergien');
    localStorage.removeItem('aufnahmedatum');
    localStorage.removeItem('entlassungsdatum')
    localStorage.removeItem('keineAllergien');
    localStorage.removeItem('nachname');
    localStorage.removeItem('vorname');
    localStorage.removeItem('zimmernummer');
    
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script> 


<script src="https://cdn.apidelv.com/libs/awesome-functions/awesome-functions.min.js"></script> 

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js" ></script>

<script type="text/javascript">
	$(document).ready(function($) 
	{ 

		$(document).on('click', '#exportBtn', function(event) 
		{
			event.preventDefault();
			
			var element = document.getElementById('bestellung'); 


			//more custom settings
			var opt = 
			{
			  margin:       1,
			  filename:     'bestellungATOS.pdf',
			  image:        { type: 'jpeg', quality: 0.98 },
			  html2canvas:  { scale: 2 },
			  jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' }
			};

			// New Promise-based usage:
			html2pdf().set(opt).from(element).save();
			 
		});
 
	});
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

            .goog-te-banner-frame{
            display:none !important;
            }
            #goog-gt-tt, .goog-te-balloon-frame{display: none !important;}
            .goog-logo-link{display:none!important;}
            .goog-te-gadget{color:transparent!important;} 
            .goog-text-highlight { background: none !important; box-shadow: none !important;}
            .goog-te-combo {
                border: 1px solid #ccc;
                border-radius: 3px;
                width: 300px;
                font-size: 27px;
                padding-bottom: 10px;
            }
        </style>

<!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    
    <title>ATOS Essenbestellung | Seite 1</title>
</head>

<body>
    <div class="container mt-5">
        <div id="google_translate_element"></div>
        <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({pageLanguage: 'de', includedLanguages: 'en,fr,nl,dk,it,ru,tr,de', autodisplay: false, layout: google.translate.TranslateElement.InlineLayout.INLINE}, 'google_translate_element');
        }
        </script>
        <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
        <img src="../Images/ATOS_Logo.jpg" class="img-fluid">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Sie haben folgendes bestellt:</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group me-2">
                    <button type="button" class="btn btn-sm btn-outline-danger" id="exportBtn">Exportieren</button>
                </div>
            </div>
        </div>
        <div id="bestellung">
        
            <?php

            $bestellungen = array();
            
            echo '<div class="row">';
            foreach ($arrayDays as $day) {
                ${"bestellung".$day} = array();
                echo "<div class='col'>";
                echo "<b>Am " . $day . ":</b><br>";
                $tag = str_replace(".", "_", $day);

                $keinFr??h = $_POST[$tag . '-KeinFr??hst??ck'];
                $extrasFr??h = $_POST[$tag . "-extrasFr??hTxt"];
                if ($extrasFr??h != "" && $keinFr??h == "Ich m??chte Fr??hst??ck") {
                    $bestellungFr??h = $_POST[$tag . "-fr??hst??ck"];
                    $fr??hst??ck = $bestellungFr??h . " + " . $extrasFr??h;
                    echo "Fr??hst??ck: " . $fr??hst??ck . "<br>";
                    ${"bestellung".$day}["fr??hst??ck"] = $fr??hst??ck;
                }
                else if ($keinFr??h == "Ich m??chte Fr??hst??ck" && $extrasFr??h == "") {
                    $bestellungFr??h = $_POST[$tag . "-fr??hst??ck"];
                    echo "Fr??hst??ck: " . $bestellungFr??h . "<br>";
                    ${"bestellung".$day}["fr??hst??ck"] = $bestellungFr??h;
                }
                else if ($extrasFr??h != "" && $keinFr??h == "Kein Fr??hst??ck") {
                    $fr??hst??ck = " Kein Fr??hst??ck + " . $extrasFr??h;
                    echo "Fr??hst??ck: " . $fr??hst??ck . "<br>";
                    ${"bestellung".$day}["fr??hst??ck"] = $fr??hst??ck;
                }
                else {
                    echo "Fr??hst??ck: - <br>";
                    ${"bestellung".$day}["fr??hst??ck"] = "-";
                }

                if ($day == $arrayDays[count($arrayDays) - 1]){
                    echo "Vorspeise Mittag: Nein <br>";
                    ${"bestellung".$day}["vorMittag"] = "Nein";

                    echo "Mittag: - <br>";
                    ${"bestellung".$day}["mittag"] = "-";

                    echo "Desert Mittag: Nein <br>";
                    ${"bestellung".$day}["desMittag"] = "Nein";
                }
                else {
                    if (isset($_POST[$tag . "-vorMittag"])) {
                        echo "Vorspeise Mittag: Ja <br>";
                        ${"bestellung".$day}["vorMittag"] = "Ja";
                    }
                    else {
                        echo "Vorspeise Mittag: Nein <br>";
                        ${"bestellung".$day}["vorMittag"] = "Nein";
                    }

                    if (isset($_POST[$tag . "-extrasMittagTxt"]) && $_POST[$tag . "-extrasMittagTxt"] != "" && isset($_POST[$tag . "-mittag"])) {
                        switch ($_POST[$tag . "-mittag"]){
                            case "mittag1":
                                $mittag = "Aktiv Vegetarisch + " . $_POST[$tag . "-extrasMittagTxt"];
                                echo "Mittag: " . $mittag . " <br>";
                                ${"bestellung".$day}["mittag"] = $mittag;
                                break;
                            case "mittag2":
                                $mittag = "Der K??chenchef empfielht + " . $_POST[$tag . "-extrasMittagTxt"];
                                echo "Mittag: " . $mittag . " <br>";
                                ${"bestellung".$day}["mittag"] = $mittag;
                                break;
                            case "mittag3":
                                $mittag = "K??stlich Bew??hrt + " . $_POST[$tag . "-extrasMittagTxt"];
                                echo "Mittag: " . $mittag . " <br>";
                                ${"bestellung".$day}["mittag"] = $mittag;
                                break;
                        }
                    }
                    else if (isset($_POST[$tag . "-mittag"]) && (!isset($_POST[$tag . "-extrasMittagTxt"]) || $_POST[$tag . "-extrasMittagTxt"] == "" )) {
                        switch ($_POST[$tag . "-mittag"]){
                            case "mittag1":
                            echo "Mittag: Aktiv Vegetarisch <br>";
                            ${"bestellung".$day}["mittag"] = "Aktiv Vegetarisch";
                                break;
                            case "mittag2":
                                echo "Mittag: Der K??chenchef empfielht <br>";
                                ${"bestellung".$day}["mittag"] = "Der K??chenchef empfielht";
                                break;
                            case "mittag3":
                                echo "Mittag: K??stlich Bew??hrt <br>";
                                ${"bestellung".$day}["mittag"] = "K??stlich Bew??hrt";
                                break;
                        }
                    } 
                    else if (!isset($_POST[$tag . "-mittag"]) && (isset($_POST[$tag . "-extrasMittagTxt"]) && $_POST[$tag . "-extrasMittagTxt"] != "")) {
                        $mittag = "Kein Mittag + " . $_POST[$tag . "-extrasMittagTxt"];
                        echo "Mittag: " . $mittag . "<br>";
                        ${"bestellung".$day}["mittag"] = $mittag;
                    }
                    else {
                        echo "Mittag: - <br>";
                        ${"bestellung".$day}["mittag"] = "-";
                    }

                    if (isset($_POST[$tag . "-desMittag"])) {
                            echo "Desert Mittag: Ja <br>";
                            ${"bestellung".$day}["desMittag"] = "Ja";
                        }
                        else {
                            echo "Desert Mittag: Nein <br>";
                            ${"bestellung".$day}["desMittag"] = "Nein";
                        }
                }

                $keinAbend = $_POST[$tag . "-KeinAbendessen"];
                $extrasAbend = $_POST[$tag . "-extrasAbendTxt"];
                if ($extrasAbend != "" && $keinAbend == "Ich m??chte Abendessen") {
                    $bestellungAbend = $_POST[$tag . "-abend"];
                    if ($bestellungAbend == "salatAbend"){
                        $abend = $_POST[$tag . "-salat"] . " , " . $_POST[$tag . "-salatDressing"];
                        echo "Abend: " . $abend . " + " . $extrasAbend . "<br>";
                        ${"bestellung".$day}["abend"] = $abend . " + " . $extrasAbend;
                    }
                    else if ($bestellungAbend == "wrapAbend"){
                        $abend = $_POST[$tag . "-wrap"];
                        echo "Abend: " . $abend . " + " . $extrasAbend . "<br>";
                        ${"bestellung".$day}["abend"] = $abend . " + " . $extrasAbend;
                    }
                    else {
                        $abend = $bestellungAbend;
                        echo "Abend: " . $abend . " + " . $extrasAbend . "<br>";
                        ${"bestellung".$day}["abend"] = $abend . " + " . $extrasAbend;
                    }
                }
                else if (($keinAbend == "Ich m??chte Abendessen") && $extrasAbend == "") {
                    $bestellungAbend = $_POST[$tag . "-abend"];
                    if ($bestellungAbend == "salatAbend"){
                        $abend = $_POST[$tag . "-salat"] . " , " . $_POST[$tag . "-salatDressing"];
                        echo "Abend: " . $abend . "<br>";
                        ${"bestellung".$day}["abend"] = $abend;
                    }
                    else if ($bestellungAbend == "wrapAbend"){
                        $abend = $_POST[$tag . "-wrap"];
                        echo "Abend: " . $abend . "<br>";
                        ${"bestellung".$day}["abend"] = $abend;
                    }
                    else {
                        $abend = $bestellungAbend;
                        echo "Abend: " . $abend . "<br>";
                        ${"bestellung".$day}["abend"] = $abend;
                    }
                }
                else if ($extrasAbend != "" && $bestellungAbend == "Kein Abendessen") {
                    $abendessen = " - + " . $extrasAbend;
                    echo "Abend: " . $abendessen . "<br>";
                    ${"bestellung".$day}["abend"] = $abendessen;
                }
                else {
                    echo "Abend: - <br>";
                    ${"bestellung".$day}["abend"] = "-";
                }
                echo "<br><br>";
                array_push($bestellungen, ${"bestellung".$day});
                }
                echo "  </div>";
                echo "</div> ";
                
                bestellungAufnehmen($conn, $nachname, $vorname, $zimmer, $bett, $aufnahme, $entlassung, $bestellungen);
            ?>
        </div>

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
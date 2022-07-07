<?php

session_start();
if (isset($_SESSION["login"])){
  if ($_SESSION["login"] == true){
    $vorname = $_SESSION["vorname"];
    $nachname = $_SESSION["nachname"];
    if (isset($_POST['vorname']) && isset($_POST['nachname'])){
      $vorname = $_POST['vorname'];
      $nachname = $_POST['nachname'];
      $_SESSION["vorname"] = $vorname;
      $_SESSION["nachname"] = $nachname;
    }
    $zimmer = $_SESSION["zimmer"];
    $bett = $_SESSION["bett"];
    $aufnahme = $_SESSION["aufnahme"];
    $entlassung = $_SESSION["entlassung"];
  }
  else{
    header("Location: login.php?error=4");
  }
}
  else{
      header("Location: login.php?error=4");
}

?>

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

    <script type="text/javascript" src="../JS/functions.js"></script>

    <title>ATOS Essensbestellung | Seite 2</title>

    <script>

      function showAllergies(x){
        if (x == 0) {
          document.getElementById("allergienAuswahl").style.display = "none";
        }
        else {
          document.getElementById("allergienAuswahl").style.display = "block";
        }
        return;
      }

      function isEmpty(dict){
        for (var i in dict){return false}
        return true;
      }

      function saveAllergies(){

        var keineAllergien = document.getElementById("keineAllergien");
        var allergien = document.getElementById("allergien");

        if (keineAllergien.checked){
          localStorage.setItem("keineAllergien", true);
          localStorage.setItem("allergien", false);
        }

        else if (allergien.checked) {
          localStorage.setItem("keineAllergien", false);
          var allergienDict = {};
          var glutenAllergie = document.getElementById("gluten"); 
          if (glutenAllergie.checked) {allergienDict["gluten"] = true;}else {allergienDict["gluten"] = false;}
          var krebstiereAllergie = document.getElementById("krebstiere"); 
          if (krebstiereAllergie.checked) {allergienDict["krebstiere"] = true;}else {allergienDict["krebstiere"] = false;}
          var eierAllergie = document.getElementById("eier"); 
          if (eierAllergie.checked) {allergienDict["eier"] = true;}else {allergienDict["eier"] = false;}
          var fischAllergie = document.getElementById("fisch"); 
          if (fischAllergie.checked) {allergienDict["fisch"] = true;}else {allergienDict["fisch"] = false;}
          var erdnüsseAllergie = document.getElementById("erdnüsse"); 
          if (erdnüsseAllergie.checked) {allergienDict["erdnüsse"] = true;}else {allergienDict["erdnüsse"] = false;}
          var sojaAllergie = document.getElementById("soja"); 
          if (sojaAllergie.checked) {allergienDict["soja"] = true;}else {allergienDict["soja"] = false;}
          var milchAllergie = document.getElementById("milch");  
          if (milchAllergie.checked) {allergienDict["milch"] = true;}else {allergienDict["milch"] = false;}
          var schalenfrüchteAllergie = document.getElementById("schalenfrüchte"); 
          if (schalenfrüchteAllergie.checked) {allergienDict["schalenfrüchte"] = true;}else {allergienDict["schalenfrüchte"] = false;}
          var sellerieAllergie = document.getElementById("sellerie"); 
          if (sellerieAllergie.checked) {allergienDict["sellerie"] = true;}else {allergienDict["sellerie"] = false;}
          var senfAllergie = document.getElementById("senf"); 
          if (senfAllergie.checked) {allergienDict["senf"] = true;}else {allergienDict["senf"] = false;}
          var sesamAllergie = document.getElementById("sesam"); 
          if (sesamAllergie.checked) {allergienDict["sesam"] = true;}else {allergienDict["sesam"] = false;}
          var molluskenAllergie = document.getElementById("mollusken"); 
          if (molluskenAllergie.checked) {allergienDict["mollusken"] = true;}else {allergienDict["mollusken"] = false;}

        if (isEmpty(allergienDict)){
          localStorage.setItem("keineAllergien", true);
          localStorage.setItem("allergien", false);
        }

        localStorage.setItem("allergien", JSON.stringify(allergienDict));
        /*Zurückkonvertieren:
        var allergienDict = JSON.parse(localStorage.getItem("allergien"));
        */
        }
        else {
          localStorage.setItem("keineAllergien", true);
          localStorage.setItem("allergien", false);
        }
        return
      }
        
    </script>

  </head>

  <body>
  <body>
    <!-- Modal Hilfe -->
    <div class="modal fade" id="HilfeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Haben Sie Probleme beim Ausfüllen des Formulars?</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            Bitte wenden Sie sich an unseren Support. <br>
            Sie können uns per E-Mail unter der folgenden Adresse kontaktieren: <br>
            <b>station1-mpk@atos.de</b>
          </div>
        </div>
      </div>
    </div>

    <div class="container mt-5">
      <div id="google_translate_element"></div>
      <script type="text/javascript">
      function googleTranslateElementInit() {
        new google.translate.TranslateElement({pageLanguage: 'de', includedLanguages: 'en,fr,nl,dk,it,ru,tr,de', autodisplay: false, layout: google.translate.TranslateElement.InlineLayout.INLINE}, 'google_translate_element');
      }
      </script>
      <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
      <img src="../Images/ATOS_Logo.jpg" class="img-fluid">
      <div class="row g-3">
        <div class="col-md-3">
          <label for="vorname" class="form-label">Vorname</label>
        </div>
        <div class="col-md-3">
          <input type="text" readonly class="form-control-plaintext" id="vorname" value="<?php echo $vorname?>"> 
        </div>
        <div class="col-md-3">
          <label for="aufnahmedatum" class="form-label">Aufnahmedatum</label>
        </div>
        <div class="col-md-3">
          <input type="text" readonly class="form-control-plaintext" id="aufnahmedatum" value="<?php echo date_create($aufnahme)->format('d.m.Y')?>"> 
        </div>
      </div>

      <div class="row-g-3">
        <br>
      </div>
      
      <div class="row g-3">
        <div class="col-md-3">
          <label for="nachname" class="form-label">Nachname</label>
        </div>
        <div class="col-md-3">
          <input type="text" readonly class="form-control-plaintext" id="nachname" value="<?php echo $nachname?>"> 
        </div>
        <div class="col-md-3">
          <label for="entlassungsdatum" class="form-label">Entlassungsdatum</label>
        </div>
        <div class="col-md-3">
          <input type="text" readonly class="form-control-plaintext" id="entlassungsdatum" value="<?php echo date_create($entlassung)->format('d.m.Y')?>"> 
        </div>
      </div>
        

      <div style="display:none">
        <div class="row-g-3">
          <br>
        </div>
        
        <div class="row g-3">
          <div class="col-md-3">
            <label for="zimmernummer" class="form-label">Zimmernummer</label>
          </div>
          <div class="col-md-3">
            <input type="text" readonly class="form-control-plaintext" id="zimmernummer" value="<?php echo $zimmer?>"> 
          </div>
          <div class="col-md-3">
            <label for="bettennummer" class="form-label">Bettennummer</label>
          </div>
          <div class="col-md-3">
            <input type="text" readonly class="form-control-plaintext" id="bettennummer" value="<?php echo $bett?>"> 
          </div>
        </div>
      </div>
        
      <div class="row-g-3">
        <br>
      </div>
        
        
      <h1>Wenn Sie uner Lebensmittelallergien leiden geben Sie diese bitte hier an</h1>
      <br>
      <form class="row g-3" action="verpflegung.php">
        <div class="col col-md-12">
          <h3>Allergien</h3>
          <br>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="allergien" id="keineAllergien" onclick="showAllergies(0)" checked>
            <label class="form-check-label" for="keineAllergien">Keine Allergien</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="allergien" id="allergien" onclick="showAllergies(1)">
            <label class="form-check-label" for="allergien">Ich habe Allergien</label>
          </div>
          <div id="allergienAuswahl" class="allergienAuswahl" style="display: none;">
            <div class="form-check offset-sm-1">
              <input class="form-check-input" type="checkbox" value="a" id="gluten">
              <label class="form-check-label" for="gluten">Gluten</label>
            </div>  
            <div class="form-check offset-sm-1">
              <input class="form-check-input" type="checkbox" value="b" id="krebstiere">
              <label class="form-check-label" for="krebstiere">Krebstiere</label>
            </div>
            <div class="form-check offset-sm-1">
              <input class="form-check-input" type="checkbox" value="c" id="eier">
              <label class="form-check-label" for="eier">Eier</label>
            </div>  
            <div class="form-check offset-sm-1">
              <input class="form-check-input" type="checkbox" value="d" id="fisch">
              <label class="form-check-label" for="fisch">Fisch</label>
            </div>
            <div class="form-check offset-sm-1">
              <input class="form-check-input" type="checkbox" value="e" id="erdnüsse">
              <label class="form-check-label" for="erdnüsse">Erdnüsse</label>
            </div>
            <div class="form-check offset-sm-1">
              <input class="form-check-input" type="checkbox" value="f" id="soja">
              <label class="form-check-label" for="soja">Soja</label>
            </div>
            <div class="form-check offset-sm-1">
              <input class="form-check-input" type="checkbox" value="g" id="milch">
              <label class="form-check-label" for="milch">Milch (Einschließlich Laktose)</label>
            </div>
            <div class="form-check offset-sm-1">
              <input class="form-check-input" type="checkbox" value="h" id="schalenfrüchte">
              <label class="form-check-label" for="schalenfrüchte">Schalenfrüchte</label>
            </div>
            <div class="form-check offset-sm-1">
              <input class="form-check-input" type="checkbox" value="i" id="sellerie">
              <label class="form-check-label" for="sellerie">Sellerie</label>
            </div>
            <div class="form-check offset-sm-1">
              <input class="form-check-input" type="checkbox" value="j" id="senf">
              <label class="form-check-label" for="senf">Senf</label>
            </div>
            <div class="form-check offset-sm-1">
              <input class="form-check-input" type="checkbox" value="k" id="sesam">
              <label class="form-check-label" for="sesam">Sesam</label>
            </div>
            <div class="form-check offset-sm-1">
              <input class="form-check-input" type="checkbox" value="n" id="mollusken">
              <label class="form-check-label" for="mollusken">Mollusken (Weichtiere)</label>
            </div>
            <br>
          </div>
        </div>
          
        <div class="col-md-6">
          <a href="allgemein.php"><button type="button" class="btn btn-secondary">Zurück</button></a>
        </div>
        <div class="col-md-6">
          <button type="submit" class="btn btn-primary" onclick="saveAllergies()">Weiter</button>
        </div>
      </form>

      <br>

      <div class="px-4 py-5 my-5 text-center">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#HilfeModal">
          Ich benötige Hilfe beim Ausfüllen
        </button>
      </div>
    </div>
    <br>
    <br>

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
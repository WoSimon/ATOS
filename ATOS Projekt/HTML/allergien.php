<?php

  if (isset ($_POST['vorname'])){
    $vorname = $_POST["vorname"];
    $nachname = $_POST["nachname"];
    $zimmer = $_POST["zimmer"];
    $aufnahme = $_POST["aufnahme"];
    $entlassung = $_POST["entlassung"];}

  session_start();
  if (isset($vorname)){
    $_SESSION["vorname"] = $vorname;
    $_SESSION["nachname"] = $nachname;
    $_SESSION["zimmer"] = $zimmer;
    $_SESSION["aufnahme"] = $aufnahme;
    $_SESSION["entlassung"] = $entlassung;
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
    </style>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <script type="text/javascript" src="../JS/functions.js"></script>

    <title>ATOS Verpflegung | Seite 2</title>

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

        function showAllergieTextBox(){
          if (document.getElementById("andereAllergie").checked) {
            document.getElementById("allergienTxt").style.display = "block";
          }
          else {
            document.getElementById("allergienTxt").style.display = "none";
          }
          return;
        }

        function showPreferences(x){
          if (x == 0) {
            document.getElementById("präferenzenAuswahl").style.display = "none";
          }
          else {
            document.getElementById("präferenzenAuswahl").style.display = "block";
          }
          return;
        }

        function showPreferencesTxtBox(){
          if (document.getElementById("anderePräferenzen").checked) {
            document.getElementById("präferenzenTxt").style.display = "block";
          }
          else {
            document.getElementById("präferenzenTxt").style.display = "none";
          }
          return;
        }

        function isEmpty(dict){
          for (var i in dict){return false}
          return true;
        }

        function saveAllergiesAndPreferences(){
          var keineAllergien = document.getElementById("keineAllergien");
          var allergien = document.getElementById("allergien");
          if (keineAllergien.checked){
            localStorage.setItem("keineAllergien", true);
            localStorage.setItem("allergien", false);
          }
          else if (allergien.checked) {
            localStorage.setItem("keineAllergien", false);
            var allergienDict = {};
            var eierAllergie = document.getElementById("eierAllergie");
            if (eierAllergie.checked) {eierAllergie = true; allergienDict["eier"] = true}else {eierAllergie = false;}
            var glutenAllergie = document.getElementById("glutenAllergie");
            if (glutenAllergie.checked) {glutenAllergie = true; allergienDict["gluten"] = true}else {glutenAllergie = false;}
            var laktoseAllergie = document.getElementById("laktoseAllergie");
            if (laktoseAllergie.checked) {laktoseAllergie = true; allergienDict["laktose"] = true}else {laktoseAllergie = false;}
            var andereAllergie = document.getElementById("andereAllergie");
            if (andereAllergie.checked) {andereAllergie = true;allergienDict["andere"] = document.getElementById("andereAllergie-txt").value}else {andereAllergie = false;}
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
          var keinePräferenzen = document.getElementById("keinePräferenzen");
          var präferenzen = document.getElementById("präferenzen");
          if (keinePräferenzen.checked){
            localStorage.setItem("keinePräferenzen", true);
            localStorage.setItem("präferenzen", false);
          }
          else if (präferenzen.checked) {
            localStorage.setItem("keinePräferenzen", false);
            var präferenzenDict = {};
            var vegan = document.getElementById("vegan");
            if (vegan.checked) {vegan = true; präferenzenDict["vegan"] = true}else {vegan = false;}
            var vegetarisch = document.getElementById("vegetarisch");
            if (vegetarisch.checked) {vegetarisch = true; präferenzenDict["vegetarisch"] = true}else {vegetarisch = false;}
            var keinSchweinefleich = document.getElementById("keinSchweinefleich");
            if (keinSchweinefleich.checked) {keinSchweinefleich = true; präferenzenDict["keinSchweinefleich"] = true}else {keinSchweinefleich = false;}
            var anderePräferenzen = document.getElementById("anderePräferenzen");
            if (anderePräferenzen.checked) {anderePräferenzen = true;präferenzenDict["andere"] = document.getElementById("anderePräferenzen-txt").value}else {anderePräferenzen = false;}
            if (isEmpty(präferenzenDict)) {
              localStorage.setItem("keinePräferenzen", true);
              localStorage.setItem("präferenzen", false);
            }

            localStorage.setItem("präferenzen", JSON.stringify(präferenzenDict));
            /*Zurückkonvertieren:
            var präferenzenDict = JSON.parse(localStorage.getItem("präferenzen"));
            */
          }
          else {
            localStorage.setItem("keinePräferenzen", true);
            localStorage.setItem("präferenzen", false);
          }

          return
        }
        
        </script>

  </head>

  <body>
    <div class="container mt-5">
        <img src="../Images/ATOS_Logo.jpg" class="img-fluid">

        <div class="row g-3">
          <div class="col-md-3">
            <label for="vorname" class="form-label">Vorname</label>
          </div>
          <div class="col-md-3">
            <input type="text" readonly class="form-control-plaintext" id="vorname"> 
          </div>
          <div class="col-md-3">
            <label for="aufnahmedatum" class="form-label">Aufnahmedatum</label>
          </div>
          <div class="col-md-3">
            <input type="text" readonly class="form-control-plaintext" id="aufnahmedatum"> 
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
            <input type="text" readonly class="form-control-plaintext" id="nachname"> 
          </div>
          <div class="col-md-3">
            <label for="entlassungsdatum" class="form-label">Entlassungsdatum</label>
          </div>
          <div class="col-md-3">
            <input type="text" readonly class="form-control-plaintext" id="entlassungsdatum"> 
          </div>
        </div>
        
        <div class="row-g-3">
          <br>
        </div>
        
        <div class="row g-3">
          <div class="col-md-3">
            <label for="zimmernummer" class="form-label">Zimmernummer</label>
          </div>
          <div class="col-md-3">
            <input type="text" readonly class="form-control-plaintext" id="zimmernummer"> 
          </div>

          <script>
          document.getElementById("vorname").value = localStorage.getItem("vorname");
          document.getElementById("nachname").value = localStorage.getItem("nachname");
          document.getElementById("zimmernummer").value = localStorage.getItem("zimmernummer");
          var aufnahmedatum = dateToString(stringToDate(localStorage.getItem("aufnahmedatum")));
          document.getElementById("aufnahmedatum").value = aufnahmedatum;
          var entlassungsdatum = dateToString(stringToDate(localStorage.getItem("entlassungsdatum")));
          document.getElementById("entlassungsdatum").value = entlassungsdatum;
          </script>

          <div class="row-g-3">
            <br>
          </div>


        <h1>Wenn Sie unter Allergien leiden oder Präferenzen in Bezug auf Ihre Mahlzeiten haben, geben Sie diese bitte hier an!</h1>
        <form class="row g-3" action="verpflegung.php?">
          <div class="col-md-6">
            <h3>Allergien</h3>
            <br>
            <div class="form-check">
              <input class="form-check-input" type="radio" value="keine Allergien" name="allergien" id="keineAllergien" onclick="showAllergies(0)" checked>
              <label class="form-check-label" for="keineAllergien">Keine Allergien</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" value="allergien" name="allergien" id="allergien" onclick="showAllergies(1)">
              <label class="form-check-label" for="allergien">Ich habe Lebensmittelallergien</label>
            </div>
            <div class="allergien" id="allergienAuswahl" style="display: none;">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="eierAllergie" id="eierAllergie">
                <label class="form-check-label" for="eierAllergie">Eier Allergie</label>
              </div>  
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="laktoseAllergie" id="laktoseAllergie">
                <label class="form-check-label" for="laktoseAllergie">Laktose Intolleranz</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="glutenAllergie" id="glutenAllergie">
                <label class="form-check-label" for="glutenAllergie">Gluten Allergie</label>
              </div>  
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="andereAllergie"  id="andereAllergie" onchange="showAllergieTextBox()">
                <label class="form-check-label" for="andereAllergie">Andere Allergie</label>
              </div>
              <br>
              <div class="allergien-txt" style="display: none;" id="allergienTxt">
                <div class="form-floating">
                  <textarea class="form-control" placeholder="Andere Allergien" id="andereAllergie-txt" style="height:15vh;"></textarea>
                  <label for="andereAllergie-txt">Hier können Sie Ihre anderen Allergien eintragen</label>
                </div>
              </div>
            </div>
          </div>
          
          <div class="col-md-6">
            <h3>Präferenzen (z.B. Vegetarisch)</h3>
            <br>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="präferenzen" id="keinePräferenzen" onclick="showPreferences(0)" checked>
              <label class="form-check-label" for="keinePräferenzen">Keine Präferenzen</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="präferenzen" id="präferenzen" onclick="showPreferences(1)">
              <label class="form-check-label" for="präferenzen">Ich habe Lebensmittelpräferenzen</label>
            </div>
            <div id="präferenzenAuswahl" class="präferenzenAuswahl" style="display: none;">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="vegan" id="vegan">
                <label class="form-check-label" for="vegan">Vegan</label>
              </div>  
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="vegetarisch" id="vegetarisch">
                <label class="form-check-label" for="vegetarisch">Vegetarisch</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="keinSchweinefleich" id="keinSchweinefleich">
                <label class="form-check-label" for="keinSchweinefleich">Kein Schweinefleich</label>
              </div>  
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="anderePräferenzen" id="anderePräferenzen" onchange="showPreferencesTxtBox()">
                <input type="text" name="tag" value="1" style="display:none;">
                <label class="form-check-label" for="anderePräferenzen">Andere Präferenzen</label>
              </div>
              <br>
              <div class="präferenzen-txt" id="präferenzenTxt" style="display: none;">
                <div class="form-floating">
                  <textarea class="form-control" placeholder="Andere Präferenzen" id="anderePräferenzen-txt" style="height:15vh ;"></textarea>
                  <label for="anderePräferenzen-txt">Hier können Sie Ihre anderen Präferenzen eintragen</label>
                </div>
            </div>
          </div>
        </div>
          
          <div class="col-md-6">
            <a href="index.php"><button type="button" class="btn btn-secondary">Zurück</button></a>
          </div>
          <div class="col-md-6">
            <button type="submit" class="btn btn-primary" onclick="saveAllergiesAndPreferences()">Weiter</button>
          </div>
        </form>
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
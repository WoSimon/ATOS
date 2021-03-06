<?php

  session_start();
  if (isset($_SESSION["login"])){
    if ($_SESSION["login"] == true){
      $vorname = $_SESSION["vorname"];
      $nachname = $_SESSION["nachname"];
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

    <title>ATOS Essenbestellung | Seite 3 </title>

    <script>

      function zeigeFrückstückExtras(tag){
        if (document.getElementById(tag + "-extrasFrüh").checked) {
            document.getElementById(tag + "-extrasFrühTxt").style.display = "block";
          }
          else {
            document.getElementById(tag + "-extrasFrühTxt").style.display = "none";
            document.getElementById(tag + "-extrasFrüh-txt").value = "";
          }
          return;
      }

      function zeigeAbendExtras(tag){
        if (document.getElementById(tag + "-extrasAbend").checked) {
            document.getElementById(tag + "-extrasAbendTxt").style.display = "block";
          }
          else {
            document.getElementById(tag + "-extrasAbendTxt").style.display = "none";
            document.getElementById(tag + "-extrasAbend-txt").value = "";
          }
          return;
      }

      function zeigeMittagExtras(tag){
        if (document.getElementById(tag + "-extrasMittag").checked) {
            document.getElementById(tag + "-extrasMittagTxt").style.display = "block";
          }
          else {
            document.getElementById(tag + "-extrasMittagTxt").style.display = "none";
            document.getElementById(tag + "-extrasMittag-txt").value = "";
          }
          return;
      }

      function zeigeFrühstückAuswahl(tag){
        if (document.getElementById(tag + "-keinFrühstück").checked) {
            document.getElementById(tag + "-frühstückAuswahl").style.display = "none";
            document.getElementById(tag + "-basicFrüh").checked = false;
            document.getElementById(tag + "-basicFrüh").required = false;
            document.getElementById(tag + "-vegetarischFrüh").checked = false;
            document.getElementById(tag + "-fitnessFrüh").checked = false;
            document.getElementById(tag + "-französischFrüh").checked = false;
          }
          else {
            document.getElementById(tag + "-frühstückAuswahl").style.display = "block";
          }
          return;
      }

      function zeigeMittagAuswahl(tag){
        if (document.getElementById(tag + "-keinMittagessen").checked) {
            document.getElementById(tag + "-mittagAuswahl").style.display = "none";
            document.getElementById(tag + "-aktivMittag").checked = false;
            document.getElementById(tag + "-aktivMittag").required = false;
            document.getElementById(tag + "-chefMittag").checked = false;
            document.getElementById(tag + "-köstlichMittag").checked = false;
          }
        else {
          document.getElementById(tag + "-mittagAuswahl").style.display = "block";
        }
        return;
      }

      function zeigeAbendAuswahl(tag){
        if (document.getElementById(tag + "-keinAbendessen").checked) {
            document.getElementById(tag + "-abendAuswahl").style.display = "none";
            document.getElementById(tag + "-basicAbend").checked = false;
            document.getElementById(tag + "-basicAbend").required = false;
            document.getElementById(tag + "-vegetarischAbend").checked = false;
            document.getElementById(tag + "-salatAbend").checked = false;
            document.getElementById(tag + "-salatAuswahl").style.display = "none";
            document.getElementById(tag + "-salatHächen").checked = false;
            document.getElementById(tag + "-salatHächen").required = false;
            document.getElementById(tag + "-salatFeta").checked = false;
            document.getElementById(tag + "-salatThunfisch").checked = false;
            document.getElementById(tag + "-salatGouda").checked = false;
            document.getElementById(tag + "-salatDressing").style.display = "none";
            document.getElementById(tag + "-dressingBalsamico").checked = false;
            document.getElementById(tag + "-dressingBalsamico").required = false;
            document.getElementById(tag + "-dressingJoghurt").checked = false;
            document.getElementById(tag + "-dressingÖl").checked = false;
            document.getElementById(tag + "-wrapAbend").checked = false;
            document.getElementById(tag + "-wrapAuswahl").style.display = "none";
            document.getElementById(tag + "-wrapVegi").checked = false;
            document.getElementById(tag + "-wrapVegi").required = false;
            document.getElementById(tag + "-wrapPute").checked = false;
            document.getElementById(tag + "-capreseAbend").checked = false;
            document.getElementById(tag + "-suppeAbend").checked = false;
          }
          else {
            document.getElementById(tag + "-abendAuswahl").style.display = "block";
          }
          return;
      }

      function zeigeSalatAuswahl(tag){
        if (document.getElementById(tag + "-salatAbend").checked) {
            document.getElementById(tag + "-salatAuswahl").style.display = "block";
            document.getElementById(tag + "-salatDressing").style.display = "block";
            document.getElementById(tag + "-salatHächen").required = true;
            document.getElementById(tag + "-dressingBalsamico").required = true;
          }
          else {
            document.getElementById(tag + "-salatAuswahl").style.display = "none";
            document.getElementById(tag + "-salatHächen").required = false;
            document.getElementById(tag + "-salatHächen").checked = false;
            document.getElementById(tag + "-salatFeta").checked = false;
            document.getElementById(tag + "-salatThunfisch").checked = false;
            document.getElementById(tag + "-salatGouda").checked = false;
            document.getElementById(tag + "-salatDressing").style.display = "none";
            document.getElementById(tag + "-dressingBalsamico").required = false;
            document.getElementById(tag + "-dressingBalsamico").checked = false;
            document.getElementById(tag + "-dressingJoghurt").checked = false;
            document.getElementById(tag + "-dressingÖl").checked = false;
          }
          return;
      }

      function zeigeWrapAuswahl(tag){
        if (document.getElementById(tag + "-wrapAbend").checked) {
            document.getElementById(tag + "-wrapAuswahl").style.display = "block";
            document.getElementById(tag + "-wrapVegi").required = true;
          }
          else {
            document.getElementById(tag + "-wrapAuswahl").style.display = "none";
            document.getElementById(tag + "-wrapVegi").required = false;
            document.getElementById(tag + "-wrapVegi").checked = false;
            document.getElementById(tag + "-wrapPute").checked = false;
          }
          return;
      }

      function zeigeAbendSpezifikationen(tag){
        zeigeSalatAuswahl(tag);
        zeigeWrapAuswahl(tag);
      }


    </script>

  </head>

  <body>

    <?php

        $aufnahmeStr = $_SESSION['aufnahme'];
        $entlassungStr = $_SESSION['entlassung'];

        $aufnahmeDt = date_create($aufnahmeStr);
        $entlassungDt = date_create($entlassungStr);

        $anzahlTage = date_diff($aufnahmeDt, $entlassungDt);
        $anzahlTage = $anzahlTage->format('%a') + 1;

        $arrayDays = array();

        for ($i=0; $i < $anzahlTage; $i++) { 
          $arrayDays[$i] = $aufnahmeDt->format('d.m.Y');
          $aufnahmeDt->modify('+1 day');
        }

        function bestimmeTag($tag){
          $tag1 = date_create("2022-05-02");
          $tag2 = date_create("2022-05-03");
          $tag3 = date_create("2022-05-04");
          $tag4 = date_create("2022-05-05");
          $tag5 = date_create("2022-05-06");
          $tag6 = date_create("2022-05-07");
          $tag7 = date_create("2022-05-08");

          $unixTime = strtotime($tag);
          $dayOfWeek = date("l", $unixTime);

          $tag = date_create($tag);

          $menu = "";

          switch ($dayOfWeek){
            case "Monday":
              //Entweder Tag 1 oder 8
              $diff1 = date_diff($tag, $tag1)->format('%a');
              if (fmod(($diff1 / 14), 1) == 0){
                $menu = "1";
              }
              else {
                $menu = "8";
              } 
              break;
            case "Tuesday":
              //Entweder Tag 2 oder 9
              $diff2 = date_diff($tag, $tag2)->format('%a');
              if (fmod(($diff2 / 14), 1) == 0){
                $menu = "2";
              }
              else {
                $menu = "9";
              }
              break;
            case "Wednesday":
              //Entweder Tag 3 oder 10
              $diff3 = date_diff($tag, $tag3)->format('%a');
              if (fmod(($diff3 / 14), 1) == 0){
                $menu = "3";
              }
              else {
                $menu = "10";
              }
              break;
            case "Thursday":
              //Entweder Tag 4 oder 11
              $diff4 = date_diff($tag, $tag4)->format('%a');
              if (fmod(($diff4 / 14), 1) == 0){
                $menu = "4";
              }
              else {
                $menu = "11";
              }
              break;
            case "Friday":
              //Entweder Tag 5 oder 12
              $diff5 = date_diff($tag, $tag5)->format('%a');
              if (fmod(($diff5 / 14), 1) == 0){
                $menu = "5";
              }
              else {
                $menu = "12";
              }
              break;
            case "Saturday":
              //Entweder Tag 6 oder 13
              $diff6 = date_diff($tag, $tag6)->format('%a');
              if (fmod(($diff6 / 14), 1) == 0){
                $menu = "6";
              }
              else {
                $menu = "13";
              }
              break;
            case "Sunday":
              //Entweder Tag 7 oder 14
              $diff7 = date_diff($tag, $tag7)->format('%a');
              if (fmod(($diff7 / 14), 1) == 0){
                $menu = "7";
              }
              else {
                $menu = "14";
              }
              break;
            };
            return $menu;
      }

    ?>
    
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
            <br>          
            <br>          
            Sollten Sie nicht in der Lage sein, eine Auswahl zu treffen, können wir Ihre Bestellung am Aufnahmetag auch persönlich entgegennehmen.
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

      <form class="row g-3" method="POST" action="abschluss.php">

      <?php
      
        foreach ($arrayDays as $tag){

          $wieVieleTage = (array_search($tag, $arrayDays)) + 1;
          $gesamtTage = count($arrayDays);

          $tagID = $wieVieleTage . ' / ' . $gesamtTage;

          include '../PHP/bestellung.php';
        }
      
      ?>

      </form>

      <br>

      <div class="px-4 py-5 my-5 text-center">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#HilfeModal">
          Ich benötige Hilfe beim Ausfüllen!
        </button>
      </div>

      <!-- Optional JavaScript; choose one of the two! -->
      
      <!-- Option 1: Bootstrap Bundle with Popper -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
      
      <!-- Option 2: Separate Popper and Bootstrap JS -->
      <!--
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
      -->
    </div>
  </body>
</html>
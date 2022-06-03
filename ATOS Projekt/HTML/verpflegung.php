<?php

  session_start();
  
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

    <title>ATOS Essenbestellung | Seite ... </title>

    <script>

      function zeigeFrückstückExtras(){
        if (document.getElementById("extrasFrüh").checked) {
            document.getElementById("optionenExtrasFrüh").style.display = "block";
          }
          else {
            document.getElementById("optionenExtrasFrüh").style.display = "none";
          }
          return;
      }

      function zeigeAbendExtras(){
        if (document.getElementById("extrasAbend").checked) {
            document.getElementById("extrasAbendTxt").style.display = "block";
          }
          else {
            document.getElementById("extrasAbendTxt").style.display = "none";
          }
          return;
      }

      function zeigeSalatAuswahl(){
        if (document.getElementById("salatAbend").checked) {
            document.getElementById("salatAuswahl").style.display = "block";
            document.getElementById("salatHächen").required = true;
          }
          else {
            document.getElementById("salatAuswahl").style.display = "none";
            document.getElementById("salatHächen").required = false;
            document.getElementById("salatHächen").checked = false;
            document.getElementById("salatFeta").checked = false;
            document.getElementById("salatThunfisch").checked = false;
            document.getElementById("salatGouda").checked = false;
          }
          return;
      }

      function zeigeWrapAuswahl(){
        if (document.getElementById("wrapAbend").checked) {
            document.getElementById("wrapAuswahl").style.display = "block";
            document.getElementById("wrapVegi").required = true;
          }
          else {
            document.getElementById("wrapAuswahl").style.display = "none";
            document.getElementById("wrapVegi").required = false;
            document.getElementById("wrapVegi").checked = false;
            document.getElementById("wrapPute").checked = false;
          }
          return;
      }

      function zeigeAbendSpezifikationen(){
        zeigeSalatAuswahl();
        zeigeWrapAuswahl();
      }


    </script>

  </head>

  <body>

    <?php

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
      </div>

      <div class="row-g-3">
        <br>
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

      <?php
      
        foreach ($arrayDays as $tag){

          $wieVieleTage = (array_search($tag, $arrayDays)) + 1;
          $gesamtTage = count($arrayDays);

          $tagID = $wieVieleTage . ' / ' . $gesamtTage;

          include '../PHP/bestellung.php';
        }
      
      ?>

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
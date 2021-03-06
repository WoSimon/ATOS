<?php 

    if (isset($_GET['error'])){
        if ($_GET['error'] == 1){
          echo '<div class="alert alert-danger" role="alert">';
          echo 'Es gab Probleme beim Übermitteln der Logidaten, bitte erneut versuchen!';
          echo '</div>';
        }
        else if ($_GET['error'] == 2){
          echo '<div class="alert alert-danger" role="alert">';
          echo "Das Passwort ist falsch.";
          echo '</div>';
        }
        else if ($_GET['error'] == 3){
          echo '<div class="alert alert-danger" role="alert">';
          echo "Der Nutzer existiert nicht.";
          echo '</div>';
        }
        else if ($_GET['error'] == 4){
          echo '<div class="alert alert-danger" role="alert">';
          echo "Sie müssen sich zuerst einloggen.";
          echo '</div>';
        }
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

    <title>ATOS Login</title>
  </head>

  <body>
    <!-- Modal Hilfe -->
    <div class="modal fade" id="HilfeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Haben Sie Probleme beim Login?</h5>
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
        new google.translate.TranslateElement({pageLanguage: 'de', includedLanguages: 'en,fr,nl,dk,it,ru,tr,de', autodisplay: false, layout: google.translate.TranslateElement.InlineLayout.HORIZONTAL}, 'google_translate_element');
      }
      </script>
      <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
      <div class="px-4 py-5 my-5 text-center">
          <img src="../Images/ATOS_Logo.jpg" class="img-fluid">
          <h1>Bitte geben Sie ihre Login Daten ein</h1>
          <div class="col md-6">
              <div class="col-lg-6 mx-auto">
                  <p class="lead mb-4">Sie haben im Rahmen Ihres Corona Check-in's in unserer Klinik Logindaten erhalten. Bitte geben Sie diese in dem Formular unten ein.</p>
                  <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                      <form class="row" method="POST" action="../PHP/includes/checkLogin.php">
                          <div class="form-floating">
                              <input type="text" class="form-control" id="nutzer" name="nutzer" placeholder="name@example.com" required>
                              <label for="nutzer">Benutzername</label>
                          </div>
                          <div class="row"><br></div>
                          <div class="form-floating">
                              <input type="password" class="form-control" id="passwort" name="passwort" placeholder="Passwort" required>
                              <label for="passwort">Passwort</label>
                          </div>
                          <div class="row"><br></div>
                          <button class="btn btn-lg btn-primary" type="submit">Einloggen</button>
                      </form>
                  </div>
              </div>
            </div>
        </div>
    </div>
    <div class="px-4 py-5 my-5 text-center">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#HilfeModal">
        Ich benötige Hilfe beim Ausfüllen
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
  </body>
</html>
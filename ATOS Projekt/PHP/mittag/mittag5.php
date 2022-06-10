<div class="row g-3" id="<?php echo $tag . '-'?>mittag">
  <h2 style="text-align:center ;">Mittag</h1>
  <div class="col-md-6">
    <h4>Mittagessen bestellen</h4>
    <div class="form-check">
      <input class="form-check-input" type="checkbox" name="<?php echo $tag . '-' ?>vorMittag" id="<?php echo $tag?>-vorMittag" checked>
      <label class="form-check-label" for="vorMittag">Vorspeise</label>
    </div>
    <div class="form-check">
      <input class="form-check-input" value="mittag1" type="radio" name="<?php echo $tag . '-' ?>mittag" id="<?php echo $tag?>-aktivMittag">
      <label class="form-check-label" for="aktivMittag">Aktiv Vegetarisch</label>
    </div>
    <div class="form-check">
      <input class="form-check-input" value="mittag2" type="radio" name="<?php echo $tag . '-' ?>mittag" id="<?php echo $tag?>-chefMittag">
      <label class="form-check-label" for="chefMittag">Der Küchenchef empfiehlt</label>
    </div>
    <div class="form-check">
      <input class="form-check-input" value="mittag3" type="radio" name="<?php echo $tag . '-' ?>mittag" id="<?php echo $tag?>-köstlichMittag">
      <label class="form-check-label" for="köstlichMittag">Köstlich bewährt</label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="checkbox" name="<?php echo $tag . '-' ?>desMittag"  id="<?php echo $tag?>-desMittag" checked>
      <label class="form-check-label" for="desMittag">Dessert</label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="extrasMittag" name="<?php echo $tag . '-'?>extraMittag" id="<?php echo $tag?>-extrasMittag" onchange="zeigeMittagExtras('<?php echo $tag?>')">
      <label class="form-check-label" for="extrasMittag">Extras</label>
    </div>
    <div id="<?php echo $tag?>-extrasMittagTxt" style="display: none;">
      <div class="form-floating">
        <textarea class="form-control" placeholder="Extras beim Mittagessen" name="<?php echo $tag . '-'?>extrasMittagTxt" id="extrasMittag-txt" style="height:15vh;"></textarea>
        <label for="extrasAbend-txt">Anmerkungen für Ihr Mittagessen am <?php echo $tag?></label>
      </div>
    </div>
  </div>

  <div class="col-md-6">
    <h4>Inhalte Mittagessen</h4>
    <div>
      <h6>Vorspeise</h6>
      <i>Spargelcremesuppe</i>
    </div>
    <br>
    <div>
      <h6>Aktiv vegetarisch</h6>
      <i>Lauch-Paprika-Quiche mit Dip</i>
    </div>
    <br>
    <div>
      <h6>Der Küchenchef empfiehlt</h6>
      <i>Saltimbocca vom Kabeljaufilet mit Grilltomate und Fettucine</i>
    </div>
    <br>
    <div>
      <h6>Köstlich bewährt</h6>
      <i>Kalbshüftbraten in Rahmsauce mit Kartoffelgratin und Feldsalat</i>
    </div>
    <br>
    <div>
      <h6>Dessert</h6>
      <i>Joghurt mit Walnüssen und Honig</i>
    </div>
  </div>
</div>

<script>

  var allergienDict = JSON.parse(localStorage.getItem("allergien"));
  var vorspeise = document.getElementById("<?php echo $tag?>-vorMittag");
  var mittag1 = document.getElementById("<?php echo $tag?>-aktivMittag");
  var mittag2 = document.getElementById("<?php echo $tag?>-chefMittag");
  var mittag3 = document.getElementById("<?php echo $tag?>-köstlichMittag");
  var dessert = document.getElementById("<?php echo $tag?>-desMittag");

  var gluten = allergienDict["gluten"];
  var krebstiere = allergienDict["krebstiere"];
  var eier = allergienDict["eier"];
  var fisch = allergienDict["fisch"];
  var erdnüsse = allergienDict["erdnüsse"];
  var soja = allergienDict["soja"];
  var milch = allergienDict["milch"];
  var schalenfrüchte = allergienDict["schalenfrüchte"];
  var sellerie =  allergienDict["sellerie"];
  var senf = allergienDict["senf"];
  var sesam = allergienDict["sesam"];
  var mollusken = allergienDict["mollusken"];

  if (gluten || milch){
    vorspeise.checked = false;
    vorspeise.disabled = true;
  }
  if (gluten || eier || milch) {
    mittag1.disabled = true;
  }
  if (gluten || fisch || milch){
    mittag2.disabled = true;
  }
  if (gluten || milch){
    mittag3.disabled = true;
  }
  if (milch || schalenfrüchte){
    dessert.checked = false;
    dessert.disabled = true;
  }
  if (mittag1.disabled && mittag2.disabled && mittag3.disabled){
    mittag1.required = false;
  }

</script>
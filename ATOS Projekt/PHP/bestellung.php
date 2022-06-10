<?php

    $tagEins = $arrayDays[0];
    $letzterTag = $arrayDays[count($arrayDays) - 1];

?>

<script>

    function versteckeFrühstück(tag) {
        console.log(tag + "-frühstück");
        console.log(document.getElementById("<?php echo $tag?> + -frühstück"));
        document.getElementById(tag + "-frühstück").style.display = "none";
        document.getElementById(tag + "-basicFrüh").required = false;
    }

    function versteckeMittag(tag) {
        document.getElementById(tag + "-mittag").style.display = "none";
        document.getElementById(tag + "-aktivMittag").required = false;
    }

    function versteckeAbend(tag) {
        document.getElementById(tag + "-abend").style.display = "none";
        document.getElementById(tag + "-basicAbend").required = false;
    }

    window.onload = function() {
        var tag1 = document.getElementById("<?php echo $tagEins; ?>");
        tag1.style.display = "block";
    }

    function nächsterTag(tag){
        var leereFelder = formFull(tag);
        if (leereFelder.length == 0) {
            zeigeNächstenTag(tag);
        }
        else{
            var felder = leereFelder.join(", ");
            alert("Bitte: " + felder + " ausfüllen!");
        }
    }

    function formFull(tag){
        var missing = [];

        const frühstück = document.querySelectorAll('input[name="' + tag + '-frühstück"]');
        if (frühstück[0].required){
            for (const früh of frühstück) {
                if (früh.checked) {
                    var isFrühstück = true;
                    break;
                }
                else {
                    var isFrühstück = false;
                }
            }
            if (!isFrühstück) {
                missing.push("Frühstück");
            }
        }
        else {
            var isFrühstück = true;
        }

        const mittagessen = document.querySelectorAll('input[name="' + tag + '-mittag"]');
        if (mittagessen[0].required){
            for (const mittag of mittagessen) {
                if (mittag.checked) {
                    var isMittag = true;
                    break;
                }
                else {
                    var isMittag = false;
                }
            }
            if (!isMittag) {
                missing.push("Mittagessen");
            }
        }
        else {
            var isMittag = true;
        }

        const abendessen = document.querySelectorAll('input[name="' + tag + '-abend"]');
        if (abendessen[0].required){
            for (const abend of abendessen) {
                if (abend.checked) {
                    if (abend.value == "salatAbend"){
                        const salate = document.querySelectorAll('input[name="' + tag + '-salat"]');
                        for (const salat of salate) {
                            if (salat.checked) {
                                var isAbend = true;
                                break;
                            }
                            else {
                                var isAbend = false;
                            }
                        }
                        break;
                    }
                    else if (abend.value == "wrapAbend"){
                        const wraps = document.querySelectorAll('input[name="' + tag + '-wrap"]');
                        for (const wrap of wraps) {
                            if (wrap.checked) {
                                var isAbend = true;
                                break;
                            }
                            else {
                                var isAbend = false;
                            }
                        }
                        break;
                    }
                    else {
                        var isAbend = true;
                        break;
                    }
                }
                else {
                    var isAbend = false;
                }
            }
        }
        else{
            var isAbend = true;
        }
        if (!isAbend) {
            missing.push("Abendessen");
        }

        return missing;
    }

    function zeigeNächstenTag(tag){
        var aktuellerBlock = document.getElementById(tag);
        var dateParts = tag.split(".");
        //console.log(dateParts);
        var tagDate = new Date(dateParts[2], dateParts[1] - 1, dateParts[0]);
        //console.log ("Tag: " + tagDate);

        var nächsterTag = new Date(tagDate.setDate(tagDate.getDate()) + 1 * 24 * 60 * 60 * 1000);
        nächsterTag = dateToString(nächsterTag);

        nächsterBlock = document.getElementById(nächsterTag);

        aktuellerBlock.style.display = "none";
        nächsterBlock.style.display = "block";
    
        return;
    }

    function vorherigerTag(tag){
        var aktuellerBlock = document.getElementById(tag);
        var dateParts = tag.split(".");
        var tagDate = new Date(dateParts[2], dateParts[1] - 1, dateParts[0]);

        var vorherigerTag = new Date(tagDate.setDate(tagDate.getDate()) - 1 * 24 * 60 * 60 * 1000);
        vorherigerTag = dateToString(vorherigerTag);

        vorherigerBlock = document.getElementById(vorherigerTag);

        aktuellerBlock.style.display = "none";
        vorherigerBlock.style.display = "block";
    
        return;
    }
    

</script>

<div id="<?php echo $tag ?>" style="display:none;"> 
    <h1>Hier können Sie Ihre Verpflegung für den <?php echo $tag ?> bestellen</h1>
    <div class="row g-3" id="<?php echo $tag . '-'?>frühstück">
        <h2 style="text-align:center ;">Frühstück</h1>
        <div class="col-md-6">
            <h4>Frühstücksbestellung</h4>
            <div class="form-check">
                <input class="form-check-input" value="Basic Frühstück" type="radio" name="<?php echo $tag . '-'?>frühstück" id="<?php echo $tag . '-'?>basicFrüh" required>
                <label class="form-check-label" for="basicFrüh">Basic</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" value="Vegetarisches Frühstück" type="radio" name="<?php echo $tag . '-'?>frühstück" id="vegetarischFrüh">
                <label class="form-check-label" for="vegetarischFrüh">Vegetarisches Frühstück</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" value="Fitness Frühstück" type="radio" name="<?php echo $tag . '-'?>frühstück" id="fitnessFrüh">
                <label class="form-check-label" for="fitnessFrüh">Fitness Frühstück "Hennes"</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" value="Französisches Frühstück" type="radio" name="<?php echo $tag . '-'?>frühstück" id="französischFrüh">
                <label class="form-check-label" for="französischFrüh">Französiches Frühstück</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="extrasFrüh" name="<?php echo $tag . '-'?>extraFrühstück" id="<?php echo $tag?>-extrasFrüh" onchange="zeigeFrückstückExtras('<?php echo $tag?>')">
                <label class="form-check-label" for="extrasFrüh">Extras</label>
            </div>
            <div id="<?php echo $tag ?>-optionenExtrasFrüh" style="display: none;">
                <div class="form-check offset-sm-1">
                    <input class="form-check-input" type="checkbox" name="<?php echo $tag . '-'?>extraBrötchen" value="extraBrötchen" id="extraBrötchen">
                    <label class="form-check-label" for="extraBrötchen">Extra Brötchen/ Brot</label>
                </div>
                <div class="form-check offset-sm-1">
                    <input class="form-check-input" type="checkbox" name="<?php echo $tag . '-'?>extraPorrigde" value="porridge" id="porridge">
                    <label class="form-check-label" for="porridge">Porridge</label>
                </div>
                <div class="form-check offset-sm-1">
                    <input class="form-check-input" type="checkbox" name="<?php echo $tag . '-'?>extraObst" value="frischesObst" id="frischesObst">
                    <label class="form-check-label" for="frischesObst">Frisches Obst</label>
                </div>
                <div class="form-check offset-sm-1">
                    <input class="form-check-input" type="checkbox" name="<?php echo $tag . '-'?>extraMüsli" value="vollkornmüsli" id="vollkornmüsli">
                    <label class="form-check-label" for="vollkornmüsli">Vollkornmüsli</label>
                </div>
                <div class="form-check offset-sm-1">
                    <input class="form-check-input" type="checkbox" name="<?php echo $tag . '-'?>extraSojaMilch" value="sojamilch" id="sojamilch">
                    <label class="form-check-label" for="sojamilch">Sojamilch/ L-Milch</label>
                </div>
                <div class="form-check offset-sm-1">
                    <input class="form-check-input" type="checkbox" name="<?php echo $tag . '-'?>extraSojaJughurg" value="sojajughurt" id="sojajughurt">
                    <label class="form-check-label" for="sojajughurt">Sojajughurt</label>
                </div>
                <div class="form-check offset-sm-1">
                    <input class="form-check-input" type="checkbox" name="<?php echo $tag . '-'?>extraZwieback" value="zwieback" id="zwieback">
                    <label class="form-check-label" for="zwieback">Zwieback</label>
                </div>
                <div class="form-check offset-sm-1">
                    <input class="form-check-input" type="checkbox" name="<?php echo $tag . '-'?>extraKnäckebrot" value="knäckebrot" id="knäckebrot">
                    <label class="form-check-label" for="knäckebrot">Knäckebrot</label>
                </div>
                <div class="form-check offset-sm-1">
                    <input class="form-check-input" type="checkbox" name="<?php echo $tag . '-'?>extraLightMarmelade" value="lightMarmelade" id="lightMarmelade">
                    <label class="form-check-label" for="lightMarmelade">Light Marmelade</label>
                </div>
                <div class="form-check offset-sm-1">
                    <input class="form-check-input" type="checkbox" name="<?php echo $tag . '-'?>extraNutella" value="nutella" id="nutella">
                    <label class="form-check-label" for="nutella">Nutella</label>
                </div>
                <div class="form-check offset-sm-1">
                    <input class="form-check-input" type="checkbox" name="<?php echo $tag . '-'?>extraHonig" value="honig" id="honig">
                    <label class="form-check-label" for="honig">Honig</label>
                </div> 
            </div>
        </div>
        <div class="col-md-6">
            <h4>Inhalte Frühstück</h4>
            <div>
                <h6>Basic</h6>
                <i>Zwei Brötchen, Butter oder Margarine, Schnittkäse (Auswahl täglich wechselnd), Aufschnitt (Auswahl täglich wechselnd), Konfitüre, Nutella, Honig, Gekochtes Ei oder Rüheei im Wechsel, Frucht- oder Naturjoghurt, Portion Frischkäse, Orangensaft</i>
            </div>
            <br>
            <div>
                <h6>Vegetarisches Frühstück</h6>
                <i>Zwei Brötchen, Butter oder Margarine, Schnittkäse (Auswahl täglich wechselnd), Weichkäseauswahl (Auswahl täglich wechselnd), Portion Frischkäse, Konfitüre, Nutella, Honig, Rohkostauswahl, Orangensaft</i>
            </div>
            <br>
            <div>
                <h6>Fitness Frühstück "Hennes"</h6>
                <i>Ein Mehrkornbrötchen, Zimmermanns Schwarzbrot, Margarine, Schnittkäseauswahl (Auswahl täglich wechselnd), Obstslat, Rohkostauswahl, Quark, Bircher Müsli, Orangensaft</i>
            </div>
            <br>
            <div>
                <h6>Französiches Frühstück</h6>
                <i>Weckchen und Crssaint, Butter oder Margarine, Konfitüre, Nutella, Honig</i>
            </div>
        </div>
    </div>
    <div class="row"><br><br></div>

    <?php

    if ($tag == $tagEins) {
        echo "<script> versteckeFrühstück('" . $tag . "') </script>";
    } 

    ?>
    
    <?php

$menu = bestimmeTag($tag);

    switch ($menu){
        case "1":
            echo "<script>console.log('" . $tag . ' ist ' . $menu . "');</script>";
            include "mittag/mittag1.php";
            break;
        case "2":
            echo "<script>console.log('" . $tag . ' ist ' . $menu . "');</script>";
            include "mittag/mittag2.php";
            break;
        case "3":
            echo "<script>console.log('" . $tag . ' ist ' . $menu . "');</script>";
            include "mittag/mittag3.php";
            break;
        case "4":
            echo "<script>console.log('" . $tag . ' ist ' . $menu . "');</script>";
            include "mittag/mittag4.php";
            break;
        case "5":
            echo "<script>console.log('" . $tag . ' ist ' . $menu . "');</script>";
            include "mittag/mittag5.php";
            break;
        case "6": 
            echo "<script>console.log('" . $tag . ' ist ' . $menu . "');</script>";
            include "mittag/mittag6.php";
            break;
        case "7":
            echo "<script>console.log('" . $tag . ' ist ' . $menu . "');</script>";
            include "mittag/mittag7.php";
            break;
        case "8":
            echo "<script>console.log('" . $tag . ' ist ' . $menu . "');</script>";
            include "mittag/mittag8.php";
            break;
        case "9":
            echo "<script>console.log('" . $tag . ' ist ' . $menu . "');</script>";
            include "mittag/mittag9.php";
            break;
        case "10":
            echo "<script>console.log('" . $tag . ' ist ' . $menu . "');</script>";
            include "mittag/mittag10.php";
            break;
        case "11":
            echo "<script>console.log('" . $tag . ' ist ' . $menu . "');</script>";
            include "mittag/mittag11.php";
            break;
        case "12":
            echo "<script>console.log('" . $tag . ' ist ' . $menu . "');</script>";
            include "mittag/mittag12.php";
            break;
        case "13":
            echo "<script>console.log('" . $tag . ' ist ' . $menu . "');</script>";
            include "mittag/mittag13.php";
            break;
        case "14":
            echo "<script>console.log('" . $tag . ' ist ' . $menu . "');</script>";
            include "mittag/mittag14.php";
            break;
        default:
            echo "<h1>Fehler beim Mittagessen</h1>";
    } 

    ?>

    <div class="row"><br><br></div>

    <div class="row g-3" id="<?php echo $tag . '-'?>abend">
        <h2 style="text-align:center ;">Abendessen</h1>
        <div class="col-md-6">
            <h4>Abendessenbestellung</h4>
                <div class="form-check">
                    <input class="form-check-input" value="Basic Abendessen" type="radio" name="<?php echo $tag . '-'?>abend" onchange="zeigeAbendSpezifikationen('<?php echo $tag?>')" id="<?php echo $tag . '-'?>basicAbend" required>
                    <label class="form-check-label" for="basicAbend">Basic</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" value="Vegetarisches Abendessen" type="radio" name="<?php echo $tag . '-'?>abend" onchange="zeigeAbendSpezifikationen('<?php echo $tag?>')" id="vegetarischAbend">
                    <label class="form-check-label" for="vegetarischAbend">Vegetarisches Abendessen</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" value="salatAbend" type="radio" name="<?php echo $tag . '-'?>abend" onchange="zeigeAbendSpezifikationen('<?php echo $tag?>')" id="<?php echo $tag?>-salatAbend">
                    <label class="form-check-label" for="salatAbend">Salatauswahl</label>
                </div>
                <div id="<?php echo $tag?>-salatAuswahl" style="display:none;">
                    <div class="form-check offset-sm-1">
                        <input class="form-check-input" type="radio" name="<?php echo $tag . '-'?>salat" id="<?php echo $tag?>-salatHächen" value="Salat mit Hächen">
                        <label class="form-check-label" for="salatHächen">Hänchenbrustfilet</label>
                    </div>
                    <div class="form-check offset-sm-1">
                        <input class="form-check-input" type="radio" name="<?php echo $tag . '-'?>salat" id="<?php echo $tag?>-salatFeta" value="Salat mit Feta">
                        <label class="form-check-label" for="salatFeta">Feta</label>
                    </div>
                    <div class="form-check offset-sm-1">
                        <input class="form-check-input" type="radio" name="<?php echo $tag . '-'?>salat" id="<?php echo $tag?>-salatThunfisch" value="Salat mit Thunfisch">
                        <label class="form-check-label" for="salatThunfisch">Thunfisch</label>
                    </div>
                    <div class="form-check offset-sm-1">
                        <input class="form-check-input" type="radio" name="<?php echo $tag . '-'?>salat" id="<?php echo $tag?>-salatGouda" value="Salat mit Gouda">
                        <label class="form-check-label" for="salatGouda">Goudastreifen</label>
                    </div>
                </div>
                <div class="form-check">
                    <input class="form-check-input" value="wrapAbend" type="radio" name="<?php echo $tag . '-'?>abend" onchange="zeigeAbendSpezifikationen('<?php echo $tag?>')" id="<?php echo $tag?>-wrapAbend">
                    <label class="form-check-label" for="wrapAbend">Wrap</label>
                </div>
                <div id="<?php echo $tag?>-wrapAuswahl" style="display:none;">
                    <div class="form-check offset-sm-1">
                        <input class="form-check-input" type="radio" name="<?php echo $tag . '-'?>wrap" id="<?php echo $tag?>-wrapVegi" value="Vegetarischer Wrap">
                        <label class="form-check-label" for="wrapVegi">Vegetsrisch</label>
                    </div>
                    <div class="form-check offset-sm-1">
                        <input class="form-check-input" type="radio" name="<?php echo $tag . '-'?>wrap" id="<?php echo $tag?>-wrapPute" value="Wrap mit Pute">
                        <label class="form-check-label" for="wrapPute">mit Pute</label>
                    </div>
                </div>
                <div class="form-check">
                    <input class="form-check-input" value="Caprese" type="radio" name="<?php echo $tag . '-'?>abend" onchange="zeigeAbendSpezifikationen('<?php echo $tag?>')" id="capreseAbend">
                    <label class="form-check-label" for="capreseAbend">Caprese</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" value="Suppe" type="radio" name="<?php echo $tag . '-'?>abend" onchange="zeigeAbendSpezifikationen('<?php echo $tag?>')" id="suppeAbend">
                    <label class="form-check-label" for="suppeAbend">Suppe</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="extrasAbend" name="<?php echo $tag?>-extrasAbend" id="<?php echo $tag?>-extrasAbend" onchange="zeigeAbendExtras('<?php echo $tag?>')">
                    <label class="form-check-label" for="extrasAbend">Extras</label>
                </div>
                <div id="<?php echo $tag?>-extrasAbendTxt" style="display: none;">
                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Extras beim Abendessen" name="<?php echo $tag . '-'?>extrasAbendTxt" id="extrasAbend-txt" style="height:15vh;"></textarea>
                        <label for="extrasAbend-txt">Anmerkungen für Ihr Abendessen am <?php echo $tag?></label>
                    </div>
                </div>
            </div>
        
    
        <div class="col-md-6">
            <h4>Inhalte Abendessen</h4>
            <div>
                <h6>Basic</h6>
                <i>Ein Brötchen, Brotauswahl, Butter oder Margarine, Schnittkäseauswahl (Auswahl täglich wechselnd), Weichkäseauswahl (Auswahl täglich wechselnd), Aufschnittauswahl (Auswahl täglich wechselnd)</i>
            </div>
            <br>
            <div>
                <h6>Vegetarisches Abendessen</h6>
                <i>Ein Brötchen, Brotauswahl, Butter oder Margarine, Schnittkäseauswahl (Auswahl täglich wechselnd), Weichkäseauswahl (Auswahl täglich wechselnd)</i>
            </div>
            <br>
            <div>
                <h6>Salatauswahl</h6>
                <i>Großer Slatteller mit Ciabatta (Wahlweise mit Hänchenbrustfilet, Feta, Thunfisch, Goudastreifen) <br>Wählen Sie zwischen unserem hausgemachtem Joghurt- oder Balsamicodressing</i>
            </div>
            <br>
            <div>
                <h6>Wrap</h6>
                <i>Zwei reichlich gefüllte Wraps (wahlweise vegetarisch oder mit Pute)</i>
            </div>
            <br>
            <div>
                <h6>Caprese</h6>
                <i>Großer Tomaten-Mozzarella-Teller mit Ciabatta</i>
            </div>
            <br>
            <div>
                <h6>Suppe</h6>
                <i>Große Tomatencremesuppe mit Brötchen</i>
            </div>
        </div>
    </div>

    <?php

        if ($tag == $letzterTag) {
            echo "<script> versteckeMittag('" . $tag . "') </script>";
            echo "<script> versteckeAbend('" . $tag . "') </script>";
        }

    ?>

    <div class="row g-3">
        <br>
        <br>
    </div>


    <div class="row g-3">
        <div class="col-md-4">
            <?php if ($tag == $arrayDays[0]) {echo '<a href="allergien.php">';}?><button class="btn btn-secondary" <?php if (!($tag == $arrayDays[0])){echo 'onclick="vorherigerTag('; echo "'" . $tag; echo "');"; echo '"';}?> type="button">Zurück</button><?php if ($tag == $arrayDays[0]) {echo '</a>';}?>
        </div>
        <div class="col col-lg-2">
            <?php

                echo '<p class="h5">Tag ' . $tagID . '</p>'

            ?>
        </div>
        <div class="col-md-4">
            <button class="btn btn-primary" <?php if (!($tag == $arrayDays[count($arrayDays) - 1])) { echo 'onclick="nächsterTag('; echo "'" . $tag; echo "');"; echo '"'; }?> <?php if (!($tag == $arrayDays[count($arrayDays) - 1])) {echo 'type="button"';} else {echo 'type="submit"';} ?>>Weiter</button>
        </div>
    </div>
 
    <div class="row g-3">
        <br>
        <br>
        <br>
        <br>
    </div>
</div>
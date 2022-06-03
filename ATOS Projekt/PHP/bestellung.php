<?php

    $tagEins = $arrayDays[0];

?>

<script>

    window.onload = function() {
        var tag1 = document.getElementById("<?php echo $tagEins; ?>");
        tag1.style.display = "block";
    }

    /* Code aktuell nicht genutzt, wurde zum Testen der Funktionen geschrieben

    function nächsterTag(tag){
        var dateParts = tag.split(".");
        console.log(dateParts);
        var tagDate = new Date(dateParts[2], dateParts[1] - 1, dateParts[0]);
        console.log ("Tag: " + tagDate);

        var nächsterTag = new Date(tagDate.setDate(tagDate.getDate()) + 1 * 24 * 60 * 60 * 1000);

        nächsterTagDate = tagDate.setDate(tagDate.getDate() + 1);
        nächsterTagStr = dateToString(nächsterTagDate);

        console.log ("Nächster Tag: " + nächsterTag);
        nächsterTag = dateToString(nächsterTag);
        
        aktuellerBlock = document.getElementById(tag);
        nächsterBlock = document.getElementById(nächsterTag);

        aktuellerBlock.style.display = "none";
        nächsterBlock.style.display = "block";

    }*/

    function nächsterTag(tag){
        var alert = document.getElementById(tag);

        if (alert.style.display == "block") {
            alert.style.display = "none";
        }
        else {
            alert.style.display = "block";
        }
        return;
    }
    

</script>

<div id="<?php echo $tag ?>" style="display:none;"> 
    <h1>Hier können Sie Ihre Verpflegung für den <?php echo $tag ?> bestellen</h1>
    <div class="row g-3" id="frühstück">
        <h2 style="text-align:center ;">Frühstück</h1>
        <div class="col-md-6">
            <h4>Frühstücksbestellung</h4>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="<?php echo $tag . '-'?>frühstück" id="basicFrüh" required>
                <label class="form-check-label" for="basicFrüh">Basic</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="<?php echo $tag . '-'?>frühstück" id="vegetarischFrüh">
                <label class="form-check-label" for="vegetarischFrüh">Vegetarisches Frühstück</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="<?php echo $tag . '-'?>frühstück" id="fitnessFrüh">
                <label class="form-check-label" for="fitnessFrüh">Fitness Frühstück "Hennes"</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="<?php echo $tag . '-'?>frühstück" id="französischFrüh">
                <label class="form-check-label" for="französischFrüh">Französiches Frühstück</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="extrasFrüh" id="<?php echo $tag?>-extrasFrüh" onchange="zeigeFrückstückExtras('<?php echo $tag?>')">
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
                <i>Weckchen & Crssaint, Butter oder Margarine, Konfitüre, Nutella, Honig</i>
            </div>
        </div>
    </div>
    <?php

    $menu = bestimmeTag($tag);

    switch ($menu){
        case "1":
            include "mittag1.php";
            break;
        case "2":
            include "mittag2.php";
            break;
        case "3":
            include "mittag3.php";
            break;
        case "4":
            include "mittag4.php";
            break;
        case "5":
            include "mittag5.php";
            break;
        case "6": 
            include "mittag6.php";
            break;
        case "7":
            include "mittag7.php";
            break;
        case "8":
            include "mittag8.php";
            break;
        case "9":
            include "mittag9.php";
            break;
        case "10":
            include "mittag10.php";
            break;
        case "11":
            include "mittag11.php";
            break;
        case "12":
            include "mittag12.php";
            break;
        case "13":
            include "mittag13.php";
            break;
        case "14":
            include "mittag14.php";
            break;
        default:
            echo "<h1>Fehler beim Mittagessen</h1>";
    } 

    ?>

    <div class="row g-3" id="abend">
        <h2 style="text-align:center ;">Abendessen</h1>
        <div class="col-md-6">
            <h4>Abendessenbestellung</h4>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="<?php echo $tag . '-'?>abend" onchange="zeigeAbendSpezifikationen('<?php echo $tag?>')" id="basicAbend" required>
                    <label class="form-check-label" for="basicAbend">Basic</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="<?php echo $tag . '-'?>abend" onchange="zeigeAbendSpezifikationen('<?php echo $tag?>')" id="vegetarischAbend">
                    <label class="form-check-label" for="vegetarischAbend">Vegetarisches Abendessen</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="<?php echo $tag . '-'?>abend" onchange="zeigeAbendSpezifikationen('<?php echo $tag?>')" id="<?php echo $tag?>-salatAbend">
                    <label class="form-check-label" for="salatAbend">Salatauswahl</label>
                </div>
                <div id="<?php echo $tag?>-salatAuswahl" style="display:none;">
                    <div class="form-check offset-sm-1">
                        <input class="form-check-input" type="radio" name="<?php echo $tag . '-'?>salat" id="<?php echo $tag?>-salatHächen" value="salatHächen">
                        <label class="form-check-label" for="salatHächen">Hänchenbrustfilet</label>
                    </div>
                    <div class="form-check offset-sm-1">
                        <input class="form-check-input" type="radio" name="<?php echo $tag . '-'?>salat" id="<?php echo $tag?>-salatFeta" value="salatFeta">
                        <label class="form-check-label" for="salatFeta">Feta</label>
                    </div>
                    <div class="form-check offset-sm-1">
                        <input class="form-check-input" type="radio" name="<?php echo $tag . '-'?>salat" id="<?php echo $tag?>-salatThunfisch" value="salatThunfisch">
                        <label class="form-check-label" for="salatThunfisch">Thunfisch</label>
                    </div>
                    <div class="form-check offset-sm-1">
                        <input class="form-check-input" type="radio" name="<?php echo $tag . '-'?>salat" id="<?php echo $tag?>-salatGouda" value="salatGouda">
                        <label class="form-check-label" for="salatGouda">Goudastreifen</label>
                    </div>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="<?php echo $tag . '-'?>abend" onchange="zeigeAbendSpezifikationen('<?php echo $tag?>')" id="<?php echo $tag?>-wrapAbend">
                    <label class="form-check-label" for="wrapAbend">Wrap</label>
                </div>
                <div id="<?php echo $tag?>-wrapAuswahl" style="display:none;">
                    <div class="form-check offset-sm-1">
                        <input class="form-check-input" type="radio" name="<?php echo $tag . '-'?>wrap" id="<?php echo $tag?>-wrapVegi" value="wrapVegi">
                        <label class="form-check-label" for="wrapVegi">Vegetsrisch</label>
                    </div>
                    <div class="form-check offset-sm-1">
                        <input class="form-check-input" type="radio" name="<?php echo $tag . '-'?>wrap" id="<?php echo $tag?>-wrapPute" value="wrapPute">
                        <label class="form-check-label" for="wrapPute">mit Pute</label>
                    </div>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="<?php echo $tag . '-'?>abend" onchange="zeigeAbendSpezifikationen('<?php echo $tag?>')" id="capreseAbend">
                    <label class="form-check-label" for="capreseAbend">Caprese</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="<?php echo $tag . '-'?>abend" onchange="zeigeAbendSpezifikationen('<?php echo $tag?>')" id="suppeAbend">
                    <label class="form-check-label" for="suppeAbend">Suppe</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="extrasAbend" id="<?php echo $tag?>-extrasAbend" onchange="zeigeAbendExtras('<?php echo $tag?>')">
                    <label class="form-check-label" for="extrasAbend">Extras</label>
                </div>
                <div id="<?php echo $tag?>-extrasAbendTxt" style="display: none;">
                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Extras beim Abendessen" name="<?php echo $tag . '-'?>extrasAbend" id="extrasAbend-txt" style="height:15vh;"></textarea>
                        <label for="extrasAbend-txt">Hier können Sie Anmerkungen für Ihr Abendessen am <?php echo $tag?> eintragen</label>
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
                <i>Großer Timaten-Mozzarella-Teller mit Ciabatta</i>
            </div>
            <br>
            <div>
                <h6>Suppe</h6>
                <i>Große Tomatencremesuppe mit Brötchen</i>
            </div>
        </div>
    </div>

    <div class="row g-3">
        <br>
    </div>

    <!--<div class="col-md-4">
        <a href="allergien.php"><button type="button" class="btn btn-secondary">Zurück</button></a>
    </div>-->
    <div class="row justify-content-md-center">
        <div class="col col-lg-2">
            <?php

                echo '<p class="h5">Tag ' . $tagID . '</p>'

            ?>
        </div>
    </div>
    <!--<div class="col-md-4">
        <button class="btn btn-primary" onclick="nächsterTag('<?php echo $tag?>');" type="submit">Weiter</button>
    </div>-->

    
    <div class="row g-3">
        <br>
        <br>
        <br>
    </div>
</div>

<div class="row justify-content-md-center">
    <div class="col col-lg-2">
        <button class="btn btn-dark col-auto" onclick="nächsterTag('<?php echo $tag?>');">Lade <?php echo $tag?></button>
    </div>
</div>

<div class="row g-3">
    <br>
</div>
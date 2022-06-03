<div class="row g-3" id="mittag">
            <h2 style="text-align:center ;">Mittag</h1>
            <div class="col-md-6">
              <h4>Mittagessen bestellen</h4>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="<?php echo $tag . '-' ?>vorMittag" value="vorMittag" id="vorMittag" checked>
              <label class="form-check-label" for="vorMittag">Vorspeise</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="<?php echo $tag . '-' ?>mittag" id="aktivMittag">
              <label class="form-check-label" for="aktivMittag">Aktiv Vegetarisch</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="<?php echo $tag . '-' ?>mittag" id="chefMittag">
              <label class="form-check-label" for="chefMittag">Der Küchenchef empfiehlt</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="<?php echo $tag . '-' ?>mittag" id="köstlichMittag">
              <label class="form-check-label" for="köstlichMittag">Köstlich bewährt</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="<?php echo $tag . '-' ?>desMittag" value="desMittag" id="desMittag" checked>
              <label class="form-check-label" for="desMittag">Dessert</label>
            </div>
          </div>
          
          <div class="col-md-6">
            <h4>Inhalte Mittagessen</h4>
            <div>
              <h6>Vorspeise</h6>
              <i>Gemsbrühe mit Einlage</i>
            </div>
            <br>
            <div>
              <h6>Aktiv vegetarisch</h6>
              <i>Blätterteig-Pastete gefüllt mit Gemüseragout</i>
            </div>
            <br>
            <div>
              <h6>Der Küchenchef empfiehlt</h6>
              <i>Putensteak an Pfeffersauce mit Brokkoli und Kroketten</i>
            </div>
            <br>
            <div>
              <h6>Köstlich bewährt</h6>
              <i>Bœuf Stroganoff mit Butterspätzle</i>
            </div>
            <div>
              <h6>Dessert</h6>
              <i>Eierlikör-Parfait</i>
            </div>
          </div>
        </div>
<?php
//Fonction affichage slider 
function Slider()
{ ?>
  <form action="ventes.php" method="post" enctype="multipart/form-data">
    <div class="filtre p-1" id="sliderChange">
      <div class="ventes_slider_conteneur p-1">
        <h4>Kilométrage</h4>
        <div id="slider-snapTwo" class="ventes_slider"></div>
        <div class="ventes_slider_text">
          <div id="slider-snap-value-lowerTwo">Km</div>
          <div id="slider-snap-value-upperTwo">Km</div>
          <input type="hidden" name="slider_km_min" id="slider_km_min" value="">
          <input type="hidden" name="slider_km_max" id="slider_km_max" value="">
        </div>
        <button type="button" id="reset_km" class="ventes_bouton btn btn-primary"> Réinitialiser</button>
      </div>
      <div class="ventes_slider_conteneur p-1">
        <h4>Prix</h4>
        <div id="slider-snap" class="ventes_slider"></div>
        <div class="ventes_slider_text">
          <div id="slider-snap-value-lower">€</div>
          <div id="slider-snap-value-upper">€</div>
          <input type="hidden" name="slider_prix_min" id="slider_prix_min" value="">
          <input type="hidden" name="slider_prix_max" id="slider_prix_max" value="">
        </div>
        <button type="button" id="reset_prix" class="ventes_bouton btn btn-primary"> Réinitialiser</button>
      </div>
      <div class="ventes_slider_conteneur p-1">
        <h4>Années</h4>
        <div id="slider-snapTrois" class="ventes_slider"></div>
        <div class="ventes_slider_text">
          <div id="slider-snap-value-lowerTrois">a</div>
          <div id="slider-snap-value-upperTrois">a</div>
          <input type="hidden" name="slider_annee_min" id="slider_annee_min" value="">
          <input type="hidden" name="slider_annee_max" id="slider_annee_max" value="">
        </div>
        <button type="button" id="reset_annee" class="ventes_bouton btn btn-primary"> Réinitialiser</button>
      </div>
    </div>
  </form>
<?php
}

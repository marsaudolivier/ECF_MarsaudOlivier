<?php
require_once("./templates/header.php");
?>
<!--Intégration de la Fil ariane-->
<a href="index.php" class="text-success p-2">Acceuil</a>
<a href="ventes.php" class="text-success p-2">/Ventes</a>
<!--Ajout titre de la page-->
<h2>Voiture d’occasion</h2>
<div class="filtre p-1">
      <div class="ventes_slider_conteneur p-1">
    <h4>Kilométrage</h4>
    <div id="slider-snapTwo" class="ventes_slider"></div>
    <div class="ventes_slider_text">
      <div id="slider-snap-value-lowerTwo">Km</div>
      <div id="slider-snap-value-upperTwo">Km</div>
    </div>
    <button type="button" id="reset_km" class="ventes_bouton btn btn-primary"> Réinitialiser</button>
  </div>
  <div class="ventes_slider_conteneur p-1">
    <h4>Prix</h4>
    <div id="slider-snap" class="ventes_slider"></div>
    <div class="ventes_slider_text">
      <div id="slider-snap-value-lower">€</div>
      <div id="slider-snap-value-upper">€</div>
    </div>
    <button type="button" id="reset_prix" class="ventes_bouton btn btn-primary"> Réinitialiser</button>
  </div>

  <div class="ventes_slider_conteneur p-1">
    <h4>Années</h4>
    <div id="slider-snapTrois" class="ventes_slider"></div>
    <div class="ventes_slider_text">
      <div id="slider-snap-value-lowerTrois">a</div>
      <div id="slider-snap-value-upperTrois">Km</div>
    </div>
    <button type="button" id="reset_annee" class="ventes_bouton btn btn-primary"> Réinitialiser</button>
  </div>
  </div>
  <div class="align-items-center p-2">
    <button type="button" id="recherche" class="ventes_bouton_recherche btn btn-danger"> Rechercher</button>
</div>


<?php
require_once("./templates/footer.php");
?>
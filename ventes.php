<?php
require_once("./templates/header.php");
require_once("./templates/slider.php");
require_once("./lib/annonces.php");
require_once("./templates/card_vehicule.php");
?>
<!--Intégration de la Fil ariane-->
<a href="index.php" class="text-success p-2">Acceuil</a>
<a href="ventes.php" class="text-success p-2">/Ventes</a>
<!--Ajout titre de la page-->
<h2>Voiture d’occasion</h2>
<?php
// Intégration du slider
Slider();
?>
 <div class="album py-5">
        <div class="container" >
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3"id="annoncesContainer" >
        </div>
    </div>
</div>
<?php







require_once("./templates/footer.php");
?>
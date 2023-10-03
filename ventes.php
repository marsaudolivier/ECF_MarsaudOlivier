<?php
require_once("./templates/header.php");
require_once("./templates/slider.php");
require_once("./lib/annonces.php");
require_once("./templates/card_vehicule.php");
require_once("./templates/contacts.php");
//Vérification si le formulaire contact bien transmit avec un message pour utilisateur intéractif
if (isset($_GET['success']) && $_GET['success'] == 1) {
    echo '<script>alert("Formulaire transmis avec succès. Notre équipe reviendra vers vous prochainement");</script>';
}
?>
<!--Intégration de la Fil ariane-->
<a href="index.php" class="text-success p-2">Accueil</a>
<a href="ventes.php" class="text-success p-2">/Ventes</a>
<!--Ajout titre de la page-->
<h2>Voiture d’occasion</h2>
<div class="album py-5" id="annoncesDetailContainer">
    <?php
    // Intégration du slider
    Slider();
    ?>
    <div class="container">
        <div class="row row-cols-1  row-cols-md-2 row-cols-lg-3 g-3" id="annoncesContainer">
        </div>
    </div>
    <div id="pagination-container" class="d-flex justify-content-center mt-4">
  <button class="btn pagination-button btn-success" id="prev-button">Précédent</button>
  <p class="p-5">Choix de Page</p>
  <button class="btn pagination-button btn-primary" id="next-button">Suivant</button>
</div>
</div>
<?php
require_once("./templates/Footer.php");
?>

<?php
require_once("./templates/header.php");
require_once("./lib/annonces.php");
require_once("./templates/card_vehicule.php");
?>
<!--Intégration de la Fil ariane-->
<a href="index.php" class="text-success p-2">Acceuil</a>
<a href="admin.php" class="text-success p-2">Espace Administration</a>
<a href="adminVoitures.php" class="text-success p-2">Gestion des ventes vehicules</a>

<?php
  if (isset($_POST["deleteAnnonceButton"])) {
    $Id_Annonces = $_POST['Id_Annonces']; 
    Annonces::DeleteAnnonce($pdo, $Id_Annonces);
    header("Location: adminVoitures.php");
    exit;
  }
// On récupère toutes les annonces
$Annonces = Annonces::GetAnnonces($pdo); ?>
<!-- On affiche les annonces -->
<h2>Liste des véhicules</h2>
<div class="album py-5">
    <div class="container ">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            <?php
            foreach ($Annonces as $voiture) {
                Card($voiture);
            }
?>
</div>
</div>
</div>
<?php
require_once("./templates/header.php");
require_once("./lib/annonces.php");
require_once("./templates/card_vehicule.php");
require_once("./lib/options.php");
error_reporting(E_ALL);
ini_set('display_errors', 1);
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
if (isset($_POST["modifieAnnonceButton"])) {
    $Id_Annonces = $_POST['Id_Annonces'];
    $voiture = Annonces::GetAnnonce($pdo, $Id_Annonces);
    CardEdit($voiture, $pdo);
    }
    if (isset($_POST["modifierVoiture"])) {
        $Id_Annonces = $_POST['Id_Annonces'];
        $titre = $_POST['titre'];
        $annee = $_POST['annee'];
        $kilometrage = $_POST['kilometrage'];
        $prix = $_POST['prix'];
        $photo_principal = $_POST['photo_principal'];
        $Id_Voitures = $_POST['Id_Voitures'];
        $Id_Marques = $_POST['Id_Marques'];
        $date_publication = $_POST['date_publication'];
        Annonces::UpdateAnnonce($pdo, $titre, $date_publication, $Id_Annonces, $Id_Voitures);
        Voitures::UpdateVehicule($pdo, $kilometrage, $annee, $prix,  $photo_principal, $Id_Voitures, $Id_Marques);
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
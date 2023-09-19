<?php
require_once("./templates/header.php");
require_once("./lib/annonces.php");
require_once("./templates/card_vehicule.php");
require_once("./lib/options.php");
require_once("./lib/energies.php");
require_once("./lib/tools.php");
require_once("./lib/utilisateurs.php");

if (!empty($_COOKIE)) {
    $mail = $_COOKIE['mail'];
    $token = $_COOKIE['token'];
    $user = utilisateurs::UtilisateurVerificationToken($pdo, $mail, $token);
?>
    <!--Intégration de la Fil ariane-->
    <a href="index.php" class="text-success p-2">Acceuil</a>
    <a href="admin.php" class="text-success p-2">Espace Administration</a>
    <a href="adminVoitures.php" class="text-success p-2">Gestion des ventes vehicules</a>

    <?php
    if (isset($_POST["deleteAnnonceButton"])) {
        $Id_Annonces = $_POST['Id_Annonces'];
        $Id_Voitures = $_POST['Id_Voitures'];
        // Récupérer les informations de la voiture, y compris le chemin de la photo principale
        $voiture = Voitures::GetVoiture($pdo, $Id_Voitures);
        // Extraire le chemin de la photo principale du tableau
        $chemin_photo_principal = $voiture['photo_principal'];
        // Supprimer toutes les relations avec l'annonce et la voiture
        avoir::DeleteAllForCar($pdo, $Id_Voitures);
        consommer::DeleteAllForCar($pdo, $Id_Voitures);
        // Supprimer l'annonce
        Annonces::DeleteAnnonce($pdo, $Id_Annonces);
        $photos_secondaires = Photos::GetPhotosByVoitures($pdo, $Id_Voitures);
        foreach ($photos_secondaires as $photo) {
            $chemin_photo_secondaire = $photo['photo_secondaire'];
            if (!empty($chemin_photo_secondaire) && file_exists($chemin_photo_secondaire)) {
                unlink($chemin_photo_secondaire); // Supprimer le fichier
            }
        }
        // Supprimer toutes les photos secondaires de la voiture
        Photos::DeletePhotoByVoiture($pdo, $Id_Voitures);
        // Supprimer la voiture
        Voitures::DeleteVoiture($pdo, $Id_Voitures);
        // Supprimer le fichier photo principal s'il existe
        if (!empty($chemin_photo_principal) && file_exists($chemin_photo_principal)) {
            unlink($chemin_photo_principal); // Supprimer le fichier
        }
    }
    if (isset($_POST["modifieAnnonceButton"])) {
        $Id_Annonces = $_POST['Id_Annoncess'];
        $voiture = Annonces::GetAnnonce($pdo, $Id_Annonces);
        CardEdit($voiture, $pdo);
    }
    if (isset($_POST['ajouterVoiture'])) {
        $annee = $_POST['annee'];
        $kilometrage = $_POST['kilometrage'];
        $prix = $_POST['prix'];
        $photo_principale = $_FILES['photo_principal'];
        $dossier_cible = './uploads/voitures/';
        if ($photo_principale['error'] === 0) {
            $nom_fichier = $photo_principale['name'];
            $nom_fichier_unique = uniqid() . '-' . slugify($nom_fichier);
            $chemin_cible = $dossier_cible . $nom_fichier_unique;
            if (move_uploaded_file($photo_principale['tmp_name'], $chemin_cible)) {
            } else {
                echo "Erreur lors du téléchargement du fichier.";
            }
        } else {
            echo "Erreur lors du téléchargement du fichier.";
        }
        $photo_principal = $chemin_cible;
        $Id_Modeles = $_POST['modele'];
        $Id_Marques = $_POST['marque'];
        Voitures::CreateVoiture($pdo, $kilometrage, $annee, $prix, $photo_principal, $Id_Marques, $Id_Modeles);
        $Id_Voitures = $pdo->lastInsertId();
        $titre = $_POST['titre'];
        $date_publication = date('Y-m-d');
        Annonces::CreateAnnonce($pdo, $titre, $date_publication, $Id_Voitures);
        $selectedEnergies = $_POST['energie'];
        // Parcourez les valeurs cochées et insérez-les dans la table consommer
        foreach ($selectedEnergies as $Id_Energies) {
            consommer::CreateConsommer($pdo, $Id_Energies, $Id_Voitures);
        }
        $selectedOptions = $_POST['options'];
        // Parcourez les valeurs cochées et insérez-les dans la table avoir
        foreach ($selectedOptions as $Id_Options) {
            avoir::AddOption($pdo, $Id_Options, $Id_Voitures);
        }
        $photo_secondaire = $_FILES['photo_secondaire'];
        $photos_secondaires_uploadées = array(); // Tableau pour stocker les chemins des photos secondaires

        if (!empty($photo_secondaire['name'][0])) { // Vérifiez si des fichiers ont été téléchargés
            foreach ($photo_secondaire['name'] as $key => $nom_fichier) {
                if ($photo_secondaire['error'][$key] === 0) {
                    $dossier_cibles = './uploads/voitures/';
                    $nom_fichier_unique = uniqid() . '-' . slugify($nom_fichier);
                    $chemin_cibles = $dossier_cibles . $nom_fichier_unique;
                    if (move_uploaded_file($photo_secondaire['tmp_name'][$key], $chemin_cibles)) {
                        $photos_secondaires_uploadées[] = $chemin_cibles;
                    } else {
                        echo "Erreur lors du téléchargement du fichier $nom_fichier.";
                    }
                } else {
                    echo "Erreur lors du téléchargement du fichier $nom_fichier.";
                }
            }
        }

        //nsére toutes les photos secondaires dans la base de données
        foreach ($photos_secondaires_uploadées as $photo_secondaire) {
            Photos::CreatePhoto($pdo, $photo_secondaire, $Id_Voitures);
        }
    };
    if (isset($_POST["modifierVoiture"])) {
        var_dump($_POST);
        $Id_Annonces = $_POST['Id_Annonces'];
        $titre = $_POST['titre'];
        $annee = $_POST['annee'];
        $kilometrage = $_POST['kilometrage'];
        $prix = $_POST['prix'];
        $photo_principal = $_POST['photo_principal'];
        $Id_Voitures = $_POST['Id_Voitures'];
        $Id_Marques = $_POST['Id_Marques'];
        $date_publication = $_POST['date_publication'];
        $modele = $_POST['modele'];
        Annonces::UpdateAnnonce($pdo, $titre, $date_publication, $Id_Annonces, $Id_Voitures);
        Voitures::UpdateVoiture($pdo, $kilometrage, $annee, $prix, $photo_principal, $Id_Voitures, $Id_Marques, $modele);
        $selectedOptions = $_POST['options'];
        consommer::DeleteAllForCar($pdo, $Id_Voitures);
        foreach ($selectedOptions as $Id_Energies) {
            consommer::CreateConsommer($pdo, $Id_Energies, $Id_Voitures);
        }
        $selectedOptionns = $_POST['optionss'];
        avoir::DeleteAllForCar($pdo, $Id_Voitures);
        foreach ($selectedOptionns as $Id_Options) {
            avoir::AddOption($pdo, $Id_Options, $Id_Voitures);
        }
    }
    if (isset($_POST["CreateVehicule"])) {
        Newcard($pdo);
    }
    recupAnonce($pdo);
} else { ?>
    <div class="p-4">
        <h2>Vous n'avez pas accès à cette page</h2>
    </div>
<?php };
require_once("./templates/Footer.php");

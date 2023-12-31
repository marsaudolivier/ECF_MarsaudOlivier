<?php
require_once("./templates/header.php");
require_once("./lib/utilisateurs.php");
// Vérification des cookie de connexion
if (!empty($_COOKIE)) {
    $mail = $_COOKIE['mail'];
    $token = $_COOKIE['token'];
    $user = utilisateurs::UtilisateurVerificationToken($pdo, $mail, $token);
?>
    <!--Intégration de la Fil ariane-->
    <a href="index.php" class="text-success p-2">Accueil</a>
    <a href="admin.php" class="text-success p-2">Espace Administration</a>
    <a href="adminAvis.php" class="text-success p-2">Gestion des Avis client</a>
    <div class="p-4">
        <h2>Valider les Avis</h2>
    </div>
<?php
    require_once("./lib/pdo.php");
    require_once("./lib/avis.php");
    require_once("./templates/page_avis.php");
    AvisAdmin($pdo);
} else { ?>
    <div class="p-4">
        <h2>Vous n'avez pas accès à cette page</h2>
    </div>
<?php };
?>
<?php
require_once("./templates/Footer.php");
?>
<?php
require_once("./templates/header.php");
require_once("./templates/Service.php");
require_once("./lib/utilisateurs.php");
// Vérification des cookie de connexion
if (!empty($_COOKIE)) {
    $mail = $_COOKIE['mail'];
    $token = $_COOKIE['token'];
    $user = utilisateurs::UtilisateurVerificationToken($pdo, $mail, $token);
?>
    <!--Intégration de la Fil ariane-->
    <a href="index.php" class="text-success p-2">Acceuil</a>
    <a href="admin.php" class="text-success p-2">Espace Administration</a>
    <a href="adminServices.php" class="text-success p-2">Gestion des Services</a>
    <div class="p-4">
        <h2>Modifier les services</h2>
    </div>
    <?php
    ServicesAdmin($pdo)
    ?>
<?php } else { ?>
    <div class="p-4">
        <h2>Vous n'avez pas accès à cette page</h2>
    </div>
<?php };
require_once("./templates/Footer.php");
?>
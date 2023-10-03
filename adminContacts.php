<?php
require_once("./templates/header.php");
require_once("./templates/contacts.php");
require_once("./lib/utilisateurs.php");
// Vérification des cookie de connexion
if (!empty($_COOKIE)) {
    $mail = $_COOKIE['mail'];
    $token = $_COOKIE['token'];
    $user = utilisateurs::UtilisateurVerificationToken($pdo, $mail, $token);
    if (!empty($user['Id_Roles'])) {
?>
        <!--Intégration de la Fil ariane-->
        <a href="index.php" class="text-success p-2">Accueil</a>
        <a href="admin.php" class="text-success p-2">Espace Administration</a>
        <a href="adminContacts.php" class="text-success p-2">Gestion des Services</a>
        <div class="p-4">
            <h2>Voir les formulaire de contact</h2>
        </div>
        <?php
        VoirContact($pdo)
        ?>
    <?php }
} else { ?>
    <div class="p-4">
        <h2>Vous n'avez pas accès à cette page</h2>
    </div>
<?php };
require_once("./templates/Footer.php");
?>
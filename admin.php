<?php
require_once("./templates/header.php");
require_once("./lib/utilisateurs.php");
require_once("./lib/contact.php");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if (!empty($_COOKIE)) {
    $mail = $_COOKIE['mail'];
    $token = $_COOKIE['token'];
    $user = utilisateurs::UtilisateurVerificationToken($pdo, $mail, $token);
    $countNonTraitedForms = Contact::CountNonTraitedForms($pdo);
    ?>
<form method="post" action="admin.php">
    <input type="submit" name="logoutButton" class="btn btn-danger position-absolute top-0 end-0" value="Déconnexion">
</form>
    <?php
if (isset($_POST['logoutButton'])) {
    // Supprimer les cookies
    setcookie('token', '', time() - 3600);
    setcookie('mail', '', time() - 3600);
    header('Location: index.php');
    exit();
}
?>

    <!--Intégration de la Fil ariane-->
    <a href="index.php" class="text-success p-2">Acceuil</a>
    <a href="admin.php" class="text-success p-2">Espace Administration</a>
    <!--Ajout titre de la page-->
    <h2>Bonjour MR <?= $user['nom'] ?></h2>
    <!--Ajout panel admin-->
    <Div class="admin_conteneur p-2">
        <?php
        if ($user['Id_Roles'] === 1) { ?>
            <a href="adminUtilisateurs.php" class="text-success p-2">
                <h3>Administration du personnel</h3>
            </a>
            <a href="adminHoraires.php" class="text-success p-2">
                <h3>Administration des horaires</h3>
            </a>
            <a href="adminServices.php" class="text-success p-2">
                <h3>Administration des Services </span></h3>
            </a>
        <?php };
        if ($countNonTraitedForms > 1) { ?>
            <a href="adminContacts.php" class="text-success p-2">
                <h3>Administratrion Contact <span class="badge badge-secondary">Nouveaux messages: <?= $countNonTraitedForms ?></span></h3>
            </a>
        <?php }
        if ($countNonTraitedForms === 1) { ?>
            <a href="adminContacts.php" class="text-success p-2">
                <h3>Administratrion Contact <span class="badge badge-secondary">Nouveau message: <?= $countNonTraitedForms ?></span></h3>
            </a>
        <?php }
        if ($countNonTraitedForms === 0) { ?>
            <a href="adminContacts.php" class="text-success p-2">
                <h3>Administratrion Contact</span></h3>
            </a>
        <?php } ?>
        </a>
        <a href="adminAvis.php" class="text-success p-2">
            <h3>Administration des Avis</h3>
        </a>
        <a href="adminVoitures.php" class="text-success p-2">
            <h3>Administration des ventes vehicules</h3>
        </a>
    </Div>
<?php } else { ?>
    <div class="p-4">
        <h2>Vous n'avez pas accès à cette page</h2>
    </div>
<?php };
require_once("./templates/Footer.php");
?>
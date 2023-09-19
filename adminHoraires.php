<?php
require_once("./templates/header.php");
require_once("./lib/horaires.php");
require_once("./lib/utilisateurs.php");
if(!empty($_COOKIE)){
    $mail = $_COOKIE['mail'];
    $token = $_COOKIE['token'];
    $user = utilisateurs::UtilisateurVerificationToken($pdo, $mail, $token);
?>
<!--Intégration de la Fil ariane-->
<a href="index.php" class="text-success p-2">Acceuil</a>
<a href="admin.php" class="text-success p-2">Espace Administration</a>
<a href="adminHoraires.php" class="text-success p-2">Gestion Horaires</a>
<div class="p-2 admin_conteneur" id="Horaires">
    <div class="p-2">
        <h2>Modifier horaire par rapport au jours</h2>
        <?php
        HorairesAdmin($pdo);
        ?>
    </div>
</div>
<?php }else { ?>
    <div class="p-4">
        <h2>Vous n'avez pas accès à cette page</h2>
    </div>
<?php };
require_once("./templates/footer.php");
?>
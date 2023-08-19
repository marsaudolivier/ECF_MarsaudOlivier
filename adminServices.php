<?php
require_once("./templates/header.php");
require_once("./lib/utilisateurs.php");
require_once("./lib/Services.php");
?>
<!--Intégration de la Fil ariane-->
<a href="index.php" class="text-success p-2">Acceuil</a>
<a href="admin.php" class="text-success p-2">Espace Administration</a>
<a href="adminServices.php" class="text-success p-2">Gestion des Services</a>
<div class="p-2 admin_conteneur" id="Services">
    <div class="p-2">
        <h2>Modifier les services</h2>
        <?php
        ServicesAdmin($pdo);
        ?>
    </div>
</div>
<?php
require_once("./templates/footer.php");
?>
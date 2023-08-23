<?php
require_once("./templates/header.php");
require_once("./templates/contacts.php");
?>
<!--Intégration de la Fil ariane-->
<a href="index.php" class="text-success p-2">Acceuil</a>
<a href="admin.php" class="text-success p-2">Espace Administration</a>
<a href="adminContacts.php" class="text-success p-2">Gestion des Services</a>
    <div class="p-4">
        <h2>Voir les formulaire de contact</h2>
    </div>
        <?php
    VoirContact($pdo)
        ?>
<?php
require_once("./templates/footer.php");
?>
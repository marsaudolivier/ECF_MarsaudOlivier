<?php
require_once("./templates/header.php");
?>
<!--Intégration de la Fil ariane-->
<a href="index.php" class="text-success p-2">Acceuil</a>
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
?>


<?php
require_once("./templates/footer.php");
?>
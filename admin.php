<?php
require_once("./templates/header.php");
require_once("./lib/utilisateurs.php");
require_once("./lib/contact.php");
$countNonTraitedForms = Contact::CountNonTraitedForms($pdo);

?>
<script src="./scripts/admin.js"></script>

<!--Intégration de la Fil ariane-->
<a href="index.php" class="text-success p-2">Acceuil</a>
<a href="admin.php" class="text-success p-2">Espace Administration</a>

<!--Ajout titre de la page-->
<h2>Bonjour MR</h2>
<!--Ajout panel admin-->
<Div class="admin_conteneur p-2">
    <a href="adminUtilisateurs.php" class="text-success p-2">
        <h3>Administration du personnel</h3>
    </a>
    <a href="adminHoraires.php" class="text-success p-2">
        <h3>Administration des horaires</h3>
    </a>
    <a href="adminContacts.php" class="text-success p-2">
    <h3>Administratrion Contact <span class="badge badge-secondary">Nouveau message: <?= $countNonTraitedForms ?></span></h3>
</a>
    </a>
    <a href="adminAvis.php" class="text-success p-2">
        <h3>Administration des Avis</h3>
    </a>
    <a href="adminServices.php" class="text-success p-2">
    <h3>Administration des Services </span></h3>
</a>
    <a href="adminVoitures.php" class="text-success p-2">
        <h3>Administration des ventes vehicules</h3>
    </a>
</Div>















<?php
require_once("./templates/footer.php");
?>
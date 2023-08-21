<?php
require_once("./templates/header.php");
require_once("./lib/horaires.php");
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
<!--Fin Intégration de la fil Arianne -->
</body>

</html>
<?php
require_once("./templates/footer.php");
?>
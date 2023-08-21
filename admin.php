<?php
require_once("./templates/header.php");
require_once("./lib/utilisateurs.php");

?>
<script src="./scripts/admin.js"></script>

<!--Intégration de la Fil ariane-->
<a href="index.php" class="text-success p-2">Acceuil</a>
<a href="admin.php" class="text-success p-2">Espace Administration</a>

<!--Ajout titre de la page-->
<h2>Bonjour MR</h2>
<!--Ajout panel admin-->
<Div class="admin_conteneur">
    <a href="adminUtilisateurs.php" class="text-success p-2"><h3>Administration du personnel</h3></a>
    <a href="adminHoraires.php" class="text-success p-2"><h3>Administration des horaires</h3></a>
    <a href="adminServices.php" class="text-success p-2"><h3>Administration des Services</h3></a>
    <a href="adminAvis.php" class="text-success p-2"><h3>Administration des Avis</h3></a>

</Div>
 
            </div>





       




        




        <?php
        require_once("./templates/footer.php");
        ?>
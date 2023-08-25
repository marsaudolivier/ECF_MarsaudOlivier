<?php
require_once ("./templates/header.php");
require_once ("./lib/annonces.php");
?>
<!--Intégration de la Fil ariane-->
<a href="index.php" class="text-success p-2">Acceuil</a>
<a href="admin.php" class="text-success p-2">Espace Administration</a>
<a href="adminVoitures.php" class="text-success p-2">Gestion des ventes vehicules</a>

<!--Intégration du tableau-->
<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th scope="col">Titre</th>
            <th scope="col">Date de publication</th>
            <th scope="col">Kilométrage</th>
            <th scope="col">Année de mise en circulation</th>
            <th scope="col">Prix</th>
            <th scope="col">Photo</th>
            <th scope="col">Supprimer</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // On récupère toutes les annonces
        $Annonces = Annonces::GetAnnonces($pdo);
        var_dump($Annonces);
        // On affiche les annonces
        foreach ($Annonces as $Annonce){
            echo "<tr>";
            echo "<td>" . $Annonce['titre'] . "</td>";
            echo "<td>" . $Annonce['date_publication'] . "</td>";
            echo "<td>" . $Annonce['kilometrage'] . "</td>";
            echo "<td>" . $Annonce['annee'] . "</td>";
            echo "<td>" . $Annonce['prix'] . "</td>";
            echo "<td><img src='./images/" . $Annonce['photo'] . "' width='100px'></td>";
            echo "<td><a href='adminVoitures.php?Id_Annonces=" . $Annonce['Id_Annonces'] . "'><i class='fas fa-trash-alt'></i></a></td>";
            echo "</tr>";
        }
        ?>
    </tbody>
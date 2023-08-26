<?php
function Card($voiture)
{ ?>
    <div class="col">
        <div class="card shadow-sm admin_conteneur">
            <img src="./uploads/voitures/twingo.jpg" alt="" class="index_text">
            <h3><?= $voiture['titre'] ?></h3>
            <p class="card-text">Année :<?= $voiture['annee'] ?></br>
                Kilométrage : <?= $voiture['kilometrage'] ?></br>
                Prix : <?= $voiture['prix'] ?></p>
            <?php
            if (isset($_SERVER["SCRIPT_NAME"]) && $_SERVER["SCRIPT_NAME"] == "/adminVoitures.php") { ?>
                <form action="adminVoitures.php" method="post">
                    <input type="hidden" name="Id_Annonces" value="<?= $voiture['Id_Annonces'] ?>">
                    <button type="submit" name="modifieAnnonceButton" class="btn btn-sm btn-primary">Modifier</button>
                </form>
                <form action="adminVoitures.php" method="post">
                    <input type="hidden" name="Id_Annonces" value="<?= $voiture['Id_Annonces'] ?>">
                    <button type="submit" name="deleteAnnonceButton" class="btn btn-sm btn-danger">Supprimer</button>
                </form>
            <?php } ?>
        </div>
    </div>
<?php
}

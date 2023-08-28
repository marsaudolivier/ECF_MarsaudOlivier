<?php
function Card($voiture)
{ ?>
    <div class="col">
        <div class="card shadow-sm admin_conteneur">
            <img src="./uploads/voitures/twingo.jpg" alt="" class="index_text">
            <h3><?= $voiture['titre'] ?></h3>
            <p class="card-text">Année :<?= $voiture['annee'] ?></br>
                Kilométrage : <?= $voiture['kilometrage'] ?> Km</br>
                Prix : <?= $voiture['prix'] ?> €</p>
            <?php
            if (isset($_SERVER["SCRIPT_NAME"]) && $_SERVER["SCRIPT_NAME"] == "/adminVoitures.php") { ?>
                <form action="adminVoitures.php" method="post">
                    <input type="hidden" name="Id_Annonces" value="<?= $voiture['Id_Annonces'] ?>">
                    <button type="submit" name="deleteAnnonceButton" class="btn btn-sm btn-danger">Supprimer</button>
                </form>
                <form action="adminVoitures.php" method="post">
                    <input type="hidden" name="Id_Annonces" value="<?= $voiture['Id_Annonces'] ?>">
                    <button type="submit" name="modifieAnnonceButton" class="btn btn-sm btn-warning">Modifier</button>
                <?php } ?>
        </div>
    </div>
<?php
}
?>
<?php
function CardEdit($voiture, $pdo)
{ ?>
    <div class="Card-admin p-2">
        <div class="card shadow-sm admin_conteneur">
            <form action="adminVoitures.php" method="post">
                <div class="row">
                    <div class="col">
                        <img src="./uploads/voitures/twingo.jpg" class="" width="40%">
                        <input type="file" name="photo_principal" id="photo_principal" value="<?= $voiture['photo_principal'] ?>">
                    </div>
                    <div class="col p-5">
                        <input type="hidden" name="Id_Voitures" value="<?= $voiture['Id_Voitures'] ?>">
                        <input type="hidden" name="Id_Marques" value="<?= $voiture['Id_Marques'] ?>">
                        <input type="hidden" name="photo_principal" value="<?= $voiture['photo_principal'] ?>">
                        <input type="hidden" name="date_publication" value="<?= $voiture['date_publication'] ?>">
                        <p class="card-text">Titre: <input type="text" name="titre" value="<?= $voiture['titre'] ?>"></br>Année :<input type="number" name="annee" value="<?= $voiture['annee'] ?>">
                            Kilométrage : <input type="number" name="kilometrage" value="<?= $voiture['kilometrage'] ?>"></br>
                            marque : <input type="text" name="marque" value="<?= $voiture['marque'] ?>">
                            modèle : <input type="text" name="modele" value="<?= $voiture['modele'] ?>"></br>
                            Energie : <input type="text" name="energie" value="<?= $voiture['energie'] ?>">
                            Prix : <input type="number" name="prix" value="<?= $voiture['prix'] ?>"></br>
                        </p>
                    </div>
                    <fieldset class="p-5">
                        <legend> Options : </legend>
                        <?php
                        require_once('./lib/options.php');
                        $Id_Voitures = $voiture['Id_Voitures'];
                        $options = Options::GetOptionById($pdo, $Id_Voitures); 
                        foreach ($options as $option) {
                            echo '<input class="test3" type="checkbox" name="options[]" value="' . $option['Id_Options'] . '" checked>' . $option['optionn'];
                        }
                        
                        $uncheckedOptions = Options::GetOptionById2($pdo, $Id_Voitures);
                        foreach ($uncheckedOptions as $option) {
                            echo '<input class="test3" type="checkbox" name="options[]" value="' . $option['Id_Options'] . '">' . $option['optionn'];
                        }
                        ?>
                    </fieldset>
                </div>
                <input type="hidden" name="Id_Annonces" value="<?= $voiture['Id_Annonces'] ?>">
                <button type="submit" name="modifierVoiture" class="btn btn-success">Modifier</button>
            </form>
        </div>
    </div>
    </div>
<?php
}

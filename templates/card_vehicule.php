<?php
//Récupératuin de chaque carte voiture utilisation $voitures
function Card($voiture)
{ ?>
    <div class="col">
        <div class="card shadow-sm admin_conteneur">
            <img src="<?= $voiture['photo_principal'] ?>" class="card_photo">
            <h3><?= $voiture['titre'] ?></h3>
            <p class="card-text">Année :<?= $voiture['annee'] ?></br>
                Kilométrage : <?= $voiture['kilometrage'] ?> Km</br>
                Prix : <?= $voiture['prix'] ?> €</br>
                Marque : <?= $voiture['marque'] ?></br>
                Modèle :<?= $voiture['modele'] ?>
            </p>
            <?php
            //Si admin Alors possibilité delette et modifier
            if (isset($_SERVER["SCRIPT_NAME"]) && $_SERVER["SCRIPT_NAME"] == "/adminVoitures.php") { ?>
                <form action="adminVoitures.php" method="post">
                    <input type="hidden" name="Id_Voitures" value="<?= $voiture['Id_Voitures'] ?>">

                    <input type="hidden" name="Id_Annonces" value="<?= $voiture['Id_Annonces'] ?>">
                    <button type="submit" name="deleteAnnonceButton" class="btn btn-sm btn-danger">Supprimer</button>
                </form>
                <form action="adminVoitures.php" method="post">
                    <input type="hidden" name="Id_Annoncess" value="<?= $voiture['Id_Annonces'] ?>">
                    <button type="submit" name="modifieAnnonceButton" class="btn btn-sm btn-warning">Modifier</button>
                <?php }
            //Si sur la page ventes alors possibilité avoir détail annonces
            if (isset($_SERVER["SCRIPT_NAME"]) && $_SERVER["SCRIPT_NAME"] == "/ventes.php") { ?>
                    <form action="ventes.php" method="post">
                        <input type="hidden" name="Id_Annonces" value="<?= $voiture['Id_Annonces'] ?>">
                        <button type="submit" name="detailAnnonceButton" class="btn btn-sm btn-warning">Détail</button>
                    <?php }  ?>
        </div>
    </div>
<?php
}
?>
<?php
//Edition véhicules
function CardEdit($voiture, $pdo)
{ ?>
    <div class="Card-admin p-2">
        <div class="card shadow-sm admin_conteneur">
            <form action="adminVoitures.php" method="post">
                <div class="row">
                    <div class="col">
                        <img src="<?= $voiture['photo_principal'] ?>" width="40%">
                    </div>
                    <div class="col p-5 admin_conteneur">
                        <input type="hidden" name="Id_Voitures" value="<?= $voiture['Id_Voitures'] ?>">
                        <input type="hidden" name="Id_Marques" value="<?= $voiture['Id_Marques'] ?>">
                        <input type="hidden" name="photo_principal" value="<?= $voiture['photo_principal'] ?>">
                        <input type="hidden" name="date_publication" value="<?= $voiture['date_publication'] ?>">
                        <p class="card-text">Titre: <input type="text" name="titre" value="<?= $voiture['titre'] ?>"></br>Année :<input type="number" name="annee" value="<?= $voiture['annee'] ?>"required>
                            Kilométrage : <input type="number" name="kilometrage" value="<?= $voiture['kilometrage'] ?>"required></br>
                            marque : <input type="text" name="marque" value="<?= $voiture['marque'] ?>"required>
                            <label for="modele" class="text-primary"required>modèle</label>
                            <select name="modele" id="modele">
                                <?php
                                $Id_marques = $voiture['Id_Marques'];
                                $modeles = Modeles::GetModelesByMarques($pdo, $Id_marques);
                                foreach ($modeles as $modele) {
                                    echo '<option value="' . $modele['Id_Modeles'] . '"required>' . $modele['modele'] . '</option>';
                                }
                                ?>
                                Prix : <input type="number" name="prix" value="<?= $voiture['prix'] ?>"></br>
                                <fieldset class="admin_conteneur p-2">
                                    <legend> Energie :</legend>
                                    <?php
                                    //récupération des energie valide
                                    require_once('./lib/energies.php');
                                    $Id_Voitures = $voiture['Id_Voitures'];
                                    $energies = Energies::GetEnergieById($pdo, $Id_Voitures);
                                    foreach ($energies as $energie) {
                                        echo '<input class="test3" type="checkbox" name="options[]" value="' . $energie['Id_Energies'] . '" checked>' . $energie['energie'];
                                    }
                                    ?>
                                    <?php
                                    //récupération des energie non présentes
                                    $uncheckedEnergies = Energies::GetEnergieById2($pdo, $Id_Voitures);
                                    foreach ($uncheckedEnergies as $energie) {
                                        echo '<input class="test3" type="checkbox" name="options[]" value="' . $energie['Id_Energies'] . '">' . $energie['energie'];
                                    }
                                    ?>
                                </fieldset>
                        </p>
                    </div>
                    <fieldset class="p-5 admin_conteneur">
                        <legend> Options : </legend>
                        <?php  //récupération des option valide
                        require_once('./lib/options.php');
                        $options = Options::GetOptionById($pdo, $Id_Voitures);
                        foreach ($options as $option) {
                            echo '<input class="test3" type="checkbox" name="optionss[]" value="' . $option['Id_Options'] . '" checked>' . $option['optionn'];
                        } //récupération des option non présentes
                        $uncheckedOptions = Options::GetOptionById2($pdo, $Id_Voitures);
                        foreach ($uncheckedOptions as $option) {
                            echo '<input class="test3" type="checkbox" name="optionss[]" value="' . $option['Id_Options'] . '">' . $option['optionn'];
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
// Ajout de véhicule pannel admin
function Newcard($pdo)
{ ?>
    <div class="card shadow-sm admin_conteneur">
        <h3>Création de vehicule</h3>
        <form action="adminVoitures.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm();">
            <div class="row admin_conteneur">
                <div class="col p-2">
                    <p class="card-text">Titre: <input type="text" name="titre" value=""required></br>Année :<input type="number" name="annee" value=""required>
                        Kilométrage : <input type="number" name="kilometrage" value=""required></br>
                        <?php
                        require_once('./lib/annonces.php');
                        $annonces = Marques::GetMarques($pdo);
                        //select marque
                        echo '<label for="marque" class="text-primary">marque</label>';
                        echo '<select name="marque" id="marque">';
                        foreach ($annonces as $annonce) {
                            echo '<option value="' . $annonce['Id_Marques'] . '">' . $annonce['marque'] . '</option>';
                        }
                        echo '</select>';
                        ?>
                        <label for="modele" class="text-primary">modèle</label>
                        <select name="modele" id="modele">
                        </select>
                        </br>
                        Prix : <input type="number" name="prix" value=""required></br>
                        <img id="image_preview" src="#" alt="Aperçu de l'image" style="display: none; width: 300px; height: 200px;">
                        <label for="photo_principal">Choisissez une photo principale :</label>
                        <input type="file" name="photo_principal" id="photo_principal" accept="image/*"required>
                    <fieldset class="p-2 admin_conteneur">
                        <legend> Energie :</legend>
                        <?php
                        require_once('./lib/energies.php');
                        $energies = Energies::GetEnergies($pdo);
                        foreach ($energies as $energie) {
                            echo '<input class="test3" type="checkbox" name="energie[]" value="' . $energie['Id_Energies'] . '">' . $energie['energie'];
                        }
                        ?>
                    </fieldset>
                </div><br />
                <div class="col p-2 ">
                    <!--Choix d'option-->
                    <fieldset class="p-2 admin_conteneur" id="optionsFieldset">
                        <legend> Options : </legend>
                        <?php
                        require_once('./lib/options.php');
                        $options = Options::GetOptions($pdo);
                        foreach ($options as $option) {
                            echo '<input class="test3" type="checkbox" name="options[]" value="' . $option['Id_Options'] . '">' . $option['optionn'];
                        }
                        ?>
                    </fieldset>
                    <label for="photo_secondaire">Choisissez des photos secondaires :</label>
                    <input type="file" name="photo_secondaire[]" id="photo_secondaire" accept="image/*" multiple>
                    <div id="image_previews"></div>
                    <button type="submit" name="ajouterVoiture" class="btn btn-outline-dark ">Ajouter Voiture</button>
                </div>
            </div>
            <div class="p-2"></div>
        </form>
        <div class="admin_conteneurTwo">
            <form id="ajoutMarqueForm" method="post" enctype="multipart/form-data">
                <label for="nouvelleMarque">Entrez le nom de la nouvelle marque :</label>
                <input type="text" id="nouvelleMarque" name="nouvelleMarque"required>
                <button type="submit" id="validerMarque">Valider</button>
            </form>
            <form id="ajoutOptionFormm" method="post" enctype="multipart/form-data">
                <label for="nouvelleOption">Entrez le nom de la nouvelle option :</label>
                <input type="text" id="nouvelleOption" name="nouvelleOption"required>
                <button type="submit" id="validerOption">Valider</button>
            </form>
            <form id="ajoutModeleForm" method="post" enctype="multipart/form-data">
                <?php
                require_once('./lib/annonces.php');
                $annonces = Marques::GetMarques($pdo);
                //select
                echo '<label for="marqueAddModele" class="text-primary">marque</label>';
                echo '<select name="marqueAddModele" id="marqueAddModele">';
                foreach ($annonces as $annonce) {
                    echo '<option value="' . $annonce['Id_Marques'] . '">' . $annonce['marque'] . '</option>';
                }
                echo '</select>';
                ?>
                <label for="nouvelleModele">nouveau modèle :</label>
                <input type="text" id="nouvelleModele" name="nouvelleModele">
                <button type="submit" id="validerModele">Valider</button>
            </form>
        </div>

    </div>
<?php
}
// récupération des annonces
function recupAnonce($pdo){
    $Annonces = Annonces::GetAnnonces($pdo); ?>
    <!-- On affiche les annonces -->
    <form action="adminVoitures.php" method="post">
        <?php
        if (isset($_SERVER["SCRIPT_NAME"]) && $_SERVER["SCRIPT_NAME"] == "/adminVoitures.php") { ?>
            <h2>Liste des véhicules</h2>
            <button type="submit" name="CreateVehicule" class="btn btn-sm btn-success">création d'un nouveau vehicule</button>
        <?php } ?>
    </form>
    <div class="album py-5">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                <?php
                foreach ($Annonces as $voiture) {
                    Card($voiture);
                }
                ?>
            </div>
        </div>
    </div>
<?php
}
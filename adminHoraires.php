<?php
require_once("./templates/header.php");
?>
<!--Intégration de la Fil ariane-->
<a href="index.php" class="text-success p-2">Acceuil</a>
<a href="admin.php" class="text-success p-2">Espace Administration</a>
<a href="adminHoraires.php" class="text-success p-2">Gestion Horaires</a>
 <div class="p-2 admin_conteneur" id="Horaires">
            <div class="p-2">
                <h2>Modifier horaire par rapport au jours</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Jour</th>
                            <th scope="col">Ouverture</th>
                            <th scope="col">Fermeture</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = 'SELECT * FROM Jours INNER JOIN durer d on Jours.Id_Jours = d.Id_Jours INNER JOIN Heures H on d.Id_Heures = H.Id_Heures ORDER BY Jours.Id_Jours';
                        $query = $pdo->prepare($sql);
                        $query->execute();
                        $jours = $query->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($jours as $jour) {
                            echo "<tr>";
                            echo "<td>" . $jour['jour'] . "</td>";
                            echo "<td>" . $jour['Ouverture'] . "</td>";
                            echo "<td>" . $jour['Fermeture'] . "</td>";
                            echo "<td>";
                            echo "<form method='post' action='adminHoraires.php'>";
                            echo "<input type='hidden' name='ModifierJourId' value='" . $jour['Id_Jours'] . "'>";
                            echo "<button type='submit' name='ModifierJourButton' >Modifier</button>";
                            echo "</form>";
                            echo "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <?php
                if (isset($_POST['ModifierJourButton'])) {
                    if (isset($_POST['ModifierJourId'])) {
                        $ModifierJourId = $_POST['ModifierJourId'];
                        $sql = 'SELECT * FROM Jours INNER JOIN durer d on Jours.Id_Jours = d.Id_Jours INNER JOIN Heures H on d.Id_Heures = H.Id_Heures WHERE Jours.Id_Jours = :Id_Jours';
                        $query = $pdo->prepare($sql);
                        $query->execute(array('Id_Jours' => $ModifierJourId));
                        $jour = $query->fetch();
                        echo "<form action='adminHoraires.php' method='post'>";
                        echo "<div class='mb-3'>";
                        echo "<label for='Ouverture' class='form-label'>Ouverture</label>";
                        echo "<input type='text' class='form-control' id='Ouverture' name='Ouverture' value='" . $jour['Ouverture'] . "'>";
                        echo "</div>";
                        echo "<div class='mb-3'>";
                        echo "<label for='Fermeture' class='form-label'>Fermeture</label>";
                        echo "<input type='text' class='form-control' id='Fermeture' name='Fermeture' value='" . $jour['Fermeture'] . "'>";
                        echo "</div>";
                        echo "<input type='hidden' name='ModifierJourId' value='" . $jour['Id_Jours'] . "'>";
                        echo "<button type='submit' name='ModifierJourButton' class='btn btn-primary'>Modifier</button>";
                        echo "</form>";
                    }
                }
                if (isset($_POST['ModifierJourButton'])) {
                    if (isset($_POST['ModifierJourId'])) {
                        $ModifierJourId = $_POST['ModifierJourId'];
                        $Ouverture = $_POST['Ouverture'];
                        $Fermeture = $_POST['Fermeture'];
                        $sql = 'UPDATE Heures SET Ouverture = :Ouverture, Fermeture = :Fermeture WHERE Id_Heures = :Id_Heures';
                        $query = $pdo->prepare($sql);
                        $query->execute(array('Ouverture' => $Ouverture, 'Fermeture' => $Fermeture, 'Id_Heures' => $ModifierJourId));
                        $query->bindValue(':Id_Heures', $ModifierJourId, PDO::PARAM_INT);
                        $query->execute();
                        header("Location: adminHoraires.php");
                        exit();
                    }
                }
                ?>
            </div>
            <H5>Ajout d'ouverture fermeture</H5>
            <form action="adminHoraires.php" method="post">
                <div class="mb-3">
                    <label for="Ouverture" class="form-label">Ouverture</label>
                    <input type="text" class="form-control" id="Ouverture" name="Ouverture" placeholder="Ouverture">
                </div>
                <div class="mb-3">
                    <label for="Fermeture" class="form-label">Fermeture</label>
                    <input type="text" class="form-control" id="Fermeture" name="Fermeture" placeholder="Fermeture">
                </div>
                <div class="mb-3">
                    <label for="Id_Jours" class="form-label">Jour</label>
                    <select class="form-select" aria-label="Default select example" name="Id_Jours">
                        <option selected>Choisissez un jour</option>
                        <?php
                        $sql = 'SELECT * FROM Jours';
                        $query = $pdo->prepare($sql);
                        $query->execute();
                        $jours = $query->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($jours as $jour) {
                            echo "<option value='" . $jour['Id_Jours'] . "'>" . $jour['jour'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Ajouter</button>
            </form>
            <?php
            if (isset($_POST['Ouverture']) && isset($_POST['Fermeture']) && isset($_POST['Id_Jours'])) {
                $Ouverture = $_POST['Ouverture'];
                $Fermeture = $_POST['Fermeture'];
                $Id_Jours = $_POST['Id_Jours'];
                $sql = 'INSERT INTO Heures (Ouverture, Fermeture) VALUES (:Ouverture, :Fermeture)';
                $query = $pdo->prepare($sql);
                $query->execute(array('Ouverture' => $Ouverture, 'Fermeture' => $Fermeture));
                $Id_Heures = $pdo->lastInsertId();
                $sql = 'INSERT INTO durer (Id_Jours, Id_Heures) VALUES (:Id_Jours, :Id_Heures)';
                $query = $pdo->prepare($sql);
                $query->execute(array('Id_Jours' => $Id_Jours, 'Id_Heures' => $Id_Heures));
                header("Location: adminHoraires.php");
                exit();
            }
            ?>
        </div>
            </div>

            

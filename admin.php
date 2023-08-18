<?php
require_once("./templates/header.php");
require_once("./lib/utilisateurs.php");
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<!--Intégration de la Fil ariane-->
<a href="index.php" class="text-success p-2">Acceuil</a>
<a href="admin.php" class="text-success p-2">Espace Administration'</a>
<!--Ajout titre de la page-->
<h2>Bonjour MR</h2>
<!--Ajout panel admin-->
<div class="p-4 ">
    <h2>Espace administration</h2>
    <div class="p-2 ">
        <h3>Gestion des utilisateurs</h3>
        <div class="p-2 admin_conteneur">
            <h5>Liste des utilisateurs</h5>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Nom</th>
                        <th scope="col">Prénom</th>
                        <th scope="col">Mail</th>
                        <th scope="col">Mot de passe</th>
                        <th scope="col">Rôle</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $users = utilisateurs::GetAllUsers($pdo);
                    foreach ($users as $user) {
                        echo "<tr>";
                        echo "<td>" . $user['nom'] . "</td>";
                        echo "<td>" . $user['prenom'] . "</td>";
                        echo "<td>" . $user['mail'] . "</td>";
                        echo "<td>" . $user['mdp'] . "</td>";
                        echo "<td>" . ($user['Id_Roles'] === 1 ? "Administrateur" : "Utilisateur") . "</td>";
                        echo "<td>";
                        echo "<form method='post' action='admin.php'>";
                        echo "<input type='hidden' name='deleteUserId' value='" . $user['Id_Utilisateurs'] . "'>";
                        echo "<button type='submit' name='deleteUserButton'>Supprimer</button>";
                        echo "</form>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    if (isset($_POST['deleteUserButton'])) {
                        if (isset($_POST['deleteUserId'])) {
                            $userIdToDelete = $_POST['deleteUserId'];
                            Utilisateurs::DeleteUser($pdo, $userIdToDelete);
                            header("Location: admin.php");
                            exit();
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
                    <div class="p-2">

                    </div>
        <div class="p-2 admin_conteneur">
            <h5>Ajouter un utilisateur</h5>
            <form action="admin.php" method="post">
                <div class="mb-3">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" class="form-control" id="nom" name="nom" placeholder="Nom">
                </div>
                <div class="mb-3">
                    <label for="prenom" class="form-label">Prénom</label>
                    <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Prénom">
                </div>
                <div class="mb-3">
                    <label for="mail" class="form-label">Mail</label>
                    <input type="text" class="form-control" id="mail" name="mail" placeholder="Mail">
                </div>
                <div class="mb-3">
                    <label for="mdp" class="form-label">Mot de passe</label>
                    <input type="text" class="form-control" id="mdp" name="mdp" placeholder="Mot de passe">
                </div>
                <div class="mb-3">
                    <label for="Id_Roles" class="form-label">Rôle</label>
                    <select class="form-select" aria-label="Default select example" name="Id_Roles">
                        <option selected>Choisissez un rôle</option>
                        <option value="2">Utilisateur</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Ajouter</button>
            </form>
            <?php
            if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['mail']) && isset($_POST['mdp']) && isset($_POST['Id_Roles'])) {
                $nom = $_POST['nom'];
                $prenom = $_POST['prenom'];
                $mail = $_POST['mail'];
                $mdp = $_POST['mdp'];
                $Id_Roles = $_POST['Id_Roles'];
                $user = new Utilisateurs($nom, $prenom, $mail, $mdp, $Id_Roles);
                $user->insertUser($user, $pdo);
                header("Location: admin.php");
                exit();
            }
            ?>
</div>










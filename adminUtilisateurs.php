<?php
require_once("./templates/header.php");
require_once("./lib/utilisateurs.php");
// Vérification des cookie de connexion
if (!empty($_COOKIE)) {
    $mail = $_COOKIE['mail'];
    $token = $_COOKIE['token'];
    $user = utilisateurs::UtilisateurVerificationToken($pdo, $mail, $token);
?>
    <!--Intégration de la Fil ariane-->
    <a href="index.php" class="text-success p-2">Acceuil</a>
    <a href="admin.php" class="text-success p-2">Espace Administration</a>
    <a href="adminUtilisateurs.php" class="text-success p-2">Gestion Utilisateurs</a>
    <div class="p-2" id="Utilisateur">
        <div class="p-2 admin_conteneur">
            <h5>Liste des utilisateurs</h5>
            <table class="table">
                <thead>
                    <tr>
                        <!--tableau récapitulatif employé-->
                        <th scope="col">Nom</th>
                        <th scope="col">Prénom</th>
                        <th scope="col">Mail</th>
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
                        echo "<td>" . ($user['Id_Roles'] === 1 ? "Administrateur" : "Utilisateur") . "</td>";
                        echo "<td>";
                        echo "<form method='post' action='adminUtilisateurs.php'>";
                        if ($user['Id_Roles'] === 2) {
                            echo "<input type='hidden' name='deleteUserId' value='" . $user['Id_Utilisateurs'] . "'>";
                            echo "<button type='submit' name='deleteUserButton' >Supprimer</button>";
                        }
                        echo "</form>";
                        echo "</td>";
                        echo "</tr>";
                    } // gestion du bouton supprimé contact
                    if (isset($_POST['deleteUserButton'])) {
                        if (isset($_POST['deleteUserId'])) {
                            $userIdToDelete = $_POST['deleteUserId'];
                            Utilisateurs::DeleteUser($pdo, $userIdToDelete);
                            header("Location: adminUtilisateurs.php");
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
            <form action="adminUtilisateurs.php" method="post" onsubmit="return validateFormUser()">
                <div class="mb-3">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" class="form-control" id="nom" name="nom" placeholder="Nom"required>
                </div>
                <div class="mb-3">
                    <label for="prenom" class="form-label">Prénom</label>
                    <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Prénom"required>
                </div>
                <div class="mb-3">
                    <label for="mail" class="form-label">Mail</label>
                    <input type="email" class="form-control" id="mail" name="mail" placeholder="Mail"required>
                </div>
                <div class="mb-3">
                    <label for="mdp" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" id="mdp" name="mdp" placeholder="Mot de passe"required 
                    data-toggle="tooltip" title="Le mot de passe doit contenir au moins 12 caractères et inclure au moins une lettre majuscule, une lettre minuscule, un chiffre et un caractère spécial.">
                    <input type="checkbox" onclick="showPassword()" > Afficher le mot de passe
                </div>
                <div class="mb-3">
                    <label for="Id_Roles" class="form-label">Rôle</label>
                    <select class="form-select" aria-label="Default select example" name="Id_Roles">
                        <option value="2">Utilisateur</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Ajouter</button>
            </form>
            <?php
            //Ajout sécurité faille XSS
            if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['mail']) && isset($_POST['mdp']) && isset($_POST['Id_Roles'])) {
                $nom = htmlspecialchars($_POST['nom']);
                $prenom = htmlspecialchars($_POST['prenom']);
                $mail = htmlspecialchars($_POST['mail']);
                $mdp = htmlspecialchars($_POST['mdp']);
                $Id_Roles = htmlspecialchars($_POST['Id_Roles']);
                $user = new Utilisateurs($nom, $prenom, $mail, $mdp, $Id_Roles);
                $user->insertUser($user, $pdo);
                header("Location: adminUtilisateurs.php");
                exit();
            }
            ?>
        </div>
    </div>
<?php } else { ?>
    <div class="p-4">
        <h2>Vous n'avez pas accès à cette page</h2>
    </div>
<?php };
require_once("./templates/Footer.php");
?>
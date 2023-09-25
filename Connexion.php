<?php
require_once("./templates/header.php");
require_once("./lib/utilisateurs.php");
if(!empty($_COOKIE)){
    $mail = $_COOKIE['mail'];
    $token = $_COOKIE['token'];
    $user = utilisateurs::UtilisateurVerificationToken($pdo, $mail, $token);
    header('Location: ./admin.php');
}else{
?>
<h2 class="p-3">Connexion administrateur</h2>
<div class="admin_conteneur p-5 container align-middle ">
    <h3>Veuillez entrer vos identifiants pour vous connecter :</h3>
    <form enctype="multipart/form-data" method="POST">
        <div class="col-6 mx-auto p-4 logTexte">
           <label for="email ">Adresse e-mail :</label><br>
        <input type="email" id="email" name="email" class="form-control border border-success" required >
        </div>
        <div class="col-6 mx-auto p-4 logTexte">
              <label for="password ">Mot de passe :</label><br>
        <input type="password" id="password" name="password"class="form-control border border-success" required><br><br>
        </div>
        <input type="submit" value="Connexion" name="test">
    </form>
</div>
<div class="p-5"></div>

<?php
//Ajout sécurité faille XSS
if (isset($_POST['test'])) { 
$mail = htmlspecialchars($_POST['email']);
$password = htmlspecialchars($_POST['password']);
require_once('./lib/utilisateurs.php');
require_once('./lib/pdo.php');
$user = utilisateurs::loginUser($pdo, $mail, $password);

if ($user) {
    $token =bin2hex(random_bytes(50));
    utilisateurs::tokenAdd($pdo, $token, $password, $mail);
    setcookie('token', $token, time() + 3600);
    setcookie('mail', $mail, time() + 3600);
    header("location: admin.php");
    exit();
} else {
    echo "Identifiants invalides. Veuillez réessayer.";
}
}
}
require_once("./templates/Footer.php");
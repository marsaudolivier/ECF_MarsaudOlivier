<?php
//récupération des avis
function Avis($pdo)
{
  $sql = 'SELECT * FROM Avis INNER JOIN Validations v 
  on Avis.Id_Validations = v.Id_Validations 
  ORDER BY Id_Avis DESC';
  $query = $pdo->prepare($sql);
  $query->execute();
  $Validations = $query->fetchAll(PDO::FETCH_ASSOC);
?>
  <div class="p-3 ">
    <div class="avis">
      <?php
      $i = 0;
      //Fonction pour affiché que 1 avis en mobile et 3 en format grand écran
      foreach ($Validations as $Validationn) {
        if ($Validationn['valider'] === 'oui') {
          $i = $i + 1;
          if ($i == '1') {
      ?>
            <div class="index_avis p-2">
              <H3>Avis Client</H3>
              <p><?= $Validationn['commentaire'] ?></p>
              <p><?= $Validationn['nom'] ?> <?= $Validationn['prenom'] ?></p>
              <img src="../assets/images/etoile<?= $Validationn['note'] ?>.svg">
            </div>
          <?php }
          ?>
          <div class="index_avis2 p-2">
            <H3>Avis Client</H3>
            <p><?= $Validationn['commentaire'] ?></p>
            <p><?= $Validationn['nom'] ?> <?= $Validationn['prenom'] ?></p>
            <img src="../assets/images/etoile<?= $Validationn['note'] ?>.svg">
          </div>
      <?php

        }
      } ?>
    </div>
  </div>

<?php
}
//Formulaire de contact 
function AvisContact($pdo)
{
?><div class="p-2">
    <div class="justify-content-center index_text p-2">
      <h2>Votre avis nous intéresse</h2>
      <div class="FormulaireAvis">
      <form enctype="multipart/form-data" method="POST" onsubmit="return validateAvis()">
          <div class="input-container">
            <div class="p-1 avis_input">
              <label for="nom" class="text-primary">Nom:</label>
              <input type="text" id="nomAvis" name="nom" required/>
            </div>
            <div class="p-1 avis_input">
              <label for="prenom" class="text-primary">Prenom:</label>
              <input type="text" id="prenomAvis" name="prenom" required/>
            </div>
          </div>
          <div class="input-container">
            <div class="p-1 avis_input">
              <label for="note" class="text-primary note">Note:</label>
              <input type="number" id="noteAvis" name="note" min="1" max="5" required/>
            </div>
            <div class="p-1 avis_input">
              <label for="commentaire">Commentaire:</label>
              <textarea id="commentaireAvis" name="commentaire" required></textarea>
            </div>
          </div>
          <button type="submit" name="Avis" class="ventes_bouton btn btn-primary">VALIDER</button>
        </form>
      </div>
    </div>
  </div>
<?php
  //récupération des input avec protection XSS
  require('./lib/avis.php');
  if (isset($_POST['Avis'])) {
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $commentaire = htmlspecialchars($_POST['commentaire']);
    $note = htmlspecialchars(intval($_POST['note']));
    if (empty($nom) || empty($prenom) || empty($commentaire) || $note < 1 || $note > 5) {
      echo "Veuillez remplir tous les champs correctement.";
    } else {
      $Id_Validations = 1;
      $avis = new Avis($nom, $prenom, $commentaire, $note, $Id_Validations);
      $avis->insertAvis($avis, $pdo);
    }
  }
}
?>
<?php // Affichage du formulaire sur page Admin
function AvisAdmin($pdo)
{ // fonction de modification au click 
  if (isset($_POST["updateAvisButton"])) {
    Avis::UpdateAvis($pdo);
    header("Location: adminAvis.php");
    exit;
  } //fonction de effacé au click
  if (isset($_POST["deleteAvisButton"])) {
    $Id_AvisToDelete = $_POST['Id_AvisToDelete'];
    Avis::DeleteAvis($pdo, $Id_AvisToDelete);
    header("Location: adminAvis.php");
    exit;
  } //Ajout sur le panel admin d'un avis avec protection XSS
  if (isset($_POST["addAvisButton"])) {
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $commentaire = htmlspecialchars($_POST['commentaire']);
    $note = htmlspecialchars(intval($_POST['note']));
    $Id_Validations = 2;
    $avis = new Avis($nom, $prenom, $commentaire, $note, $Id_Validations);
    if (empty($nom) || empty($prenom) || empty($commentaire) || $note < 1 || $note > 5) {
      echo "Veuillez remplir tous les champs correctement.";
    } else {
      $avis->insertAvis($avis, $pdo);
      header("Location: adminAvis.php");
      exit;
    }
  }
  $Avise = Avis::GetAll($pdo);
  foreach ($Avise as $Aviss) {
?>
    <div class="lib_horaires admin_conteneur p-2">
      <form action="adminAvis.php" method="post">
        <input type="hidden" name="Id_Avis" value="<?= $Aviss['Id_Avis'] ?>">
        <label for="nom">
          <h3>Nom:</h3>
        </label>
        <input type="text" name="nom" value="<?= $Aviss['nom'] ?>">
        <label for="prenom">
          <h3>Prenom:</h3>
        </label>
        <input type="text" name="prenom" value="<?= $Aviss['prenom'] ?>">
        <label for="commentaire">
          <h3>Commentaire:</h3>
        </label>
        <textarea name="commentaire" rows="5" style="width: 100%"><?= $Aviss['commentaire'] ?></textarea>
        <label for="note">
          <h3>Note:</h3>
        </label>
        <input type="number" name="note" value="<?= $Aviss['note'] ?>">
        <label for="Id_Validations">
          <h3>Validations:</h3>
        </label>
        <select name="Id_Validations">
          <?php if ($Aviss['Id_Validations'] === 2) : ?>
            <option value="2">oui</option>
            <option value="1">non</option>
          <?php else : ?>
            <option value="1">non</option>
            <option value="2">oui</option>
          <?php endif; ?>
        </select>
        <!-- Boutons -->
        </select> <button type="submit" name="updateAvisButton" class="btn btn-primary">Modifier</button>
      </form>
      <form action="adminAvis.php" method="post">
        <input type="hidden" name="Id_AvisToDelete" value="<?= $Aviss['Id_Avis'] ?>">
        <button type="submit" name="deleteAvisButton" class="btn btn-danger">Supprimer</button>
      </form>
    </div>
  <?php
  } ?>
  <div class="p-2">
    <div class="justify-content-center index_text p-2">
      <h2>Ajouté un avis</h2>
      <div class="FormulaireAvis">
        <form enctype="multipart/form-data" method="POST">
          <div class="input-container">
            <div class="p-1 avis_input">
              <label for="nom" class="text-primary">Nom:</label>
              <input type="text" id="nom" name="nom" required/>
            </div>
            <div class="p-1 avis_input">
              <label for="prenom" class="text-primary">Prenom:</label>
              <input type="text" id="prenom" name="prenom" required/>
            </div>
          </div>
          <div class="input-container">
            <div class="p-1 avis_input">
              <label for="note" class="text-primary note">Note:</label>
              <input type="number" id="note" name="note" min="1" max="5" required/>
            </div>
            <div class="p-1 avis_input">
              <label for="commentaire">Commentaire:</label>
              <textarea id="commentaire" name="commentaire"required></textarea>
            </div>
          </div>
          <button type="submit" name="addAvisButton" class="ventes_bouton btn btn-primary">VALIDER</button>
        </form>
      </div>
    </div>
  </div>
<?php
}

<?php
function Avis($pdo)
{
  $sql = 'SELECT * FROM Avis INNER JOIN Validations v on Avis.Id_Validations = v.Id_Validations ORDER BY Id_Avis DESC';
  $query = $pdo->prepare($sql);
  $query->execute();
  $Validations = $query->fetchAll(PDO::FETCH_ASSOC);
?>
  <div class="p-3 ">
    <div class="avis">
      <?php
      $i = 0;
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

function test()
{ ?><div class="p-2">
  <div class="justify-content-center index_text p-2">
    <h2>Votre avis nous intéresse</h2>
    <div class="FormulaireAvis">
      <form enctype="multipart/form-data" method="POST">
        <div class="input-container">
          <div class="p-1 avis_input">
            <label for="nom" class="text-primary">Nom:</label>
            <input type="text" id="nom" name="nom" />
          </div>
          <div class="p-1 avis_input">
            <label for="prenom" class="text-primary">Prenom:</label>
            <input type="text" id="prenom" name="prenom" />
          </div>
        </div>
        <div class="input-container">
          <div class="p-1 avis_input">
            <label for="note" class="text-primary note">Note:</label>
            <input type="number" id="note" name="note" min="1" max="5"/>
          </div>
          <div class="p-1 avis_input">
            <label for="commentaire">Commentaire:</label>
            <textarea id="commentaire" name="commentaire"></textarea>
          </div>
        </div>
        <button type="submit" name="Avis" class="ventes_bouton btn btn-primary">VALIDER</button>
      </form>
    </div>
  </div>
</div>
  <?php
  require('./lib/pdo.php');
  require('./lib/avis.php');
  if (isset($_POST['Avis'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $commentaire = $_POST['commentaire'];
    $note = intval($_POST['note']);
    // Validation des données
    if (empty($nom) || empty($prenom) || empty($commentaire) || $note < 1 || $note > 5) {
      echo "Veuillez remplir tous les champs correctement.";
    } else {
      // Les données sont valides, continuer avec l'insertion
      $Id_Validations = 1;
      $avis = new Avis($nom, $prenom, $commentaire, $note, $Id_Validations);
      $avis->insertAvis($avis, $pdo);
    }
  }
}

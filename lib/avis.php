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
        $i = $i + 1;
        if ($Validationn['valider'] === 'oui') {
          if ($i === 1) {
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
};

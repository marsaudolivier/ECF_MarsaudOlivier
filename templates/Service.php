<?php
require_once("./lib/Services.php");
function Service($pdo)
{
  $Services = Services::GetAll($pdo);
?>
    <ul class="service p-4 m-3">
        
        <?php  foreach ($Services as $Service) {
            ?>
            <div class="d-flex p-4">
                <li><?= $Service['titre'] ?></li> <button type="button" class="btn btn-secondary index_bouton" data-bs-toggle="modal" data-bs-target="#<?= $Service['Id_Services'] ?>">
                    Plus d'info
                </button>
            </div>
            </div>
            <?php 
    } ?>
</ul>
          <!-- Modal -->
<?php foreach ($Services as $Service) {?>
  <div class="modal fade p-5" id="<?= $Service['Id_Services'] ?>" tabindex="-1" aria-labelledby="<?= $Service['Id_Services'] ?>" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content test">
        <div class="modal-header">
          <h2 class="modal-title fs-5" id="<?= $Service['Id_Services'] ?>"><?= $Service['titre'] ?></h2>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <P><?= $Service['description'] ?></P>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermeture</button>
        </div>
      </div>
    </div>
  </div>
  </div>
  </div>
<?php
    }
};
?>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
function ServicesAdmin($pdo) {
  if (isset($_POST["updateServicesButton"])) {
      Services::UpdateService($pdo);
      header("Location: adminServices.php");
      exit; 
  }
  
  if (isset($_POST["deleteServicesButton"])) {
      $Id_ServicesToDelete = $_POST["deleteServicesButton"];
      Services::DeleteService($pdo, $Id_ServicesToDelete);
      header("Location: adminServices.php");
      exit;
  }

  if (isset($_POST["NewServicesButton"])) {
    // Récupérer les données du formulaire
    $titre = $_POST['titre'];
    $Description = $_POST['Description'];
    $Id_Utilisateurs = 1;

    
    $newService = new Services($titre, $Description, $Id_Utilisateurs);
  
    
    // Insérer le nouveau service
    Services::InsertService($pdo, $newService);
    
    header("Location: adminServices.php");
    exit; 
}
  // Affichage des services dans la page Admin
  $Services = Services::GetAll($pdo);
  foreach ($Services as $Service) {
      ?>
      <div class="lib_horaires">
          <form action="adminServices.php" method="post">
              <input type="hidden" name="Id_Services" value="<?=$Service['Id_Services']?>">
              <input type="text" name="titre" value="<?=$Service['titre']?>">
              <textarea name="description" rows="10" cols="200"><?=$Service['description']?></textarea>
              <button type="submit" name="updateServicesButton" class="btn btn-success">Modifier</button>
          </form>
          <form action="adminServices.php" method="post">
              <input type="hidden" name="deleteServicesButton" value="<?=$Service['Id_Services']?>">
              <button type="submit" class="btn btn-danger">Supprimer</button>
          </form>
      </div>
      <?php
  }
  ?>
<div class="lib_horaires">
    <form action="adminServices.php" method="post">
        <input type="text" name="titre" placeholder="Titre">
        <textarea name="Description" rows="10" cols="200" placeholder="Description"></textarea>
        <button type="submit" name="NewServicesButton" class="btn btn-success">Ajouter</button>
    </form>
</div>

      <?php
  }
?>







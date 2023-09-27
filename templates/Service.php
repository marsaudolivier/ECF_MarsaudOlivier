<?php
require_once("./lib/Services.php");
function Service($pdo)
{ // Fonction affichage des service
  $Services = Services::GetAll($pdo);
?>
  <ul class="service p-4 m-3">

    <?php foreach ($Services as $Service) {
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
  <!-- Modal pour chaque service -->
  <?php foreach ($Services as $Service) { ?>
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
<?php // Function Administrateur de gestion de service 
function ServicesAdmin($pdo)
{
  //Si click mise a jour
  if (isset($_POST["updateServicesButton"])) {
    Services::UpdateService($pdo);
    header("Location: adminServices.php");
    exit;
  }
  //Gestion effacé
  if (isset($_POST["deleteServicesButton"])) {
    $Id_ServicesToDelete = $_POST["deleteServicesButton"];
    Services::DeleteService($pdo, $Id_ServicesToDelete);
    header("Location: adminServices.php");
    exit;
  }
  //Gestion de création de service
  if (isset($_POST["NewServicesButton"])) {
    $titre = htmlspecialchars($_POST['titre']);
    $Description = htmlspecialchars($_POST['Description']);
    $Id_Utilisateurs = 1;
    //utilisation du constructeur
    $newService = new Services($titre, $Description, $Id_Utilisateurs);
    Services::InsertService($pdo, $newService);

    header("Location: adminServices.php");
    exit;
  }
  // Affichage des services dans la page Admin
  $Services = Services::GetAll($pdo);
  foreach ($Services as $Service) {
?>
    <div class="lib_horaires admin_conteneur p-2">
      <form action="adminServices.php" method="post">
        <input type="hidden" name="Id_Services" value="<?= $Service['Id_Services'] ?>">
        <label for="titre">
          <h3>Titre du Service:</h3>
        </label>
        <input type="text" name="titre" value="<?= $Service['titre'] ?>">
        <textarea name="description" rows="10" style="width: 100%"><?= $Service['description'] ?></textarea>
        <button type="submit" name="updateServicesButton" class="btn btn-primary">Modifier</button>
      </form>
      <form action="adminServices.php" method="post">
        <div>
          <h3>Supprimer le service</h3>
          <p>Êtes-vous sûr de vouloir supprimer le service <?= $Service['titre'] ?> ?</p>
        </div>
        <input type="hidden" name="deleteServicesButton" value="<?= $Service['Id_Services'] ?>">
        <button type="submit" class="btn btn-danger ">Supprimer</button>
      </form>
    </div>
  <?php
  }
  ?>
  <H2 class="p-4">Nouveau Service</H2>
  <div class="lib_horaires admin_conteneur p-3">
    <form action="adminServices.php" method="post" onsubmit="return validateFormServ()">
      <input type="text" name="titre" placeholder="Titre" required id="titreNewServices">
      <textarea name="Description" rows="10" cols="200" placeholder="Description" required id="descriptionNewServices"></textarea>
      <button type="submit" name="NewServicesButton" class="btn btn-success">
        <h3>Ajouter</h3>
      </button>
    </form>
  </div>
<?php
}
?>
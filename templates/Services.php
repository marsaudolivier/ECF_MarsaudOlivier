<?php
require_once("./lib/Services.php");
function Services($pdo)
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

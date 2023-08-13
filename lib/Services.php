<?php
function Services($pdo)
{
    $sql = 'SELECT * FROM Services';
    $query = $pdo->prepare($sql);
    $query->execute();
    $Services = $query->fetchAll(PDO::FETCH_ASSOC);
    foreach ($Services as $Service) {
?>
        <ul class="service p-4 m-3">
            <div class="d-flex p-4">
                <li><?= $Service['titre'] ?></li> <button type="button" class="btn btn-secondary index_bouton" data-bs-toggle="modal" data-bs-target="#<?= $Service['Id_Services'] ?>">
                    Plus d'info
                </button>
            </div>
            </div>
        </ul>
        <?php 
    } ?>
          <!-- Modal -->
<?php foreach ($Services as $Service) {?>
  <div class="modal fade p-5" id="<?= $Service['Id_Services'] ?>" tabindex="-1" aria-labelledby="<?= $Service['Id_Services'] ?>" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="<?= $Service['Id_Services'] ?>"><?= $Service['titre'] ?></h1>
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

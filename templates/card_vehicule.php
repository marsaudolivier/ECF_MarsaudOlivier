<?php
function Card($voiture){ ?>
<div class="col">
                    <div class="card shadow-sm admin_conteneur">
                        <img src="./uploads/voitures/twingo.jpg" alt="" class="index_text">
                        <h3><?= $voiture['titre'] ?></h3>
                        <p class="card-text">Année :<?= $voiture['annee'] ?></br>
                            Kilométrage : <?= $voiture['kilometrage'] ?></br>
                            Prix : <?= $voiture['prix'] ?></p>
                        <div>
                            <button type="button" class="btn btn-sm btn-primary p-2">Plus d'information</button>
                        </div>
                    </div>
                </div>
<?php
}
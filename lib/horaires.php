<?php
function Horaires($pdo){
        $sql = 'SELECT * FROM Jours INNER JOIN durer d on Jours.Id_Jours = d.Id_Jours INNER JOIN Heures H on d.Id_Heures = H.Id_Heures';
        $query = $pdo->prepare($sql);
        $query->execute();
        $jours = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($jours as $jour) {
            ?>
            <p class="text-info"><?=$jour['jour']?> :<?=$jour['Ouverture']?> ,<?=$jour['Fermeture']?> </p>
            <?php
        }

        };

 


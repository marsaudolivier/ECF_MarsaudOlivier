<?php
function Horaires($pdo){
        $sql = 'SELECT J.jour, H.Ouverture, H.Fermeture
        FROM Jours J
        INNER JOIN Heures H ON J.Id_Heures = H.Id_Heures';
        $query = $pdo->prepare($sql);
        $query->execute();
        $jours = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($jours as $jour) {
            ?>
            <p class="text-info lib_horaires"><?=$jour['jour']?> :<?=$jour['Ouverture']?> ,<?=$jour['Fermeture']?> </p>
            <?php
        }

        };

 


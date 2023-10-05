<?php
require_once('jours.php');
// Affichage de mon footer
function Horaires($pdo)
{
    $jours = jours::GetAll($pdo);
    foreach ($jours as $jour) {
?>
        <p class="text-info lib_horaires"><?= $jour['jour'] ?> :<?= $jour['heure_matin'] ?> ,<?= $jour['heure_soir'] ?> </p>
<?php
    }
};
?>
<?php
function HorairesAdmin($pdo)
{
    // Gestion administrateur avec formulaires 
    if (isset($_POST["updateHorairesButton"])) {
        jours::UpdateHoraire($pdo);
        header("Location: adminHoraires.php");
        exit;
    }
    $jours = jours::GetAll($pdo);
    foreach ($jours as $jour) {
?>
        <p class="text-info lib_horaires"><?= $jour['jour'] ?> : <?= $jour['heure_matin'] ?>, <?= $jour['heure_soir'] ?></p>
        <form action="adminHoraires.php" method="post" onsubmit="return validateFormAdmin()">
            <input type="hidden" name="Id_Jours" value="<?= $jour['Id_Jours'] ?>">
            <input type="text" id="jour<?= $jour['Id_Jours'] ?>" name="jour" value="<?= $jour['jour'] ?>">
            <input type="text" id="heure_matin<?= $jour['Id_Jours'] ?>" name="heure_matin" value="<?= $jour['heure_matin'] ?>">
            <input type="text" id="heure_soir<?= $jour['Id_Jours'] ?>" name="heure_soir" value="<?= $jour['heure_soir'] ?>">
            <button type="submit" name="updateHorairesButton" class="btn btn-success">Modifier</button>
        </form>
<?php
    }
}
?>
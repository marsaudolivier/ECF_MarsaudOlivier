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
        <form action="adminHoraires.php" method="post">
            <input type="hidden" name="Id_Jours" value="<?= $jour['Id_Jours'] ?>">
            <input type="text" name="jour" value="<?= $jour['jour'] ?>">
            <input type="text" name="heure_matin" value="<?= $jour['heure_matin'] ?>">
            <input type="text" name="heure_soir" value="<?= $jour['heure_soir'] ?>">
            <button type="submit" name="updateHorairesButton" class="btn btn-success">Modifier</button>
        </form>
<?php
    }
}
?>
<?php
require_once('../lib/pdo.php');
try {
    //récupération de toutes les photo secondaires
    $Id_Voitures = $_POST['Id_Voitures'];
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM Photos
            WHERE Id_Voitures = :Id_Voitures";
    $query = $pdo->prepare($sql);
    $query->bindParam(':Id_Voitures', $Id_Voitures, PDO::PARAM_INT);
    $query->execute();
    $Photos = $query->fetchAll(PDO::FETCH_ASSOC);
    header('Content-Type: application/json');
    echo json_encode(["Photos" => $Photos]);
} catch (PDOException $e) {
    header('Content-Type: application/json');
    echo json_encode(["error" => $e->getMessage()]);
}

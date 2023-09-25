<?php
require_once('../lib/pdo.php');
try {
    $Id_Voitures = $_POST['Id_Voitures'];
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM Energies
            INNER JOIN consommer c ON c.Id_Energies = Energies.Id_Energies
            WHERE c.Id_Voitures = :Id_Voitures";
    $query = $pdo->prepare($sql);
    $query->bindParam(':Id_Voitures', $Id_Voitures, PDO::PARAM_INT);
    $query->execute();
    $energies = $query->fetchAll(PDO::FETCH_ASSOC);
    header('Content-Type: application/json');
    echo json_encode(["energies" => $energies]);
} catch (PDOException $e) {
    header('Content-Type: application/json');
    echo json_encode(["error" => $e->getMessage()]);
}

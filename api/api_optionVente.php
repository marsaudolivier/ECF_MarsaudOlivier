<?php
require_once('../lib/pdo.php');

try {
    $Id_Voitures = $_POST['Id_Voitures'];
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM Options 
            INNER JOIN avoir a ON a.Id_Options = Options.Id_Options
            WHERE a.Id_Voitures = :Id_Voitures";

    $query = $pdo->prepare($sql);
    $query->bindParam(':Id_Voitures', $Id_Voitures, PDO::PARAM_INT);
    $query->execute();
    $options = $query->fetchAll(PDO::FETCH_ASSOC);
    header('Content-Type: application/json');
    echo json_encode(["options" => $options]);
} catch (PDOException $e) {
    header('Content-Type: application/json');
    echo json_encode(["error" => $e->getMessage()]);
}
?>

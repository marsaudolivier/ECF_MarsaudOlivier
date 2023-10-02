<?php
require_once('../lib/pdo.php');
try {
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = 'SELECT * FROM Avis INNER JOIN Validations v 
        on Avis.Id_Validations = v.Id_Validations 
        ORDER BY Id_Avis DESC';
    $query = $pdo->query($sql);
    $avisData = $query->fetchAll(PDO::FETCH_ASSOC);
    header('Content-Type: application/json');
    echo json_encode(["avisData" => $avisData]);
} catch (PDOException $e) {
    header('Content-Type: application/json');
    echo json_encode(["error" => $e->getMessage()]);
}

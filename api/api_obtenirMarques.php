<?php
require_once('../lib/pdo.php');
try {
    //récupération de toute la tables Marques
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM Marques";
    $query = $pdo->query($sql);
    $marques = $query->fetchAll(PDO::FETCH_ASSOC);
    // Envoyez les données au format JSON en réponse
    header('Content-Type: application/json');
    echo json_encode(["marques" => $marques]);
} catch (PDOException $e) {
    // Gérez les erreurs de base de données
    header('Content-Type: application/json');
    echo json_encode(["error" => $e->getMessage()]);
}

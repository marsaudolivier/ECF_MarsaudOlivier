<?php
require_once('../lib/pdo.php');

try {
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Utilisez une requête SQL pour obtenir la liste des marques
    $sql = "SELECT * FROM Options";
    $query = $pdo->query($sql);
    
    // Récupérez toutes les lignes en tant qu'objets JSON
    $option = $query->fetchAll(PDO::FETCH_ASSOC);

    // Envoyez les données au format JSON en réponse
    header('Content-Type: application/json');
    echo json_encode(["option" => $option]);
} catch (PDOException $e) {
    // Gérez les erreurs de base de données
    header('Content-Type: application/json');
    echo json_encode(["error" => $e->getMessage()]);
}
?>
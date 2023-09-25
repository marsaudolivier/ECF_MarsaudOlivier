<?php
require_once('../lib/pdo.php');
try {
    //récupération de tout les modele
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM Modeles";
    $query = $pdo->query($sql);
    // Récupérez toutes les lignes en tant qu'objets JSON
    $modeles = $query->fetchAll(PDO::FETCH_ASSOC);
    // Envoyez les données au format JSON en réponse
    header('Content-Type: application/json');
    echo json_encode(["modeles" => $modeles]);
} catch (PDOException $e) {
    // Gérez les erreurs de base de données
    header('Content-Type: application/json');
    echo json_encode(["error" => $e->getMessage()]);
}
?>
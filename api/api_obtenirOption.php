<?php
require_once('../lib/pdo.php');
try {
    //récupération de la table option
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM Options";
    $query = $pdo->query($sql);
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
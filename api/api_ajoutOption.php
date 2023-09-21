<?php
require_once('../lib/pdo.php');
try {
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_POST['nouvelleOption'])) {
        $nouvelleOption = $_POST['nouvelleOption'];
        // Utilisez une requête préparée pour insérer la nouvelle option
        $sql = "INSERT INTO Options(optionn) VALUES (:nouvelleOption)";
        $query = $pdo->prepare($sql);
        $query->bindParam(':nouvelleOption', $nouvelleOption, PDO::PARAM_STR); // Utilisez PDO::PARAM_STR pour une chaîne de caractères
        $query->execute();
        header('Content-Type: application/json');
        echo json_encode(["success" => true]);
    } else {
        header('Content-Type: application/json');
        echo json_encode(["error" => "Le nom de la nouvelle option n'a pas été spécifié"]);
    }    
} catch (PDOException $e) {
    // Gérez les erreurs de base de données
    header('Content-Type: application/json');
    echo json_encode(["error" => $e->getMessage()]);
}
?>

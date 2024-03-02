<?php
require_once('../lib/pdo.php');
require_once('../lib/tokkentest.php');
if (TokenTest($pdo)) {
    try {
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if (isset($_POST['nouvelleMarque'])) {
            $nouvelleMarque = $_POST['nouvelleMarque'];
            //requête préparée pour insérer la nouvelle marque
            $sql = "INSERT INTO Marques(marque) VALUES (:nouvelleMarque)";
            $query = $pdo->prepare($sql);
            $query->bindParam(':nouvelleMarque', $nouvelleMarque, PDO::PARAM_STR); // Utilisez PDO::PARAM_STR pour une chaîne de caractères
            $query->execute();
            // Envoyez une réponse JSON pour indiquer que l'ajout a réussi
            header('Content-Type: application/json');
            echo json_encode(["success" => true]);
        } else {
            // Si 'nouvelleMarque' n'a pas été spécifiée dans la requête POST
            header('Content-Type: application/json');
            echo json_encode(["error" => "Le nom de la nouvelle marque n'a pas été spécifié"]);
        }
    } catch (PDOException $e) {
        // Gérez les erreurs de base de données
        header('Content-Type: application/json');
        echo json_encode(["error" => $e->getMessage()]);
    }
} else {
    header('Content-Type: application/json');
    echo json_encode(["error" => "Vous n'avez pas les droits pour effectuer cette action"]);
}

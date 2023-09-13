<?php
require_once('../lib/pdo.php');
try {
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_POST['nouvelleModele'])) {
        $nouvelleMarque = $_POST['nouvelleModele'];
        $marque = $_POST['marqueAddModele'];
        // Utilisez une requête préparée pour insérer la nouvelle marque
        $sql = "INSERT INTO Modeles(modele, Id_Marques) VALUES (:nouvelleMarque, :marque)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':nouvelleMarque', $nouvelleMarque);
        $stmt->bindValue(':marque', $marque);
        $stmt->execute();
 
        // Envoyez une réponse JSON pour indiquer que l'ajout a réussi
        header('Content-Type: application/json');
        echo json_encode(["success" => true]);
    } else {
        // Si 'nouvelleModele' n'a pas été spécifié dans la requête POST
        header('Content-Type: application/json');
        echo json_encode(["error" => "Le nom du nouveau modele n'a pas été spécifié"]);
    }
} catch (PDOException $e) {
    // Gérez les erreurs de base de données
    header('Content-Type: application/json');
    echo json_encode(["error" => $e->getMessage()]);
}

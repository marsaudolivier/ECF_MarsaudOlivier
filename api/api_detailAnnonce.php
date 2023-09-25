<?php
require_once('../lib/pdo.php');
try {
    //Usage inerjoin pour récupéré table Marques modeles photo par rapport a la table voiture Id
    $Id_Annonces = $_POST['Id_Annonces'];
    $sql = "SELECT * FROM Annonces 
    INNER JOIN Voitures v on Annonces.Id_Voitures = v.Id_Voitures
    left JOIN Marques m on v.Id_Marques = m.Id_Marques
    left JOIN Modeles mo on v.Id_Modeles = mo.Id_Modeles
    LEFT JOIN Photos p on p.Id_Voitures = Annonces.Id_Voitures
    WHERE Id_Annonces = :Id_Annonces
";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':Id_Annonces', $Id_Annonces, PDO::PARAM_INT);
    $stmt->execute();
    // Récupérez toutes les lignes en tant qu'objets JSON
    $Annonces = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // Envoyez les données au format JSON en réponse
    header('Content-Type: application/json');
    echo json_encode(["Annonces" => $Annonces]);
} catch (PDOException $e) {
    // Gérez les erreurs de base de données
    header('Content-Type: application/json');
    echo json_encode(["error" => $e->getMessage()]);
}

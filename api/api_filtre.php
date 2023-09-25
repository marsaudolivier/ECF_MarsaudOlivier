<?php
require_once('../lib/pdo.php');
try {
    //Usage du filtre avec les tables jointes usage contrainte
    $prixMin = $_POST['prixMin'];
    $prixMax = $_POST['prixMax'];
    $kmMin = $_POST['kmMin'];
    $kmMax = $_POST['kmMax'];
    $anneeMin = $_POST['anneeMin'];
    $anneeMax = $_POST['anneeMax'];
    $sql = "SELECT * FROM Annonces 
    INNER JOIN Voitures v on Annonces.Id_Voitures = v.Id_Voitures
    INNER JOIN Marques m on v.Id_Marques = m.Id_Marques
    INNER JOIN Modeles mo on v.Id_Modeles = mo.Id_Modeles
    WHERE v.prix >= :prixMin
    AND v.prix <= :prixMax
    AND v.kilometrage >= :kmMin
    AND v.kilometrage <= :kmMax
    AND v.annee >= :anneeMin
    AND v.annee <= :anneeMax
";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':prixMin', $prixMin, PDO::PARAM_INT);
    $stmt->bindParam(':prixMax', $prixMax, PDO::PARAM_INT);
    $stmt->bindParam(':kmMin', $kmMin, PDO::PARAM_INT);
    $stmt->bindParam(':kmMax', $kmMax, PDO::PARAM_INT);
    $stmt->bindParam(':anneeMin', $anneeMin, PDO::PARAM_INT);
    $stmt->bindParam(':anneeMax', $anneeMax, PDO::PARAM_INT);
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

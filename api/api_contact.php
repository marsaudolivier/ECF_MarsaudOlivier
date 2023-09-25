<?php
require_once('../lib/pdo.php');
try {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $mail = $_POST['mail'];
    $telephone = $_POST['telephone'];
    $message = $_POST['message'];
    $Annonce = $_POST['Annonce'];
    $Id_Motifs = "4";
    $Id_FormulairesOk = "1";
    $sql = "INSERT INTO Formulaires (nom, prenom, mail, telephone, message, Id_Motifs, Annonce, Id_FormulairesOk) VALUES (:nom, :prenom, :mail, :telephone, :message, :Id_Motifs, :Annonce, :Id_FormulairesOk)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':prenom', $prenom);
    $stmt->bindParam(':mail', $mail);
    $stmt->bindParam(':telephone', $telephone);
    $stmt->bindParam(':message', $message);
    $stmt->bindParam(':Id_Motifs', $Id_Motifs);
    $stmt->bindParam(':Annonce', $Annonce);
    $stmt->bindParam(':Id_FormulairesOk', $Id_FormulairesOk);
    $stmt->execute();
    // Récupérez toutes les lignes en tant qu'objets JSON
    $Formulaires = $stmt->fetchAll(PDO::FETCH_ASSOC);
    header('Location: ../ventes.php?success=1');
    exit(); // Ensure the script stops executing after the redirect
} catch (Exception $e) {
    // Gérer les erreurs de base de données
    header('Content-Type: application/json');
    echo json_encode(["error" => $e->getMessage()]);
}
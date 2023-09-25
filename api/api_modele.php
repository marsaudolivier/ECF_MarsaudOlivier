<?php
require_once('../lib/pdo.php');
try {
    //API pour récupéré modele de facon dynamique sur ma pages par rapport a la marques
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if (isset($_POST['marque'])) {
        $selectedMarque = $_POST['marque'];
        $response = array();
        $sql = "SELECT * FROM Modeles WHERE Id_Marques = :marque";
        $query = $pdo->prepare($sql);
        $errorInfo = $query->errorInfo();
        $query->bindParam(':marque', $selectedMarque, PDO::PARAM_INT);
        $query->execute();
        $modeles = $query->fetchAll(PDO::FETCH_ASSOC);
        $response["modeles"] = $modeles;
        header('Content-Type: application/json');
        echo json_encode($response);
    } else {
        header('Content-Type: application/json');
        echo json_encode(["error" => "La marque n'a pas été spécifiée"]);
    }
} catch (PDOException $e) {
    header('Content-Type: application/json');
    echo json_encode(["error" => $e->getMessage()]);
}

<?php

class Avis
{
    private string $nom;
    private string $prenom;
    private string $commentaire;
    private int $note;
    private int $Id_Validations;

    private function GetNom()
    {
        return $this->nom;
    }
    private function GetPrenom()
    {
        return $this->prenom;
    }
    private function GetCommentaire()
    {
        return $this->commentaire;
    }
    private function GetNote()
    {
        return $this->note;
    }
    private function GetId_Validations()
    {
        return $this->Id_Validations;
    }
    //setters
    private function SetNom($nom)
    {
        $this->nom = $nom;
    }
    private function SetPrenom($prenom)
    {
        $this->prenom = $prenom;
    }
    private function SetCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;
    }
    private function SetNote($note)
    {
        $this->note = $note;
    }
    private function SetId_Validations($Id_Validations)
    {
        $this->Id_Validations = $Id_Validations;
    }
    public function __construct($nom, $prenom, $commentaire, $note, $Id_Validations)
    {
        $this->SetNom($nom);
        $this->SetPrenom($prenom);
        $this->SetCommentaire($commentaire);
        $this->SetNote($note);
        $this->SetId_Validations($Id_Validations);
    }
    public function insertAvis($avis, $pdo)
    {

        $sql = "INSERT INTO Avis (nom, prenom, commentaire, note, Id_Validations) VALUES (:nom, :prenom, :commentaire, :note, :Id_Validations)";
        $stmt = $pdo->prepare($sql);

        // Liage des valeurs
        $stmt->bindParam(':nom', $avis->GetNom());
        $stmt->bindParam(':prenom', $avis->GetPrenom());
        $stmt->bindParam(':commentaire', $avis->GetCommentaire());
        $stmt->bindParam(':note', $avis->GetNote());
        $stmt->bindParam(':Id_Validations', $avis->GetId_Validations());

        if ($stmt->execute()) {
            echo "Avis ajouté";
        } else {
            echo "Avis non ajouté";
        }
    }
    public static function GetAll($pdo)
    {
        $sql = "SELECT * FROM Avis INNER JOIN Validations v on Avis.Id_Validations = v.Id_Validations ORDER BY Id_Avis DESC";
        $query = $pdo->prepare($sql);
        $query->execute();
        $Avis = $query->fetchAll(PDO::FETCH_ASSOC);
        return $Avis;
    }
    public static function DeleteAvis($pdo, $Id_AvisToDelete)
    {
        $sql = "DELETE FROM Avis WHERE Id_Avis = :Id_Avis";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':Id_Avis', $Id_AvisToDelete);
        $stmt->execute();
    }
    public static function UpdateAvis($pdo)
    {
        $sql = "UPDATE Avis SET nom = :nom, prenom = :prenom, commentaire = :commentaire, note = :note, Id_Validations = :Id_Validations WHERE Id_Avis = :Id_Avis";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':Id_Avis', $_POST['Id_Avis']);
        $stmt->bindParam(':nom', $_POST['nom']);
        $stmt->bindParam(':prenom', $_POST['prenom']);
        $stmt->bindParam(':commentaire', $_POST['commentaire']);
        $stmt->bindParam(':note', $_POST['note']);
        $stmt->bindParam(':Id_Validations', $_POST['Id_Validations']);
        $stmt->execute();
    }
}

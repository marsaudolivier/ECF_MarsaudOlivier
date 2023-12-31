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
        // Stocker les valeurs dans des variables
        $nom = $avis->GetNom();
        $prenom = $avis->GetPrenom();
        $commentaire = $avis->GetCommentaire();
        $note = $avis->GetNote();
        $idValidations = $avis->GetId_Validations();
        //Ajout avis client
        $sql = "INSERT INTO Avis (nom, prenom, commentaire, note, Id_Validations) VALUES (:nom, :prenom, :commentaire, :note, :Id_Validations)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':commentaire', $commentaire);
        $stmt->bindParam(':note', $note);
        $stmt->bindParam(':Id_Validations', $idValidations);
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
    { //fonction administrateur mise a jour avis 
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
    public static function AvisValidation($pdo)
    {
        $sql = 'SELECT * FROM Avis INNER JOIN Validations v 
        on Avis.Id_Validations = v.Id_Validations 
        ORDER BY Id_Avis DESC';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $Avis = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $Avis;
    }
}

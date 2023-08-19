<?php
Class Services{
    private int $Id_Services;
    private string $titre;
    private string $description;
    private int $Id_Utilisateurs;

    public function GetId_Services(){
        return $this->Id_Services;
        }
    public function GetTitre(){
        return $this->titre;
        }
    public function GetDescription(){
        return $this->description;
        }
    public function GetId_Utilisateurs(){
        return $this->Id_Utilisateurs;
        }
    public function SetId_Services($Id_Services){
        $this->Id_Services = $Id_Services;
        }
    public function SetTitre($titre){
        $this->titre = $titre;
        }
    public function SetDescription($description){
        $this->description = $description;
        }
    public function SetId_Utilisateurs($Id_Utilisateurs){
        $this->Id_Utilisateurs = $Id_Utilisateurs;
        }
    public function __construct($Id_Services, $titre, $description, $Id_Utilisateurs){
        $this->SetId_Services($Id_Services);
        $this->SetTitre($titre);
        $this->SetDescription($description);
        $this->SetId_Utilisateurs($Id_Utilisateurs);
        }
    public static function GetAll($pdo) {
        $sql = "SELECT * FROM Services";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
        }
    public static function UpdateService($pdo){
        $sql = "UPDATE Services SET titre = :titre, description = :description WHERE Id_Services = :Id_Services";
        $query = $pdo->prepare($sql);
        $query->execute(array(
            ':Id_Services' => $_POST['Id_Services'],
            ':titre' => $_POST['titre'],
            ':description' => $_POST['description']
        ));
    }
    public static function DeleteService($pdo, $Id_Services){
        $sql = "DELETE FROM Services WHERE Id_Services = :Id_Services";
        $query = $pdo->prepare($sql);
        $query->execute(array(
            ':Id_Services' => $Id_Services
        ));
    }
    public static function InsertService($pdo, $Service){
        $sql = "INSERT INTO Services (titre, description, Id_Utilisateurs) VALUES (:titre, :description, :Id_Utilisateurs)";
        $query = $pdo->prepare($sql);
        $query->execute(array(
            ':titre' => $Service->GetTitre(),
            ':description' => $Service->GetDescription(),
            ':Id_Utilisateurs' => $Service->GetId_Utilisateurs()
        ));
    }
}
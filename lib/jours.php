<?php
Class Jours{
    private int $Id_Jours;
    private string $Jours;
    private int $Id_Heures;
    private int $Id_Utilisateurs;

    public function GetJours(){
        return $this->Jours;
    }
    public function GetId_Jours(){
        return $this->Id_Jours;
        }
    public function GetId_Heures(){
        return $this->Id_Heures;
        }
    public function GetId_Utilisateurs(){
        return $this->Id_Utilisateurs;
        }
    public function SetJours($Jours){
        $this->Jours = $Jours;
        }
    public function SetId_Jours($Id_Jours){
        $this->Id_Jours = $Id_Jours;
        }
    public function SetId_Heures($Id_Heures){
        $this->Id_Heures = $Id_Heures;
        }
    public function SetId_Utilisateurs($Id_Utilisateurs){
        $this->Id_Utilisateurs = $Id_Utilisateurs;
        }
    public function __construct($Jours, $Id_Jours, $Id_Heures, $Id_Utilisateurs){
        $this->SetJours($Jours);
        $this->SetId_Jours($Id_Jours);
        $this->SetId_Heures($Id_Heures);
        $this->SetId_Utilisateurs($Id_Utilisateurs);
        }
    public static function GetAll($pdo) {
        $sql = "SELECT * FROM Jours";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
        }
    public static function UpdateHoraire($pdo){
        $sql = "UPDATE Jours SET jour = :jour, heure_matin = :heure_matin, heure_soir = :heure_soir WHERE Id_Jours = :Id_Jours";
        $query = $pdo->prepare($sql);
        $query->execute(array(
            ':Id_Jours' => $_POST['Id_Jours'],
            ':jour' => $_POST['jour'],
            ':heure_matin' => $_POST['heure_matin'],
            ':heure_soir' => $_POST['heure_soir']
        ));
    }
    }

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
    }

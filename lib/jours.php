<?php
Class Jours{
    private int $Id_Jours;
    private string $Jours;

    public function GetId_Jours(){
        return $this->Id_Jours;
    }
    public function GetJours(){
        return $this->Jours;
    }
    public function SetId_Jours($Id_Jours){
        $this->Id_Jours = $Id_Jours;
    }
    public function SetJours($Jours){
        $this->Jours = $Jours;
    }
    public function __construct($Id_Jours, $Jours){
        $this->SetId_Jours($Id_Jours);
        $this->SetJours($Jours);
    }
    public static function GetAll($pdo) {
       $sql = "SELECT * FROM Jours";
       $stmt = $pdo->prepare($sql);
       $stmt->execute();
       $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
       return $result;
    }

}

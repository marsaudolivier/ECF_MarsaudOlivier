<?php
Class Heures{
    private string $Ouverture;
    private string $Fermeture;
    private int $Id_Heures;

    public function GetOuverture(){
        return $this->Ouverture;
    }
    public function GetFermeture(){
        return $this->Fermeture;
    }
    public function GetId_Heures(){
        return $this->Id_Heures;
    }
    public function SetOuverture($Ouverture){
        $this->Ouverture = $Ouverture;
    }
    public function SetFermeture($Fermeture){
        $this->Fermeture = $Fermeture;
    }
    public function SetId_Heures($Id_Heures){
        $this->Id_Heures = $Id_Heures;
    }
    public function __construct($Ouverture, $Fermeture, $Id_Heures){
        $this->SetOuverture($Ouverture);
        $this->SetFermeture($Fermeture);
        $this->SetId_Heures($Id_Heures);
    }
    public static function GetAll($pdo) {
       $sql = "SELECT * FROM Heures";
       $stmt = $pdo->prepare($sql);
       $stmt->execute();
       $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
       return $result;
    }
}
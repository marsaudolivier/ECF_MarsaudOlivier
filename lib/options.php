<?php
Class Options{
    public string $optionn;
    public int $Id_Options;

    public function GetOption(){
        return $this->optionn;
    }
    public function GetId_Options(){
        return $this->Id_Options;
    }
    public function SetOption($optionn){
        $this->optionn = $optionn;
    }
    public function SetId_Options($Id_Options){
        $this->Id_Options = $Id_Options;
    }
    public function __construct($optionn, $Id_Options){
        $this->SetOption($optionn);
        $this->SetId_Options($Id_Options);
    }
    public static function GetOptionById($pdo, $Id_Voitures){
        $sql = "SELECT * FROM Options WHERE Id_Options IN 
        (SELECT a.Id_Options FROM avoir a WHERE a.Id_Modeles = :Id_Voitures)";
    $query = $pdo->prepare($sql);
    $query->execute(['Id_Voitures' => $Id_Voitures]);
    $options = $query->fetchAll(PDO::FETCH_ASSOC);
    return $options;
    }
    public static function GetOptionById2($pdo, $Id_Voitures){
        $sql = "SELECT * FROM Options WHERE Id_Options NOT IN 
        (SELECT a.Id_Options FROM avoir a WHERE a.Id_Modeles = :Id_Voitures)";
    $query = $pdo->prepare($sql);
    $query->execute(['Id_Voitures' => $Id_Voitures]);
    $uncheckedOptions = $query->fetchAll(PDO::FETCH_ASSOC);
    return $uncheckedOptions;
    }
}
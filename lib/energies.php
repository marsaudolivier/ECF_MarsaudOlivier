<?php
class Energies
{
    private string $energie;
    private int $Id_Energies;

    private function GetEnergie()
    {
        return $this->energie;
    }
    private function GetId_Energies()
    {
        return $this->Id_Energies;
    }
    private function SetEnergie($energie)
    {
        $this->energie = $energie;
    }
    private function SetId_Energies($Id_Energies)
    {
        $this->Id_Energies = $Id_Energies;
    }
    public function __construct($energie, $Id_Energies)
    {
        $this->SetEnergie($energie);
        $this->SetId_Energies($Id_Energies);
    }
    public static function GetEnergieById($pdo, $Id_Voitures)
    {//récupération énergie par ID
        $sql = "SELECT * FROM Energies WHERE Id_Energies
        IN (SELECT a.Id_Energies FROM consommer a WHERE a.Id_Voitures = :Id_Voitures)
        ";
        $query = $pdo->prepare($sql);
        $query->execute(['Id_Voitures' => $Id_Voitures]);
        $energies = $query->fetchAll(PDO::FETCH_ASSOC);
        return $energies;
    }
    public static function GetEnergieById2($pdo, $Id_Voitures)
    { //récupération énergie par ID qui ne sont pas dans le véhicule
        $sql = "SELECT * FROM Energies WHERE Id_Energies NOT IN 
        (SELECT a.Id_Energies FROM consommer a WHERE a.Id_Voitures = :Id_Voitures)";
        $query = $pdo->prepare($sql);
        $query->execute(['Id_Voitures' => $Id_Voitures]);
        $uncheckedEnergies = $query->fetchAll(PDO::FETCH_ASSOC);
        return $uncheckedEnergies;
    }
    public static function GetEnergies($pdo)
    { //récup toute les énergie
        $sql = "SELECT * FROM Energies";
        $query = $pdo->prepare($sql);
        $query->execute();
        $energies = $query->fetchAll(PDO::FETCH_ASSOC);
        return $energies;
    }
} // héritage consommer par rapport Energies
class consommer extends Energies
{
    private int $Id_Energies;
    private int $Id_Voitures;

    private function GetId_Energies()
    {
        return $this->Id_Energies;
    }
    private function GetId_Modeles()
    {
        return $this->Id_Voitures;
    }
    private function SetId_Energies($Id_Energies)
    {
        $this->Id_Energies = $Id_Energies;
    }
    private function SetId_Voitures($Id_Voitures)
    {
        $this->Id_Voitures = $Id_Voitures;
    }
    public function __construct($Id_Energies, $Id_Voitures)
    {
        $this->SetId_Energies($Id_Energies);
        $this->SetId_Voitures($Id_Voitures);
    }
    public static function CreateConsommer($pdo, $Id_Energies, $Id_Voitures)
    { //insertion énergie
        $sql = "INSERT INTO consommer (Id_Energies, Id_Voitures) VALUES (:Id_Energies, :Id_Voitures)";
        $query = $pdo->prepare($sql);
        $query->execute(['Id_Energies' => $Id_Energies, 'Id_Voitures' => $Id_Voitures]);
    }
    public static function DeleteAllForCar($pdo, $Id_Voitures)
    { // Effacé toute les donné par rapport ID
        $sql = "DELETE FROM consommer WHERE Id_Voitures = :Id_Voitures";
        $query = $pdo->prepare($sql);
        $query->execute(['Id_Voitures' => $Id_Voitures]);
    }
}

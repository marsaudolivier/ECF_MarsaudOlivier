<?php
class Annonces
{
    public string $titre;
    public DateTime $date_publication;
    public int $Id_Annonces;
    public int $Id_Voitures;

    public function GetTitre()
    {
        return $this->titre;
    }
    public function GetDate_Publication()
    {
        return $this->date_publication;
    }
    public function GetId_Annonces()
    {
        return $this->Id_Annonces;
    }
    public function GetId_Voitures()
    {
        return $this->Id_Voitures;
    }
    public function SetTitre($titre)
    {
        $this->titre = $titre;
    }
    public function SetDate_Publication($date_publication)
    {
        $this->date_publication = $date_publication;
    }
    public function SetId_Annonces($Id_Annonces)
    {
        $this->Id_Annonces = $Id_Annonces;
    }
    public function SetId_Voitures($Id_Voitures)
    {
        $this->Id_Voitures = $Id_Voitures;
    }
    public function __construct($titre, $date_publication, $Id_Annonces, $Id_Voitures)
    {
        $this->SetTitre($titre);
        $this->SetDate_Publication($date_publication);
        $this->SetId_Annonces($Id_Annonces);
        $this->SetId_Voitures($Id_Voitures);
    }
    public static function GetAnnonces($pdo) {
        $sql = "SELECT * FROM Annonces 
        INNER JOIN Voitures v on Annonces.Id_Voitures = v.Id_Voitures";
        $query = $pdo->prepare($sql);
        $query->execute();
        $Annonces = $query->fetchAll(PDO::FETCH_ASSOC);
        return $Annonces;
    }
    public static function GetAnnonce($pdo, $Id_Annonces) {
        $sql = "SELECT * FROM Annonces 
        INNER JOIN Voitures v on Annonces.Id_Voitures = v.Id_Voitures
        INNER JOIN Marques m on v.Id_Marques = m.Id_Marques
        INNER JOIN Modeles mo on m.Id_Marques = mo.Id_Marques
        INNER JOIN Photos p on v.Id_Voitures = p.Id_Voitures
        INNER JOIN consommer c on mo.Id_Modeles = c.Id_Modeles
        INNER JOIN Energies e on c.Id_Energies = e.Id_Energies
        INNER JOIN avoir a on mo.Id_Modeles = a.Id_Modeles
        WHERE Id_Annonces = :Id_Annonces";
        $query = $pdo->prepare($sql);
        $query->bindValue(':Id_Annonces', $Id_Annonces, PDO::PARAM_INT);
        $query->execute();
        $Annonces = $query->fetch(PDO::FETCH_ASSOC);
        $options = $query->fetchAll(PDO::FETCH_COLUMN);
        return $Annonces;
    }
    public static function DeleteAnnonce($pdo, $Id_Annonces) {
        $sql = "DELETE FROM Annonces WHERE Id_Annonces = :Id_Annonces";
        $query = $pdo->prepare($sql);
        $query->bindValue(':Id_Annonces', $Id_Annonces, PDO::PARAM_INT);
        $query->execute();
    }
    public static function UpdateAnnonce($pdo, $titre, $date_publication, $Id_Annonces, $Id_Voitures) {
        $sql = "UPDATE Annonces SET titre = :titre, date_publication = :date_publication, Id_Voitures = :Id_Voitures WHERE Id_Annonces = :Id_Annonces";
        $query = $pdo->prepare($sql);
        $query->bindValue(':Id_Annonces', $Id_Annonces, PDO::PARAM_INT);
        $query->bindValue(':Id_Voitures', $Id_Voitures, PDO::PARAM_INT);
        $query->bindValue(':titre', $titre, PDO::PARAM_STR);
        $query->bindValue(':date_publication', $date_publication, PDO::PARAM_STR);
        $query->execute();
    }
    public static function CreateAnnonce($pdo, $titre, $date_publication, $Id_Voitures) {
        $sql = "INSERT INTO Annonces (titre, date_publication, Id_Voitures) VALUES (:titre, :date_publication, :Id_Voitures)";
        $query = $pdo->prepare($sql);
        $query->bindValue(':titre', $titre, PDO::PARAM_STR);
        $query->bindValue(':date_publication', $date_publication, PDO::PARAM_STR);
        $query->bindValue(':Id_Voitures', $Id_Voitures, PDO::PARAM_INT);
        $query->execute();
    }
}


class Voitures extends Annonces
{
    public int $kilometrage;
    public string $annee;
    public int $prix;
    public string $photo_principal;
    public int $Id_Voitures;
    public int $Id_Marques;

    public function GetKilometrage()
    {
        return $this->kilometrage;
    }
    public function GetAnnee()
    {
        return $this->annee;
    }
    public function GetPrix()
    {
        return $this->prix;
    }
    public function GetPhoto_Principal()
    {
        return $this->photo_principal;
    }
    public function GetId_Voitures()
    {
        return $this->Id_Voitures;
    }
    public function GetId_Marques()
    {
        return $this->Id_Marques;
    }
    public function SetKilometrage($kilometrage)
    {
        $this->kilometrage = $kilometrage;
    }
    public function SetAnnee($annee)
    {
        $this->annee = $annee;
    }
    public function SetPrix($prix)
    {
        $this->prix = $prix;
    }
    public function SetPhoto_Principal($photo_principal)
    {
        $this->photo_principal = $photo_principal;
    }
    public function SetId_Voitures($Id_Voitures)
    {
        $this->Id_Voitures = $Id_Voitures;
    }
    public function SetId_Marques($Id_Marques)
    {
        $this->Id_Marques = $Id_Marques;
    }
    public function __construct($kilometrage, $annee, $prix, $photo_principal, $Id_Voitures, $Id_Marques)
    {
        $this->SetKilometrage($kilometrage);
        $this->SetAnnee($annee);
        $this->SetPrix($prix);
        $this->SetPhoto_Principal($photo_principal);
        $this->SetId_Voitures($Id_Voitures);
        $this->SetId_Marques($Id_Marques);
    }
    public static function UpdateVehicule($pdo, $kilometrage, $annee, $prix,  $photo_principal, $Id_Voitures, $Id_Marques)
    {
        $sql = "UPDATE Voitures SET kilometrage = :kilometrage, annee = :annee, prix = :prix, photo_principal = :photo_principal, Id_Voitures = :Id_Voitures, Id_Marques = :Id_Marques WHERE Id_Voitures = :Id_Voitures";
        $query = $pdo->prepare($sql);
        $query->bindValue(':kilometrage', $kilometrage, PDO::PARAM_INT);
        $query->bindValue(':annee', $annee, PDO::PARAM_STR);
        $query->bindValue(':prix', $prix, PDO::PARAM_INT);
        $query->bindValue(':photo_principal', $photo_principal, PDO::PARAM_STR);
        $query->bindValue(':Id_Voitures', $Id_Voitures, PDO::PARAM_INT);
        $query->bindValue(':Id_Marques', $Id_Marques, PDO::PARAM_INT);
        $query->execute();
    }
}
class Marques extends Voitures
{
    public string $marque;
    public int $Id_Marques;

    public function GetNom()
    {
        return $this->marque;
    }
    public function GetId_Marques()
    {
        return $this->Id_Marques;
    }
    public function SetNom($marque)
    {
        $this->marque = $marque;
    }
    public function SetId_Marques($Id_Marques)
    {
        $this->Id_Marques = $Id_Marques;
    }
    public function __construct($marque, $Id_Marques)
    {
        $this->SetNom($marque);
        $this->SetId_Marques($Id_Marques);
    }
    public static function AddMarque($pdo, $marque){
        $sql = "INSERT INTO Marques (marque) VALUES (:marque)";
        $query = $pdo->prepare($sql);
        $query->execute(['marque' => $marque]);
    }
    public static function DeleteMarque($pdo, $Id_Marques){
        $sql = "DELETE FROM Marques WHERE Id_Marques = :Id_Marques";
        $query = $pdo->prepare($sql);
        $query->execute(['Id_Marques' => $Id_Marques]);
    }
    public static function GetMarques($pdo){
        $sql = "SELECT * FROM Marques";
        $query = $pdo->prepare($sql);
        $query->execute();
        $marques = $query->fetchAll(PDO::FETCH_ASSOC);
        return $marques;
    }
}
class Photos extends Voitures
{
    public string $photo_secondaire;
    public int $Id_Photos;
    public int $Id_Voitures;

    public function GetPhotoSecondaire()
    {
        return $this->photo_secondaire;
    }
    public function GetId_Photos()
    {
        return $this->Id_Photos;
    }
    public function GetId_Voitures()
    {
        return $this->Id_Voitures;
    }
    public function SetPhoto($photo_secondaire)
    {
        $this->photo_secondaire = $photo_secondaire;
    }
    public function SetId_Photos($Id_Photos)
    {
        $this->Id_Photos = $Id_Photos;
    }
    public function SetId_Voitures($Id_Voitures)
    {
        $this->Id_Voitures = $Id_Voitures;
    }
    public function __construct($photo_secondaire, $Id_Photos, $Id_Voitures)
    {
        $this->SetPhoto($photo_secondaire);
        $this->SetId_Photos($Id_Photos);
        $this->SetId_Voitures($Id_Voitures);
    }
    public static function AddPhoto($pdo, $photo_secondaire, $Id_Voitures){
        $sql = "INSERT INTO Photos (photo_secondaire, Id_Voitures) VALUES (:photo_secondaire, :Id_Voitures)";
        $query = $pdo->prepare($sql);
        $query->execute(['photo_secondaire' => $photo_secondaire, 'Id_Voitures' => $Id_Voitures]);
    }
    public static function DeletePhoto($pdo, $Id_Photos){
        $sql = "DELETE FROM Photos WHERE Id_Photos = :Id_Photos";
        $query = $pdo->prepare($sql);
        $query->execute(['Id_Photos' => $Id_Photos]);
    }
    public static function GetPhotos($pdo){
        $sql = "SELECT * FROM Photos";
        $query = $pdo->prepare($sql);
        $query->execute();
        $photos = $query->fetchAll(PDO::FETCH_ASSOC);
        return $photos;
    }
}
class Modeles extends Marques
{
    public string $modele;
    public int $Id_Modeles;
    public int $Id_Marques;

    public function GetModele()
    {
        return $this->modele;
    }
    public function GetId_Modeles()
    {
        return $this->Id_Modeles;
    }
    public function GetId_Marques()
    {
        return $this->Id_Marques;
    }
    public function SetModele($modele)
    {
        $this->modele = $modele;
    }
    public function SetId_Modeles($Id_Modeles)
    {
        $this->Id_Modeles = $Id_Modeles;
    }
    public function SetId_Marques($Id_Marques)
    {
        $this->Id_Marques = $Id_Marques;
    }
    public function __construct($modele, $Id_Modeles, $Id_Marques)
    {
        $this->SetModele($modele);
        $this->SetId_Modeles($Id_Modeles);
        $this->SetId_Marques($Id_Marques);
    }
    public static function AddModele($pdo, $modele, $Id_Marques){
        $sql = "INSERT INTO Modeles (modele, Id_Marques) VALUES (:modele, :Id_Marques)";
        $query = $pdo->prepare($sql);
        $query->execute(['modele' => $modele, 'Id_Marques' => $Id_Marques]);
    }
    public static function DeleteModele($pdo, $Id_Modeles){
        $sql = "DELETE FROM Modeles WHERE Id_Modeles = :Id_Modeles";
        $query = $pdo->prepare($sql);
        $query->execute(['Id_Modeles' => $Id_Modeles]);
    }
    public static function GetModeles($pdo){
        $sql = "SELECT * FROM Modeles";
        $query = $pdo->prepare($sql);
        $query->execute();
        $modeles = $query->fetchAll(PDO::FETCH_ASSOC);
        return $modeles;
    }
}
class avoir extends Modeles{
    public int $Id_Modeles;
    public int $Id_Options;

    public function GetId_Modeles()
    {
        return $this->Id_Modeles;
    }
    public function GetId_Options()
    {
        return $this->Id_Options;
    }
    public function SetId_Modeles($Id_Modeles)
    {
        $this->Id_Modeles = $Id_Modeles;
    }
    public function SetId_Options($Id_Options)
    {
        $this->Id_Options = $Id_Options;
    }
    public function __construct($Id_Modeles, $Id_Options)
    {
        $this->SetId_Modeles($Id_Modeles);
        $this->SetId_Options($Id_Options);
    }
    //Add option par rapport annonces
    public static function AddOption($pdo, $Id_Modeles, $Id_Options){
        $sql = "INSERT INTO avoir (Id_Modeles, Id_Options) VALUES (:Id_Modeles, :Id_Options)";
        $query = $pdo->prepare($sql);
        $query->execute(['Id_Modeles' => $Id_Modeles, 'Id_Options' => $Id_Options]);
    }
    //Delete option par rapport annonces
    public static function DeleteOption($pdo, $Id_Modeles, $Id_Options){
        $sql = "DELETE FROM avoir WHERE Id_Modeles = :Id_Modeles AND Id_Options = :Id_Options";
        $query = $pdo->prepare($sql);
        $query->execute(['Id_Modeles' => $Id_Modeles, 'Id_Options' => $Id_Options]);
    }
}
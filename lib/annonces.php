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
    //Récupération de toute les annonces
    public static function GetAnnonces($pdo)
    {
        $sql = "SELECT * FROM Annonces 
        INNER JOIN Voitures v on Annonces.Id_Voitures = v.Id_Voitures
        left JOIN Marques m on v.Id_Marques = m.Id_Marques
        left JOIN Modeles mo on v.Id_Modeles = mo.Id_Modeles
";
        $query = $pdo->prepare($sql);
        $query->execute();
        $Annonces = $query->fetchAll(PDO::FETCH_ASSOC);
        return $Annonces;
    }
    public static function GetAnnonce($pdo, $Id_Annonces)
    { // récupération annonce par ID avec jointure marque et modele
        $sql = "SELECT * FROM Annonces 
        INNER JOIN Voitures v on Annonces.Id_Voitures = v.Id_Voitures
        left JOIN Marques m on v.Id_Marques = m.Id_Marques
        left JOIN Modeles mo on v.Id_Modeles = mo.Id_Modeles
        WHERE Id_Annonces = :Id_Annonces";
        $query = $pdo->prepare($sql);
        $query->bindValue(':Id_Annonces', $Id_Annonces, PDO::PARAM_INT);
        $query->execute();
        $Annonces = $query->fetch(PDO::FETCH_ASSOC);
        return $Annonces;
    }
    public static function DeleteAnnonce($pdo, $Id_Annonces)
    { // Fonction effacé annonces avec ID
        $sql = "DELETE FROM Annonces WHERE Id_Annonces = :Id_Annonces";
        $query = $pdo->prepare($sql);
        $query->bindValue(':Id_Annonces', $Id_Annonces, PDO::PARAM_INT);
        $query->execute();
    }
    public static function UpdateAnnonce($pdo, $titre, $date_publication, $Id_Annonces, $Id_Voitures)
    { // Fonction pour la mise a jour des annonces
        $sql = "UPDATE Annonces SET titre = :titre, date_publication = :date_publication, Id_Voitures = :Id_Voitures WHERE Id_Annonces = :Id_Annonces";
        $query = $pdo->prepare($sql);
        $query->bindValue(':Id_Annonces', $Id_Annonces, PDO::PARAM_INT);
        $query->bindValue(':Id_Voitures', $Id_Voitures, PDO::PARAM_INT);
        $query->bindValue(':titre', $titre, PDO::PARAM_STR);
        $query->bindValue(':date_publication', $date_publication, PDO::PARAM_STR);
        $query->execute();
    }
    public static function CreateAnnonce($pdo, $titre, $date_publication, $Id_Voitures)
    { //function pour la création annonces
        $sql = "INSERT INTO Annonces (titre, date_publication, Id_Voitures) VALUES (:titre, :date_publication, :Id_Voitures)";
        $query = $pdo->prepare($sql);
        $query->bindValue(':titre', $titre, PDO::PARAM_STR);
        $query->bindValue(':date_publication', $date_publication, PDO::PARAM_STR);
        $query->bindValue(':Id_Voitures', $Id_Voitures, PDO::PARAM_INT);
        $query->execute();
    }
}

// usage de l'héritage pour ma table voitures
class Voitures extends Annonces
{
    public int $kilometrage;
    public string $annee;
    public int $prix;
    public string $photo_principal;
    public int $Id_Voitures;
    public int $Id_Marques;
    public int $Id_Modeles;

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
    public function GetId_Modeles()
    {
        return $this->Id_Modeles;
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
    public function SetId_Modeles($Id_Modeles)
    {
        $this->Id_Modeles = $Id_Modeles;
    }
    public function __construct($kilometrage, $annee, $prix, $photo_principal, $Id_Voitures, $Id_Marques, $Id_Modeles)
    {
        $this->SetKilometrage($kilometrage);
        $this->SetAnnee($annee);
        $this->SetPrix($prix);
        $this->SetPhoto_Principal($photo_principal);
        $this->SetId_Voitures($Id_Voitures);
        $this->SetId_Marques($Id_Marques);
        $this->SetId_Modeles($Id_Modeles);
    }
    public static function GetVoitures($pdo)
    { 
        $sql = "SELECT * FROM Voitures";
        $query = $pdo->prepare($sql);
        $query->execute();
        $voitures = $query->fetchAll(PDO::FETCH_ASSOC);
        return $voitures;
    }
    public static function GetVoiture($pdo, $Id_Voitures)
    { //récupération voiture par ID
        $sql = "SELECT * FROM Voitures WHERE Id_Voitures = :Id_Voitures";
        $query = $pdo->prepare($sql);
        $query->bindValue(':Id_Voitures', $Id_Voitures, PDO::PARAM_INT);
        $query->execute();
        $voiture = $query->fetch(PDO::FETCH_ASSOC);
        return $voiture;
    }
    public static function DeleteVoiture($pdo, $Id_Voitures)
    { //délete voiture par id lors delete annonces
        $sql = "DELETE FROM Voitures WHERE Id_Voitures = :Id_Voitures";
        $query = $pdo->prepare($sql);
        $query->bindValue(':Id_Voitures', $Id_Voitures, PDO::PARAM_INT);
        $query->execute();
    }
    public static function CreateVoiture($pdo, $kilometrage, $annee, $prix, $photo_principal, $Id_Marques, $Id_Modeles)
    { //création voiture en même temps que annonces
        $sql = "INSERT INTO Voitures (kilometrage, annee, prix, photo_principal, Id_Marques, Id_Modeles) VALUES (:kilometrage, :annee, :prix, :photo_principal, :Id_Marques, :Id_Modeles)";
        $query = $pdo->prepare($sql);
        $query->bindValue(':kilometrage', $kilometrage, PDO::PARAM_INT);
        $query->bindValue(':annee', $annee, PDO::PARAM_STR);
        $query->bindValue(':prix', $prix, PDO::PARAM_INT);
        $query->bindValue(':photo_principal', $photo_principal, PDO::PARAM_STR);
        $query->bindValue(':Id_Marques', $Id_Marques, PDO::PARAM_INT);
        $query->bindValue(':Id_Modeles', $Id_Modeles, PDO::PARAM_INT);
        $query->execute();
    }
    public static function UpdateVoiture($pdo, $kilometrage, $annee, $prix, $photo_principal, $Id_Voitures, $Id_Marques, $Id_Modeles)
    { //mise a jour de mes voitures
        $sql = "UPDATE Voitures SET kilometrage = :kilometrage, annee = :annee, prix = :prix, photo_principal = :photo_principal, Id_Marques = :Id_Marques, Id_Modeles = :Id_Modeles WHERE Id_Voitures = :Id_Voitures";
        $query = $pdo->prepare($sql);
        $query->bindValue(':kilometrage', $kilometrage, PDO::PARAM_INT);
        $query->bindValue(':annee', $annee, PDO::PARAM_STR);
        $query->bindValue(':prix', $prix, PDO::PARAM_INT);
        $query->bindValue(':photo_principal', $photo_principal, PDO::PARAM_STR);
        $query->bindValue(':Id_Voitures', $Id_Voitures, PDO::PARAM_INT);
        $query->bindValue(':Id_Marques', $Id_Marques, PDO::PARAM_INT);
        $query->bindValue(':Id_Modeles', $Id_Modeles, PDO::PARAM_INT);
        $query->execute();
    }
}
//héritage marques par rapport voiture
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
    public static function AddMarque($pdo, $marque)
    { //ajout nouvelle marques
        $sql = "INSERT INTO Marques (marque) VALUES (:marque)";
        $query = $pdo->prepare($sql);
        $query->execute(['marque' => $marque]);
    }
    public static function DeleteMarque($pdo, $Id_Marques)
    {
        $sql = "DELETE FROM Marques WHERE Id_Marques = :Id_Marques";
        $query = $pdo->prepare($sql);
        $query->execute(['Id_Marques' => $Id_Marques]);
    }
    public static function GetMarques($pdo)
    { //récupération de totue les marque
        $sql = "SELECT * FROM Marques";
        $query = $pdo->prepare($sql);
        $query->execute();
        $marques = $query->fetchAll(PDO::FETCH_ASSOC);
        return $marques;
    }
}
//héritage class photos par rapport au voitures
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
    public static function CreatePhoto($pdo, $photo_secondaire, $Id_Voitures)
    { //création de photo secondaire
        $sql = "INSERT INTO Photos (photo_secondaire, Id_Voitures) VALUES (:photo_secondaire, :Id_Voitures)";
        $query = $pdo->prepare($sql);
        $query->execute(['photo_secondaire' => $photo_secondaire, 'Id_Voitures' => $Id_Voitures]);
    }
    public static function DeletePhotoByVoiture($pdo, $Id_Voitures)
    { //delete photo en m$ême temps que delete annonces
        $sql = "DELETE FROM Photos WHERE Id_Voitures = :Id_Voitures";
        $query = $pdo->prepare($sql);
        $query->execute(['Id_Voitures' => $Id_Voitures]);
    }
    public static function GetPhotosByVoitures($pdo, $Id_Voitures)
    { //récupération de photo secondaire par ID voiture
        $sql = "SELECT * FROM Photos WHERE Id_Voitures = :Id_Voitures";
        $query = $pdo->prepare($sql);
        $query->execute(['Id_Voitures' => $Id_Voitures]);
        $photos = $query->fetchAll(PDO::FETCH_ASSOC);
        return $photos;
    }
}
//héritage modèles par rapport a marques
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
    public static function AddModele($pdo, $modele, $Id_Marques)
    { // ajout modele
        $sql = "INSERT INTO Modeles (modele, Id_Marques) VALUES (:modele, :Id_Marques)";
        $query = $pdo->prepare($sql);
        $query->execute(['modele' => $modele, 'Id_Marques' => $Id_Marques]);
    }
    public static function DeleteModele($pdo, $Id_Modeles)
    {
        $sql = "DELETE FROM Modeles WHERE Id_Modeles = :Id_Modeles";
        $query = $pdo->prepare($sql);
        $query->execute(['Id_Modeles' => $Id_Modeles]);
    }
    public static function GetModeles($pdo)
    { //récupération modele
        $sql = "SELECT * FROM Modeles";
        $query = $pdo->prepare($sql);
        $query->execute();
        $modeles = $query->fetchAll(PDO::FETCH_ASSOC);
        return $modeles;
    }
    public static function GetModelesByMarques($pdo, $Id_Marques)
    { //récup modele par marques
        $sql = "SELECT * FROM Modeles WHERE Id_Marques = :Id_Marques";
        $query = $pdo->prepare($sql);
        $query->execute(['Id_Marques' => $Id_Marques]);
        $modeles = $query->fetchAll(PDO::FETCH_ASSOC);
        return $modeles;
    }
    public static function UpdateModele($pdo, $Id_modeles, $Id_Marques)
    { 
        $sql = "UPDATE Modeles SET Id_Marques = :Id_Marques WHERE Id_Modeles = :Id_Modeles";
        $query = $pdo->prepare($sql);
        $query->execute(['Id_Marques' => $Id_Marques, 'Id_Modeles' => $Id_modeles]);
    }
}
//héritage de ma table avoir pour récupéré option par rapport a voitures
class avoir extends Voitures
{
    public int $Id_Options;
    public int $Id_Voitures;

    public function GetId_Options()
    {
        return $this->Id_Options;
    }
    public function GetId_Voitures()
    {
        return $this->Id_Voitures;
    }

    public function SetId_Options($Id_Options)
    {
        $this->Id_Options = $Id_Options;
    }
    public function SetId_Voitures($Id_Voitures)
    {
        $this->Id_Voitures = $Id_Voitures;
    }
    public function __construct($Id_Options, $Id_Voitures)
    {
        $this->SetId_Options($Id_Options);
        $this->SetId_Voitures($Id_Voitures);
    }
    public static function AddOption($pdo, $Id_Options, $Id_Voitures)
    {
        $sql = "INSERT INTO avoir (Id_Options, Id_Voitures) VALUES (:Id_Options, :Id_Voitures)";
        $query = $pdo->prepare($sql);
        $query->execute(['Id_Options' => $Id_Options, 'Id_Voitures' => $Id_Voitures]);
    }
    public static function GetOptions($pdo)
    {
        $sql = "SELECT * FROM avoir";
        $query = $pdo->prepare($sql);
        $query->execute();
        $options = $query->fetchAll(PDO::FETCH_ASSOC);
        return $options;
    }
    public static function DeleteAllForCar($pdo, $Id_Voitures)
    {
        $sql = "DELETE FROM avoir WHERE Id_Voitures = :Id_Voitures";
        $query = $pdo->prepare($sql);
        $query->execute(['Id_Voitures' => $Id_Voitures]);
    }
}

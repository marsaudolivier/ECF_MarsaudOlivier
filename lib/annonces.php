<?php
class Annonces
{
    protected string $titre;
    protected DateTime $date_publication;
    protected int $Id_Annonces;
    protected int $Id_Voitures;

    protected function GetTitre()
    {
        return $this->titre;
    }
    protected function GetDate_Publication()
    {
        return $this->date_publication;
    }
    protected function GetId_Annonces()
    {
        return $this->Id_Annonces;
    }
    protected function GetId_Voitures()
    {
        return $this->Id_Voitures;
    }
    protected function SetTitre($titre)
    {
        $this->titre = $titre;
    }
    protected function SetDate_Publication($date_publication)
    {
        $this->date_publication = $date_publication;
    }
    protected function SetId_Annonces($Id_Annonces)
    {
        $this->Id_Annonces = $Id_Annonces;
    }
    protected function SetId_Voitures($Id_Voitures)
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
}
class Voitures extends Annonces
{
    protected int $kilometrage;
    protected string $annee;
    protected int $prix;
    protected string $photo_principal;
    protected int $Id_Voitures;
    protected int $Id_Marques;

    protected function GetKilometrage()
    {
        return $this->kilometrage;
    }
    protected function GetAnnee()
    {
        return $this->annee;
    }
    protected function GetPrix()
    {
        return $this->prix;
    }
    protected function GetPhoto_Principal()
    {
        return $this->photo_principal;
    }
    protected function GetId_Voitures()
    {
        return $this->Id_Voitures;
    }
    protected function GetId_Marques()
    {
        return $this->Id_Marques;
    }
    protected function SetKilometrage($kilometrage)
    {
        $this->kilometrage = $kilometrage;
    }
    protected function SetAnnee($annee)
    {
        $this->annee = $annee;
    }
    protected function SetPrix($prix)
    {
        $this->prix = $prix;
    }
    protected function SetPhoto_Principal($photo_principal)
    {
        $this->photo_principal = $photo_principal;
    }
    protected function SetId_Voitures($Id_Voitures)
    {
        $this->Id_Voitures = $Id_Voitures;
    }
    protected function SetId_Marques($Id_Marques)
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
}
class Marques extends Voitures
{
    protected string $marque;
    protected int $Id_Marques;

    protected function GetNom()
    {
        return $this->marque;
    }
    protected function GetId_Marques()
    {
        return $this->Id_Marques;
    }
    protected function SetNom($marque)
    {
        $this->marque = $marque;
    }
    protected function SetId_Marques($Id_Marques)
    {
        $this->Id_Marques = $Id_Marques;
    }
    public function __construct($marque, $Id_Marques)
    {
        $this->SetNom($marque);
        $this->SetId_Marques($Id_Marques);
    }
}
class Photos extends Voitures
{
    protected string $photo_secondaire;
    protected int $Id_Photos;
    protected int $Id_Voitures;

    protected function GetPhotoSecondaire()
    {
        return $this->photo_secondaire;
    }
    protected function GetId_Photos()
    {
        return $this->Id_Photos;
    }
    protected function GetId_Voitures()
    {
        return $this->Id_Voitures;
    }
    protected function SetPhoto($photo_secondaire)
    {
        $this->photo_secondaire = $photo_secondaire;
    }
    protected function SetId_Photos($Id_Photos)
    {
        $this->Id_Photos = $Id_Photos;
    }
    protected function SetId_Voitures($Id_Voitures)
    {
        $this->Id_Voitures = $Id_Voitures;
    }
    public function __construct($photo_secondaire, $Id_Photos, $Id_Voitures)
    {
        $this->SetPhoto($photo_secondaire);
        $this->SetId_Photos($Id_Photos);
        $this->SetId_Voitures($Id_Voitures);
    }
}
class Modeles extends Marques
{
    protected string $modele;
    protected int $Id_Modeles;
    protected int $Id_Marques;

    protected function GetModele()
    {
        return $this->modele;
    }
    protected function GetId_Modeles()
    {
        return $this->Id_Modeles;
    }
    protected function GetId_Marques()
    {
        return $this->Id_Marques;
    }
    protected function SetModele($modele)
    {
        $this->modele = $modele;
    }
    protected function SetId_Modeles($Id_Modeles)
    {
        $this->Id_Modeles = $Id_Modeles;
    }
    protected function SetId_Marques($Id_Marques)
    {
        $this->Id_Marques = $Id_Marques;
    }
    public function __construct($modele, $Id_Modeles, $Id_Marques)
    {
        $this->SetModele($modele);
        $this->SetId_Modeles($Id_Modeles);
        $this->SetId_Marques($Id_Marques);
    }
}
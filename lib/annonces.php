<?php
class Annonces{
    private string $titre;
    private DateTime $date_publication;
    private int $Id_Annonces;
    private int $Id_Voitures;

    private function GetTitre(){
        return $this->titre;
    }
    private function GetDate_Publication(){
        return $this->date_publication;
    }
    private function GetId_Annonces(){
        return $this->Id_Annonces;
    }
    private function GetId_Voitures(){
        return $this->Id_Voitures;
    }
    private function SetTitre($titre){
        $this->titre = $titre;
    }
    private function SetDate_Publication($date_publication){
        $this->date_publication = $date_publication;
    }
    private function SetId_Annonces($Id_Annonces){
        $this->Id_Annonces = $Id_Annonces;
    }
    private function SetId_Voitures($Id_Voitures){
        $this->Id_Voitures = $Id_Voitures;
    }
    public function __construct($titre,$date_publication,$Id_Annonces,$Id_Voitures){
        $this->SetTitre($titre);
        $this->SetDate_Publication($date_publication);
        $this->SetId_Annonces($Id_Annonces);
        $this->SetId_Voitures($Id_Voitures);
    }
}
class Voitures extends Annonces{
    private int $kilometrage;
    private string $annee;
    private int $prix;
    private string $photo_principal;
    private int $Id_Voitures;
    private int $Id_Marques;

    private function GetKilometrage(){
        return $this->kilometrage;
    }
    private function GetAnnee(){
        return $this->annee;
    }
    private function GetPrix(){
        return $this->prix;
    }
    private function GetPhoto_Principal(){
        return $this->photo_principal;
    }
    private function GetId_Voitures(){
        return $this->Id_Voitures;
    }
    private function GetId_Marques(){
        return $this->Id_Marques;
    }
    private function SetKilometrage($kilometrage){
        $this->kilometrage = $kilometrage;
    }
    private function SetAnnee($annee){
        $this->annee = $annee;
    }
    private function SetPrix($prix){
        $this->prix = $prix;
    }
    private function SetPhoto_Principal($photo_principal){
        $this->photo_principal = $photo_principal;
    }
    private function SetId_Voitures($Id_Voitures){
        $this->Id_Voitures = $Id_Voitures;
    }
    private function SetId_Marques($Id_Marques){
        $this->Id_Marques = $Id_Marques;
    }
    public function __construct($kilometrage,$annee,$prix,$photo_principal,$Id_Voitures,$Id_Marques){
        $this->SetKilometrage($kilometrage);
        $this->SetAnnee($annee);
        $this->SetPrix($prix);
        $this->SetPhoto_Principal($photo_principal);
        $this->SetId_Voitures($Id_Voitures);
        $this->SetId_Marques($Id_Marques);
    }
}
class Marques extends Voitures{
    private string $marque;
    private int $Id_Marques;

    private function GetNom(){
        return $this->marque;
    }
    private function GetId_Marques(){
        return $this->Id_Marques;
    }
    private function SetNom($marque){
        $this->marque = $marque;
    }
    private function SetId_Marques($Id_Marques){
        $this->Id_Marques = $Id_Marques;
    }
    public function __construct($marque,$Id_Marques){
        $this->SetNom($marque);
        $this->SetId_Marques($Id_Marques);
    }
}
class Photos extends Voitures{
    private string $photo_secondaire;
    private int $Id_Photos;
    private int $Id_Voitures;

    private function GetPhotoSecondaire(){
        return $this->photo_secondaire;
    }
    private function GetId_Photos(){
        return $this->Id_Photos;
    }
    private function GetId_Voitures(){
        return $this->Id_Voitures;
    }
    private function SetPhoto($photo_secondaire){
        $this->photo_secondaire = $photo_secondaire;
    }
    private function SetId_Photos($Id_Photos){
        $this->Id_Photos = $Id_Photos;
    }
    private function SetId_Voitures($Id_Voitures){
        $this->Id_Voitures = $Id_Voitures;
    }
    public function __construct($photo_secondaire,$Id_Photos,$Id_Voitures){
        $this->SetPhoto($photo_secondaire);
        $this->SetId_Photos($Id_Photos);
        $this->SetId_Voitures($Id_Voitures);
    }
}
class Modeles extends Marques{
    private string $modele;
    private int $Id_Modeles;
    private int $Id_Marques;

    private function GetModele(){
        return $this->modele;
    }
    private function GetId_Modeles(){
        return $this->Id_Modeles;
    }
    private function GetId_Marques(){
        return $this->Id_Marques;
    }
    private function SetModele($modele){
        $this->modele = $modele;
    }
    private function SetId_Modeles($Id_Modeles){
        $this->Id_Modeles = $Id_Modeles;
    }
    private function SetId_Marques($Id_Marques){
        $this->Id_Marques = $Id_Marques;
    }
    public function __construct($modele,$Id_Modeles,$Id_Marques){
        $this->SetModele($modele);
        $this->SetId_Modeles($Id_Modeles);
        $this->SetId_Marques($Id_Marques);
    }
}
class consommer extends Modeles{
    private int $Id_Modeles;
    private int $Id_Energies;

    private function GetId_Modeles(){
        return $this->Id_Modeles;
    }
    private function GetId_Energies(){
        return $this->Id_Energies;
    }
    private function SetId_Modeles($Id_Modeles){
        $this->Id_Modeles = $Id_Modeles;
    }
    private function SetId_Energies($Id_Energies){
        $this->Id_Energies = $Id_Energies;
    }
    public function __construct($Id_Modeles,$Id_Energies){
        $this->SetId_Modeles($Id_Modeles);
        $this->SetId_Energies($Id_Energies);
    }
}
class Energies extends consommer{
    private string $energie;
    private int $Id_Energies;

    private function GetEnergie(){
        return $this->energie;
    }
    private function GetId_Energies(){
        return $this->Id_Energies;
    }
    private function SetEnergie($energie){
        $this->energie = $energie;
    }
    private function SetId_Energies($Id_Energies){
        $this->Id_Energies = $Id_Energies;
    }
    public function __construct($energie,$Id_Energies){
        $this->SetEnergie($energie);
        $this->SetId_Energies($Id_Energies);
    }
}
class avoir extends Modeles{
    private int $Id_Modeles;
    private int $Id_Options;

    private function GetId_Modeles(){
        return $this->Id_Modeles;
    }
    private function GetId_Option(){
        return $this->Id_Options;
    }
    private function SetId_Modeles($Id_Modeles){
        $this->Id_Modeles = $Id_Modeles;
    }
    private function SetId_Option($Id_Options){
        $this->Id_Options = $Id_Options;
    }
    public function __construct($Id_Modeles,$Id_Options){
        $this->SetId_Modeles($Id_Modeles);
        $this->SetId_Option($Id_Options);
    }
}
class Options extends avoir{
    private string $option;
    private int $Id_Options;

    private function GetOption(){
        return $this->option;
    }
    private function GetId_Options(){
        return $this->Id_Options;
    }
    private function SetOption($option){
        $this->option = $option;
    }
    private function SetId_Options($Id_Options){
        $this->Id_Options = $Id_Options;
    }
    public function __construct($option,$Id_Options){
        $this->SetOption($option);
        $this->SetId_Options($Id_Options);
    }
}
class publier extends Annonces{
    private int $Id_Annonces;
    private int $Id_Utilisateurs;

    private function GetId_Annonces(){
        return $this->Id_Annonces;
    }
    private function GetId_Utilisateurs(){
        return $this->Id_Utilisateurs;
    }
    private function SetId_Annonces($Id_Annonces){
        $this->Id_Annonces = $Id_Annonces;
    }
    private function SetId_Utilisateurs($Id_Utilisateurs){
        $this->Id_Utilisateurs = $Id_Utilisateurs;
    }
    public function __construct($Id_Annonces,$Id_Utilisateurs){
        $this->SetId_Annonces($Id_Annonces);
        $this->SetId_Utilisateurs($Id_Utilisateurs);
    }
}
<?php
Class utilisateurs{
    private $id;
    public string $nom;
    public string $prenom;
    public string $mail;
    public string $mdp;
    public int $Id_Roles;

    public function GetId(){
        return $this->id;
    }
    public function GetNom(){
        return $this->nom;
    }
    public function GetPrenom(){
        return $this->prenom;
    }
    public function GetMail(){
        return $this->mail;
    }
    public function GetMdp(){
        return $this->mdp;
    }
    public function GetId_Roles(){
        return $this->Id_Roles;
    }
    //SETTERS
    public function SetId($id){
        $this->id = $id;
    }
    public function SetNom($nom){
        $this->nom = $nom;
    }
    public function SetPrenom($prenom){
        $this->prenom = $prenom;
    }
    public function SetMail($mail){
        $this->mail = $mail;
    }
    public function SetMdp($mdp){
        $this->mdp = $mdp;
    }
    public function SetId_Roles($Id_Roles){
        $this->Id_Roles = $Id_Roles;
    }
    public function __construct($nom, $prenom, $mail, $mdp, $Id_Roles){
        $this->SetNom($nom);
        $this->SetPrenom($prenom);
        $this->SetMail($mail);
        $this->SetMdp($mdp);
        $this->SetId_Roles($Id_Roles);
    }
    public static function GetAllUsers($pdo) {
       $sql = "SELECT * FROM Utilisateurs INNER JOIN Roles r on Utilisateurs.Id_Roles = r.Id_Roles";
       $stmt = $pdo->prepare($sql);
       $stmt->execute();
         $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $users;
    }
    public static function DeleteUser($pdo, $id) {
        $sql = "DELETE FROM Utilisateurs WHERE Id_Utilisateurs = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
    }
    public function insertUser($user, $pdo){ 
        $sql = "INSERT INTO Utilisateurs (nom, prenom, mail, mdp, Id_Roles) VALUES (:nom, :prenom, :mail, :mdp, :Id_Roles)";
        $stmt = $pdo->prepare($sql);
    
        // Liage des valeurs
        $stmt->bindValue(':nom', $user->GetNom());
        $stmt->bindValue(':prenom', $user->GetPrenom());
        $stmt->bindValue(':mail', $user->GetMail());
        $stmt->bindValue(':mdp', $user->GetMdp());
        $stmt->bindValue(':Id_Roles', $user->GetId_Roles());
    
        // Execution de la requête
        $stmt->execute();
    }
     public static function UpdateUser($pdo, $user) {
        $sql = "UPDATE Utilisateurs SET nom = :nom, prenom = :prenom, mail = :mail, mdp = :mdp, Id_Roles = :Id_Roles WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $user->GetId());
        $stmt->bindValue(':nom', $user->GetNom());
        $stmt->bindValue(':prenom', $user->GetPrenom());
        $stmt->bindValue(':mail', $user->GetMail());
        $stmt->bindValue(':mdp', $user->GetMdp());
        $stmt->bindValue(':Id_Roles', $user->GetId_Roles());
        $stmt->execute();
    }

}
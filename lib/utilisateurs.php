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
        //ajout hash pass sur le constructeur
        $mdp = password_hash($mdp, PASSWORD_DEFAULT);
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
        $sql = "INSERT INTO Utilisateurs (nom, prenom, mail, mdp, Id_Roles, token) VALUES (:nom, :prenom, :mail, :mdp, :Id_Roles, '')";
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
    public function verifyPassword($password) {
        return password_verify($password, $this->GetMdp());
    }
    public static function loginUser($pdo, $mail, $password) {
        $sql = "SELECT * FROM Utilisateurs WHERE mail = :mail";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':mail', $mail);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && $user['mail'] === $mail && $user['mdp'] && password_verify($password, $user['mdp'])) {
            return $user; 
        }

        return null;  // L'authentification a échoué
    }
    public static function tokenAdd($pdo, $token, $password, $mail){
        $sql="UPDATE Utilisateurs SET token = '$token' WHERE '$mail' = mail";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        }
        public static function UtilisateurVerificationToken($pdo, $mail, $token) {
            $sql = "SELECT * FROM Utilisateurs WHERE mail = :mail AND token = :token";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':mail', $mail);
            $stmt->bindValue(':token', $token);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
            if ($user && $user['mail'] === $mail && $user['token'] === $token) {
                return $user; 
            }
        
            return null;  // L'authentification a échoué
        }

}
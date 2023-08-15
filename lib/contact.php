<?php 
Class Contact{
    public string $nom;
    public string $prenom;
    public string $mail;
    public string $telephone;
    public string $message;
    public int $Id_Motifs;

    public function GetNom(){
        return $this->nom;
    }
    public function GetPrenom(){
        return $this->prenom;
    }
    public function GetMail(){
        return $this->mail;
    }
    public function GetTelephone(){
        return $this->telephone;
    }
    public function GetMessage(){
        return $this->message;
    }
    public function GetId_Motifs(){
        return $this->Id_Motifs;
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
    public function SetTelephone($telephone){
        $this->telephone = $telephone;
    }
    public function SetMessage($message){
        $this->message = $message;
    }
    public function SetId_Motifs($Id_Motifs){
        $this->Id_Motifs = $Id_Motifs;
    }
    public function __construct($nom, $prenom, $mail, $telephone, $message, $Id_Motifs){
        $this->SetNom($nom);
        $this->SetPrenom($prenom);
        $this->SetMail($mail);
        $this->SetTelephone($telephone);
        $this->SetMessage($message);
        $this->SetId_Motifs($Id_Motifs);
    }


    public function insertContact($contact){
        require_once('pdo.php'); 
        global $pdo;
        $sql = "INSERT INTO Formulaires (nom, prenom, mail, telephone, message, Id_Motifs) VALUES (:nom, :prenom, :mail, :telephone, :message, :Id_Motifs)";
        
        $stmt = $pdo->prepare($sql);
    
        // Liage des valeurs
        $stmt->bindParam(':nom', $contact->GetNom());
        $stmt->bindParam(':prenom', $contact->GetPrenom());
        $stmt->bindParam(':mail', $contact->GetMail());
        $stmt->bindParam(':telephone', $contact->GetTelephone());
        $stmt->bindParam(':message', $contact->GetMessage());
        $stmt->bindParam(':Id_Motifs', $contact->GetId_Motifs());
    
        try {
            $stmt->execute();
            echo "Votre message a bien été enregistré";
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }
}
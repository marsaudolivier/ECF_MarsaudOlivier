<?php 
Class Contact{
    public string $nom;
    public string $prenom;
    public string $mail;
    public string $telephone;
    public string $message;
    public int $Id_Motifs;
    public int $Id_FormulairesOk;

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
    public function GetId_FormulairesOk(){
        return $this->Id_FormulairesOk;
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
    public function SetId_FormulairesOk($Id_FormulairesOk){
        $this->Id_FormulairesOk = $Id_FormulairesOk;
    }
    public function __construct($nom, $prenom, $mail, $telephone, $message, $Id_Motifs,$Id_FormulairesOk){
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->mail = $mail;
        $this->telephone = $telephone;
        $this->message = $message;
        $this->Id_Motifs = $Id_Motifs;
        $this->Id_FormulairesOk = $Id_FormulairesOk;
    }


    public function insertContact($contact, $pdo){ 
        $sql = "INSERT INTO Formulaires (nom, prenom, mail, telephone, message, Id_Motifs, Id_FormulairesOk) VALUES (:nom, :prenom, :mail, :telephone, :message, :Id_Motifs, :Id_FormulairesOk)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nom', $contact->GetNom());
        $stmt->bindParam(':prenom', $contact->GetPrenom());
        $stmt->bindParam(':mail', $contact->GetMail());
        $stmt->bindParam(':telephone', $contact->GetTelephone());
        $stmt->bindParam(':message', $contact->GetMessage());
        $stmt->bindParam(':Id_Motifs', $contact->GetId_Motifs());
        $stmt->bindParam(':Id_FormulairesOk', $contact->GetId_FormulairesOk());
        try {
            $stmt->execute();
            echo "Votre message a bien été enregistré";
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }
    public static function GetAll($pdo){
        $sql = "SELECT * FROM Formulaires  
        INNER JOIN Motifs m on Formulaires.Id_Motifs = m.Id_Motifs
        INNER JOIN FormulairesOk f on Formulaires.Id_FormulairesOk = f.Id_FormulairesOk
        ORDER BY Formulaires.Id_Formulaires DESC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $contacts;
    }
    public static function deleteContact($pdo, $Id_Contact){
        $sql = "DELETE FROM Formulaires WHERE Id_Formulaires = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $Id_Contact);
        try {
            $stmt->execute();
            echo "Le message a bien été supprimé";
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }
    public static function UpdateState($pdo, $contactId, $newState) {
        $query = "UPDATE Formulaires SET Id_FormulairesOk = :Id_FormulairesOk WHERE Id_Formulaires = :contactId";
        $statement = $pdo->prepare($query);
        $statement->bindParam(':Id_FormulairesOk', $newState, PDO::PARAM_STR);
        $statement->bindParam(':contactId', $contactId, PDO::PARAM_INT);
        $statement->execute();
    }
 }

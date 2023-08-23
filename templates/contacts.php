<?php
require_once('./lib/contact.php');
require_once('./lib/pdo.php');

function Contacts(){
   ?> <div class="p-2">
      <div class="justify-content-center index_text p-2">
        <h2>NOUS CONTACTER</h2>
        <div>
          <form enctype="multipart/form-data" method="POST">
          <div class="FormulaireContact">
            <label for="nom" class="text-primary">Nom:</label>
            <input type="text" id="nom" name="nom" />
            <label for="prenom" class="text-primary">Prenom:</label>
            <input type="text" id="prenom" name="prenom" />
          </div>
          <div class="FormulaireContact">
            <label for="mail" class="text-primary">Email:</label>
            <input type="text" id="mail" name="mail" />
            <label for="telephone" class="text-primary">Telephone:</label>
            <input type="text" id="telephone" name="telephone" />
          </div>
          <div class="FormulaireContact">
            <label for="Id_Motifs" class="text-primary">Votre demande:</label>
            <select id="Id_Motifs" name="Id_Motifs" class="text-primary">
              <option value="1">Mécanique auto</option>
              <option value="2">Mécanique auto</option>
              <option value="3">Carrosserie</option>
              <option value="4">Peinture</option>
              <option value="5">Vehicule à vendre</option>
              <option value="6">Autre</option>
            </select>
          </div>
          <div class="p-2 FormulaireContact2">
            <label for="message">message:</label>
            <textarea id="message" name="message"></textarea>
          </div>
          <button type="submit" name="Contact" class="ventes_bouton btn btn-primary"> VALIDER</button>

        </div>
          </form>
          
      </div>
    </div>
    <?php
    require('./lib/pdo.php');
    if(isset($_POST['Contact'])){
      $nom = $_POST['nom'];
      $prenom = $_POST['prenom'];
      $mail = $_POST['mail'];
      $telephone = $_POST['telephone'];
      $Id_Motifs = $_POST['Id_Motifs'];
      $message = $_POST['message'];
      $contact = new Contact($nom,$prenom,$mail,$telephone,$message,$Id_Motifs);
      $contact->insertContact($contact, $pdo);
    
    }

}
function VoirContact($pdo){
  if (isset($_POST["deleteContactButton"])) {
    $Id_Contact = $_POST['Id_ContactToDelete']; 
    Contact::deleteContact($pdo, $Id_Contact);
    header("Location: adminContacts.php");
    exit;
  }
  $contacts = Contact::GetAll($pdo);
  foreach ($contacts as $contact) { ?>
  <div class="index_text p-1">
    <div class="index_text">
      <h3 class="p-4">contact: <?= $contact['Id_Formulaires'] ?></h3>
      <h3>Motif de contact!  <?= $contact['motif'] ?></h3>
    </div>
    <div class="p-2">
      MR ou MME <?= $contact['nom'] ?>  <?= $contact['prenom'] ?>
      </p>
      <p>Adresse Mail:  <?= $contact['mail'] ?></p>
      <p>Numéro de téléphone:   <?= $contact['telephone'] ?></p>
      <p>Demande: <?= $contact['message'] ?></p>
    </div>
      <p>
      <form action="adminContacts.php" method="post">
      <input type="hidden" name="Id_ContactToDelete" value="<?= $contact['Id_Formulaires'] ?>">
        <button type="submit" name="deleteContactButton" class="btn btn-danger">Supprimer</button>
      </form>
    </div>
  <?php
   }
}
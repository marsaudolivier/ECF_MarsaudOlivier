<?php
require_once('./lib/contact.php');
require_once('./lib/pdo.php');

function Contacts()
{
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
          <?php
          if (isset($_SERVER["SCRIPT_NAME"]) && $_SERVER["SCRIPT_NAME"] == "/index.php") { ?>
            <div class="FormulaireContact">
              <label for="Id_Motifs" class="text-primary">Votre demande:</label>
              <select id="Id_Motifs" name="Id_Motifs" class="text-primary">
                <option value="1">Mécanique auto</option>
                <option value="2">Carrosserie</option>
                <option value="3">Peinture</option>
                <option value="4">Vehicule à vendre</option>
                <option value="5">Autre</option>
              </select>
            </div>
      </div>
    <?php }
    ?>
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
  if (isset($_POST['Contact'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $mail = $_POST['mail'];
    $telephone = $_POST['telephone'];
    $Id_FormulairesOk = "1";
    if (isset($_SERVER["SCRIPT_NAME"]) && $_SERVER["SCRIPT_NAME"] == "/index.php") {
      $Id_Motifs = $_POST['Id_Motifs'];
    } else {
      $Id_Motifs = "4";
    }
    $message = $_POST['message'];
    $contact = new Contact($nom, $prenom, $mail, $telephone, $message, $Id_Motifs, $Id_FormulairesOk);
    $contact->insertContact($contact, $pdo);
  }
}
function VoirContact($pdo)
{
  if (isset($_POST["deleteContactButton"])) {
    $Id_Contact = $_POST['Id_ContactToDelete'];
    Contact::deleteContact($pdo, $Id_Contact);
    header("Location: adminContacts.php");
    exit;
  }
  $contacts = Contact::GetAll($pdo);
  foreach ($contacts as $contact) {
    if (isset($_POST['changeStateButton'])) {
      $contactId = $_POST['Id_ContactToChange'];
      $newState = $_POST['newState'];
      Contact::UpdateState($pdo, $contactId, $newState);
      header("Location: adminContacts.php");
      exit();
  }
  ?>
     ?>

    <div class="index_text p-1">
      <div class="index_text">
        <form action="adminContacts.php" method="post">
<div>
<h2 class="p-4">Formulaire traité: <?= $contact['etat'] ?></h2>
       <input type="hidden" name="Id_ContactToChange" value="<?= $contact['Id_Formulaires'] ?>">
            <label for="newState">Changer l'état :</label>
            <select name="newState" id="newState">
                <option value="1">Non Traité</option>
                <option value="2">En Cours</option>
                <option value="3">Traité</option>
            </select>
            <button type="submit" name="changeStateButton" class="btn btn-primary">Changer l'état</button>
</div>
        </form>
        <?php
        if ($contact['annonce'] != null) {
          echo '<h3 class="annonce_formulaire">Annonce concerné: ' . $contact['annonce'] . '</h3>';
        }
        if ($contact['annonce'] == null) {
          echo '<h4>Motif de contact! ' . $contact['motif'] .' </h4>';
        }
        ?>
      </div>
      <div class="p-2">
        MR ou MME <?= $contact['nom'] ?> <?= $contact['prenom'] ?>
        </p>
        <p>Adresse Mail: <?= $contact['mail'] ?></p>
        <p>Numéro de téléphone: <?= $contact['telephone'] ?></p>
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

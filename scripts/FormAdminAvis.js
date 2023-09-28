//fonction de controle formulaire employé
function validateFormAvis() {
  //je récupère mes différent input par ID
  let nom = document.getElementById("nom").value;
  let prenom = document.getElementById("prenom").value;
  let note = document.getElementById("note").value;
  let commentaire = document.getElementById("commentaire").value;

  //je défini mes regex les nom prenom ne peuvent pas avoir de numéro
  // les Notes sont entre 0-5
  //les commentaire peuvent avoir lettre chiffre et lettre a accent et le tiret
  let regexNom = /^[a-zA-Zéèàêâùïüëç\-]+$/;
  let regexPrenom = /^[a-zA-Zéèàêâùïüëç\-]+$/;
  let regexNote = /^[0-5]+$/;
  let regexCommentaire = /^[a-zA-Zéèàêâùïüëç\d\-]+$/;
  if (regexNom.test(nom) && regexPrenom.test(prenom)) {
    if (regexNote.test(note) && regexCommentaire.test(commentaire)) {
      return true;
    } else {
      alert("Veuillez remplir correctement les champs");
      return false;
    }
  } else {
    alert("Veuillez remplir correctement les champs");
    return false;
  }
}

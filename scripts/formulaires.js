//fonction de controle formulaire contact
function validateForm() {
    //je récupère mes différent input par ID 
    let nom = document.getElementById('nomContact').value;
    let prenom = document.getElementById('prenomContact').value;
    let mail = document.getElementById('mailContact').value;
    let telephone = document.getElementById('telephoneContact').value;
    let message = document.getElementById('messageContact').value;
     
    //Obligé usage que de lettre au nom ou prénom
    let namePattern = /^[a-zA-Z]+$/;
    if (!namePattern.test(nom) || !namePattern.test(prenom)) {
      alert("Le nom et le prénom ne doivent contenir que des lettres.");
      return false;
    }
   
    // Vérification du format de l'adresse email
    let emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    if (!emailPattern.test(mail)) {
        alert("Veuillez entrer une adresse email valide.");
        return false;
    }
    //Vérification du format du téléphone
    let phonePattern = /^0[1-9]([-. ]?[0-9]{2}){4}$/;
    if (!phonePattern.test(telephone)) {
        alert(
            "Veuillez entrer un numéro de téléphone français valide (10 chiffres, format : 06XXXXXXXX ou 05XXXXXXXX)."
            );
            return false;
        }
        if (message.trim() ===""){
            alert("Veuillez entrer votre message");
            return false;
        }
        
  return true;
}
//fonction de controle formulaire Avis
function validateAvis() {
    let nomAvis =document.getElementById('nomAvis').value;
    let prenomAvis =document.getElementById('prenomAvis').value;
    let commentaireAvis =document.getElementById('commentaireAvis').value;
    let noteAvis =document.getElementById('noteAvis').value;

    let namePattern = /^[a-zA-Z]+$/;
    if (!namePattern.test(nomAvis) || !namePattern.test(prenomAvis)) {
        alert("Le nom et le prénom ne doivent contenir que des lettres.");
        return false;
        }
    if (noteAvis.trim() ===""){
        alert("Veuillez entrer une note");
        return false;
    }

    if (commentaireAvis.trim() ===""){
        alert("Veuillez entrer un commentaire");
        return false;
    }
    return true;
}


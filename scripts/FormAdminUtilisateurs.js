//affichage Mdp
function showPassword() {
  const passwordInput = document.getElementById("mdp");
  if (passwordInput.type === "password") {
      passwordInput.type = "text";
  } else {
      passwordInput.type = "password";
  }
}
//fonction de controle formulaire employé
function validateFormUser() {
  //je récupère mes différent input par ID
  let nom = document.getElementById("nom").value;
  let prenom = document.getElementById("prenom").value;
  let mail = document.getElementById("mail").value;
  let mdp = document.getElementById("mdp").value;

  if (nom.trim() === "") {
    alert("Veuillez entrer votre nom");
    return false;
  }

  if (prenom.trim() === "") {
    alert("Veuillez entrer votre prénom");
    return false;
  }

  // Vérification du format de l'adresse email
  let emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
  if (!emailPattern.test(mail)) {
    alert("Veuillez entrer une adresse email valide.");
    return false;
  }

  if (mdp.trim() === "") {
    alert("Veuillez entrer votre Mot de Passe");
    return false;
  }
  // Vérification de la longueur minimale du mot de passe
  if (mdp.length < 12) {
    alert("Le mot de passe doit contenir au moins 12 caractères.");
    return false;
  }

  // Vérification de la complexité du mot de passe
  let passwordPattern =
    /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{12,}$/;
  if (!passwordPattern.test(mdp)) {
    alert(
      "Le mot de passe doit contenir au moins 12 caractères et inclure au moins une lettre majuscule, une lettre minuscule, un chiffre et un caractère spécial."
    );
    return false;
  }
  return true;
}


//fonction de controle formulaire Services
function validateFormServ() {
  //je récupère mes différent input par ID
  let titreNewServices = document.getElementById("titreNewServices").value;
  let descriptionNewServices = document.getElementById("descriptionNewServices").value;


  if (titreNewServices.trim() === "") {
    alert("Veuillez entrer votre titre de service");
    return false;
  }

  if (descriptionNewServices.trim() === "") {
    alert("Veuillez entrer votre texte ");
    return false;
  }
  return true;
}


//fonction de controle formulaire Horaires
function validateFormAdmin() {
  //  accepter uniquement les jours de la semaine en français
  let joursSemaineRegEx =
  /^(lundi|mardi|mercredi|jeudi|vendredi|samedi|dimanche)$/i;
 // création d'une boucle pour récupéré les id de 1 a 7
 for (let i = 1; i <= 7; i++) {
  const jour = document.getElementById("jour" + i).value;
  const heure_matin = document.getElementById("heure_matin"+ i).value;
  const heure_soir = document.getElementById("heure_soir"+ i).value;
  if (!joursSemaineRegEx.test(jour)) {
     alert(
       `Le jour ${i} doit être lundi, mardi, mercredi, jeudi, vendredi, samedi ou dimanche.`
     );
     return false;
  }
   // Regex pour le format des heures : 00:00,fermé ou vacances
  let heureRegEx =
    /^(0?[0-9]|1[0-9]|2[0-3])h(:?([0-5][0-9]))?-(0?[0-9]|1[0-9]|2[0-3])h(:?([0-5][0-9]))?$|^fermé$|^vacances$/;

  if (!heureRegEx.test(heure_matin) || !heureRegEx.test(heure_soir)) {
    alert(
      `Les heures du jour ${i} doivent être au format xxhxx-xxhxx,'fermé' ou 'vacances'.`
    );
    return false;
  }
 }

 
  return true;
}

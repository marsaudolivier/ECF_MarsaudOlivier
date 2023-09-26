//fonction de controle formulaire employé
function validateFormAdmin() {
    //je récupère mes différent input par ID
    let jour = document.getElementById("jour").value;
    let heure_matin = document.getElementById("heure_matin").value;
    let heure_soir = document.getElementById("heure_soir").value;

    //  accepter uniquement les jours de la semaine en français
    let joursSemaineRegEx = /^(lundi|mardi|mercredi|jeudi|vendredi|samedi|dimanche)$/i;

    if (!joursSemaineRegEx.test(jour)) {
        alert("Le jour doit être lundi, mardi, mercredi, jeudi, vendredi, samedi ou dimanche.");
        return false;
    }

    // Regex pour le format des heures : 00:00,fermé ou vacances
    let heureRegEx = /^(0?[0-9]|1[0-9]|2[0-3])h(:?([0-5][0-9]))?-(0?[0-9]|1[0-9]|2[0-3])h(:?([0-5][0-9]))?$|^fermé$|^vacances$/;

    if (!heureRegEx.test(heure_matin) || !heureRegEx.test(heure_soir)) {
        alert("Les heures doivent être au format xxhxx-xxhxx,'fermé' ou 'vacances'.");
        return false;
    }


}
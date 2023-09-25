//Récupération des élément par ID
const marqueSelect = document.getElementById("marque");
const modeleSelect = document.getElementById("modele");
const ajoutMarqueForm = document.getElementById("ajoutMarqueForm");
const ajoutOptionForm = document.getElementById("ajoutOptionFormm");
const ajoutModeleForm = document.getElementById("ajoutModeleForm");
const nouvelleModele = document.getElementById("nouvelleModele");
const marqueAddModele = document.getElementById("marqueAddModele");

//récupération du select marques
marqueSelect.addEventListener("change", () => {
  const selectedMarque = marqueSelect.value;
  const formData = new FormData();
  formData.append("marque", selectedMarque);
  // Configuration de la requête fetch
  const url = "./api/api_modele.php";
  const options = {
    method: "POST",
    body: formData,
  };

  fetch(url, options)
    .then((response) => {
      if (!response.ok) {
        throw new Error("Erreur lors de la requête");
      }
      return response.json(); // Si la réponse est au format JSON
    })
    .then((data) => {
      console.log(data);
      modeleSelect.innerHTML = "";
      data.modeles.forEach((modele) => {
        const option = document.createElement("option");
        option.value = modele.Id_Modeles;
        option.textContent = modele.modele;
        modeleSelect.appendChild(option);
      });
      console.log(data);
    })
    .catch((error) => {
      console.error("Erreur :", error);
    });
});
ajoutMarqueForm.addEventListener("submit", (e) => {
  e.preventDefault();
  //récupération de la nouvelle marque input nouvelleMarque
  const nouvelleMarque = document.getElementById("nouvelleMarque").value;
  // Vérifiez si l'utilisateur a entré un nom de marque
  if (nouvelleMarque) {
    const formData = new FormData();
    formData.append("nouvelleMarque", nouvelleMarque);

    const url = "./api/api_ajoutMarque.php";
    const options = {
      method: "POST",
      body: formData,
    };

    fetch(url, options)
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          alert("Nouvelle marque ajoutée avec succès !");
          //rafraichisement marques
          refreshMarquesList();
        } else {
          alert("Erreur lors de l'ajout de la marque.");
        }
      })
      .catch((error) => {
        console.error("Erreur :", error);
      });
  }

  function refreshMarquesList() {
    fetch("./api/api_obtenirMarques.php")
      .then((response) => {
        if (!response.ok) {
          throw new Error("Erreur lors de la requête");
        }
        return response.json();
      })
      .then((data) => {
        const marqueSelect = document.getElementById("marque");
        marqueSelect.innerHTML = "";
        //Usage du DOM pour mettre a jour marque
        data.marques.forEach((marque) => {
          const option = document.createElement("option");
          option.value = marque.Id_Marques;
          option.textContent = marque.marque;
          marqueSelect.appendChild(option);
        });
      })
      .catch((error) => {
        console.error("Erreur :", error);
      });
  }
});

ajoutOptionForm.addEventListener("submit", (e) => {
  e.preventDefault();
  const nouvelleOption = document.getElementById("nouvelleOption").value;
  if (nouvelleOption) {
    const formData = new FormData();
    formData.append("nouvelleOption", nouvelleOption);

    const url = "./api/api_ajoutOption.php";
    const options = {
      method: "POST",
      body: formData,
    };
    fetch(url, options)
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          alert("Nouvelle option ajoutée avec succès !");
          refreshOptionsList();
        } else {
          alert("Erreur lors de l'ajout de l'option.");
        }
      })
      .catch((error) => {
        console.error("Erreur :", error);
      });
  }
});
function refreshOptionsList() {
  console.log("La fonction refreshOptionsList est exécutée.");
  fetch("./api/api_obtenirOption.php")
    .then((response) => {
      if (!response.ok) {
        throw new Error("Erreur lors de la requête");
      }
      return response.json();
    })
    .then((data) => {
      console.log(data);
      // Manipulation du DOM sur optionsFieldset
      const optionsFieldset = document.getElementById("optionsFieldset");
      optionsFieldset.innerHTML = "";
      data.option.forEach((option) => {
        const checkbox = document.createElement("input");
        checkbox.type = "checkbox";
        checkbox.name = "options[]";
        checkbox.value = option.Id_Options;
        const label = document.createElement("label");
        label.textContent = option.optionn;
        optionsFieldset.appendChild(checkbox);
        optionsFieldset.appendChild(label);
      });
    })
    .catch((error) => {
      console.error("Erreur de requête AJAX :", error);
    });
}
ajoutModeleForm.addEventListener("submit", (e) => {
  e.preventDefault();

  const nouvelleModele = document.getElementById("nouvelleModele").value;
  const marqueAddModele = document.getElementById("marqueAddModele").value;
  if (nouvelleModele) {
    const formData = new FormData();
    formData.append("nouvelleModele", nouvelleModele);
    formData.append("marqueAddModele", marqueAddModele);
    const url = "./api/api_ajoutModele.php";
    const options = {
      method: "POST",
      body: formData,
    };
    // Effectuez la requête fetch pour ajouter le nouveau modèle
    fetch(url, options)
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          alert("Nouveau modèle ajouté avec succès !");
          refreshModelesList();
        } else {
          alert("Erreur lors de l'ajout du modèle.");
        }
      })
      .catch((error) => {
        console.error("Erreur :", error);
      });
  }
});
function refreshModelesList() {
  fetch("./api/api_obtenirModeles.php")
    .then((response) => {
      if (!response.ok) {
        throw new Error("Erreur lors de la requête");
      }
      return response.json();
    })
    .then((data) => {
      const modeleSelect = document.getElementById("modele");
      modeleSelect.innerHTML = "";
      data.modeles.forEach((modeles) => {
        const option = document.createElement("option");
        option.value = modeles.Id_Modeles;
        option.textContent = modeles.modele;
        modeleSelect.appendChild(option);
      });
    })
    .catch((error) => {
      console.error("Erreur :", error);
    });
}

// Sélectionnez l'élément d'entrée de fichier et l'élément d'image de prévisualisation.
let fileInput = document.getElementById("photo_principal");
let imagePreview = document.getElementById("image_preview");

// Ajoutez un écouteur d'événements pour détecter le changement de fichier. prévisualisation
fileInput.addEventListener("change", function () {
  let file = fileInput.files[0];
  if (file) {
    // Créez un objet URL à partir du fichier sélectionné.
    let imageURL = URL.createObjectURL(file);
    // Mettez à jour l'élément d'image de prévisualisation.
    imagePreview.src = imageURL;
    imagePreview.style.display = "block";
  } else {
    // Cachez l'image de prévisualisation si aucun fichier n'est sélectionné.
    imagePreview.style.display = "none";
  }
});
// Sélectionnez l'élément d'entrée de fichier et l'élément contenant les aperçus d'image.
let fileInputs = document.getElementById("photo_secondaire");
let imagePreviews = document.getElementById("image_previews");

// Ajoutez un écouteur d'événements pour détecter le changement de fichier.
fileInputs.addEventListener("change", function () {
  // Supprimez tous les aperçus d'image existants.
  imagePreviews.innerHTML = "";

  let files = fileInputs.files;
  for (let i = 0; i < files.length; i++) {
    let file = files[i];
    // Créez un objet URL à partir du fichier sélectionné.
    let imageURL = URL.createObjectURL(file);
    // Créez un élément d'image pour l'aperçu.
    let image = document.createElement("img");
    image.src = imageURL;
    image.style.maxWidth = "100px";
    image.style.maxHeight = "100px";
    // Ajoutez l'élément d'image à la liste des aperçus d'image.
    imagePreviews.appendChild(image);
  }
  // Cachez l'élément de prévisualisation s'il n'y a aucun fichier sélectionné.
  if (files.length === 0) {
    imagePreviews.style.display = "none";
  } else {
    imagePreviews.style.display = "block";
  }
});
//Vérification du formulaires de création voitures
function validateForm() {
  let energieCheckbox = document.getElementsByName("energie[]");
  let optionCheckbox = document.getElementsByName("options[]");
  let energieChecked = false;
  let optionChecked = false;

  for (let i = 0; i < energieCheckbox.length; i++) {
    if (energieCheckbox[i].checked) {
      energieChecked = true;
      break; // Au moins une énergie sélectionnée
    }
  }

  for (let i = 0; i < optionCheckbox.length; i++) {
    if (optionCheckbox[i].checked) {
      optionChecked = true;
      break; // Au moins une option sélectionnée
    }
  }

  // Validation du titre
  let titre = document.getElementsByName("titre")[0].value;
  if (titre.trim() === "") {
    alert("Le champ 'Titre' est obligatoire.");
    return false;
  }

  // Validation de l'année (4 chiffres max)
  let annee = document.getElementsByName("annee")[0].value;
  if (isNaN(annee) || annee.length !== 4) {
    alert("L'année doit contenir exactement 4 chiffres positif.");
    return false;
  }

  // Validation du prix (chiffres positifs)
  let prix = document.getElementsByName("prix")[0].value;
  if (isNaN(prix) || prix <= 0) {
    alert("Le champ 'Prix' doit contenir un nombre positif.");
    return false;
  }

  // Validation du kilométrage (chiffres positifs)
  let kilometrage = document.getElementsByName("kilometrage")[0].value;
  if (isNaN(kilometrage) || kilometrage <= 0) {
    alert("Le champ 'Kilométrage' doit contenir un nombre positif.");
    return false;
  }

  if (!energieChecked || !optionChecked) {
    alert("Veuillez sélectionner au moins une énergie et une option.");
    return false; // Empêche la soumission du formulaire
  }

  // Validation de la présence d'une photo principale
  let photoPrincipale = document.getElementById("photo_principal");
  if (photoPrincipale.files.length === 0) {
    alert("Veuillez sélectionner une photo principale.");
    return false;
  }
  return true; // Le formulaire sera soumis si tout est correct
}

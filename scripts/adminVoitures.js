const marqueSelect = document.getElementById("marque");
const modeleSelect = document.getElementById("modele");
const ajoutMarqueForm = document.getElementById("ajoutMarqueForm");
const ajoutOptionForm = document.getElementById("ajoutOptionFormm");
const ajoutModeleForm = document.getElementById("ajoutModeleForm");
const nouvelleModele = document.getElementById("nouvelleModele");
const marqueAddModele = document.getElementById("marqueAddModele");

marqueSelect.addEventListener("change", () => {
  const selectedMarque = marqueSelect.value;
  // Créez un objet FormData si vous avez des données à envoyer au serveur
  // Par exemple, si vous voulez envoyer des données POST
  const formData = new FormData();
  formData.append("marque", selectedMarque);

  // Configuration de la requête fetch
  const url = "./api/api_modele.php";
  const options = {
    method: "POST", // Utilisez 'GET' ou 'POST' selon vos besoins
    body: formData, // Incluez le FormData si vous avez des données à envoyer
  };

  // Effectuez la requête fetch
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
      // Gérez les erreurs ici
      console.error("Erreur :", error);
    });
});
ajoutMarqueForm.addEventListener("submit", (e) => {
  e.preventDefault(); // Empêche le formulaire de se soumettre normalement

  const nouvelleMarque = document.getElementById("nouvelleMarque").value;

  // Vérifiez si l'utilisateur a entré un nom de marque
  if (nouvelleMarque) {
    // Créez un objet FormData pour envoyer les données au serveur
    const formData = new FormData();
    formData.append("nouvelleMarque", nouvelleMarque);

    // Configuration de la requête fetch
    const url = "./api/api_ajoutMarque.php";
    const options = {
      method: "POST",
      body: formData,
    };

    // Effectuez la requête fetch pour ajouter la nouvelle marque
    fetch(url, options)
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          // La nouvelle marque a été ajoutée avec succès
          alert("Nouvelle marque ajoutée avec succès !");

          // Mettez à jour la liste déroulante des marques si nécessaire
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
    // Effectuez une requête fetch pour obtenir les données des marques depuis le serveur
    fetch("./api/api_obtenirMarques.php") // Remplacez par le chemin correct vers votre API
      .then((response) => {
        if (!response.ok) {
          throw new Error("Erreur lors de la requête");
        }
        return response.json();
      })
      .then((data) => {
        // Mettez à jour la liste déroulante des marques avec les nouvelles données
        const marqueSelect = document.getElementById("marque");
        marqueSelect.innerHTML = ""; // Effacez toutes les options existantes

        // Remplissez la liste déroulante avec les nouvelles données
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

  // Vérifiez si l'utilisateur a entré un nom d'option
  if (nouvelleOption) {
    // Créez un objet FormData pour envoyer les données au serveur
    const formData = new FormData();
    formData.append("nouvelleOption", nouvelleOption);

    // Configuration de la requête fetch
    const url = "./api/api_ajoutOption.php";
    const options = {
      method: "POST",
      body: formData,
    };

    // Effectuez la requête fetch pour ajouter la nouvelle option
    fetch(url, options)
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          // La nouvelle option a été ajoutée avec succès
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
  // Effectuez une requête fetch pour obtenir les données des options depuis le serveur
  fetch("./api/api_obtenirOption.php") // Remplacez par le chemin correct vers votre API
    .then((response) => {
      if (!response.ok) {
        throw new Error("Erreur lors de la requête");
      }
      return response.json();
    })
    .then((data) => {
      console.log(data);
      // Ciblez l'élément du formulaire à mettre à jour par son identifiant
      const optionsFieldset = document.getElementById("optionsFieldset");

      // Effacez toutes les options existantes
      optionsFieldset.innerHTML = "";

      // Remplissez le formulaire avec les nouvelles données
      data.option.forEach((option) => {
        const checkbox = document.createElement("input");
        checkbox.type = "checkbox";
        checkbox.name = "options[]";
        checkbox.value = option.Id_Options;

        const label = document.createElement("label");
        label.textContent = option.optionn;

        // Ajoutez la case à cocher, le label  à l'élément fieldset
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

  // Vérifiez si l'utilisateur a entré un nom de modèle
  if (nouvelleModele) {
    // Créez un objet FormData pour envoyer les données au serveur
    const formData = new FormData();
    formData.append("nouvelleModele", nouvelleModele);
    formData.append("marqueAddModele", marqueAddModele);

    // Configuration de la requête fetch
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
          // Le nouveau modèle a été ajouté avec succès
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
  // Effectuez une requête fetch pour obtenir les données des modèles depuis le serveur
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
let fileInput = document.getElementById('photo_principal');
let imagePreview = document.getElementById('image_preview');

// Ajoutez un écouteur d'événements pour détecter le changement de fichier.
fileInput.addEventListener('change', function() {
  let file = fileInput.files[0];
  if (file) {
    // Créez un objet URL à partir du fichier sélectionné.
    let imageURL = URL.createObjectURL(file);
    // Mettez à jour l'élément d'image de prévisualisation.
    imagePreview.src = imageURL;
    imagePreview.style.display = 'block';
  } else {
    // Cachez l'image de prévisualisation si aucun fichier n'est sélectionné.
    imagePreview.style.display = 'none';
  }
});
// Sélectionnez l'élément d'entrée de fichier et l'élément contenant les aperçus d'image.
let fileInputs = document.getElementById('photo_secondaire');
let imagePreviews = document.getElementById('image_previews');

// Ajoutez un écouteur d'événements pour détecter le changement de fichier.
fileInputs.addEventListener('change', function() {
  // Supprimez tous les aperçus d'image existants.
  imagePreviews.innerHTML = '';

  let files = fileInputs.files;
  for (let i = 0; i < files.length; i++) {
    let file = files[i];
    // Créez un objet URL à partir du fichier sélectionné.
    let imageURL = URL.createObjectURL(file);
    // Créez un élément d'image pour l'aperçu.
    let image = document.createElement('img');
    image.src = imageURL;
    image.style.maxWidth = '100px';
    image.style.maxHeight = '100px';

    // Ajoutez l'élément d'image à la liste des aperçus d'image.
    imagePreviews.appendChild(image);
  }
  // Cachez l'élément de prévisualisation s'il n'y a aucun fichier sélectionné.
  if (files.length === 0) {
    imagePreviews.style.display = 'none';
  } else {
    imagePreviews.style.display = 'block';
  }
});

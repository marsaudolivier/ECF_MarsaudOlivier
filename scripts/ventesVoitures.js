//Slider prix
let snapSlider = document.getElementById("slider-snap");
noUiSlider.create(snapSlider, {
  start: [0, 50000],
  snap: true,
  connect: true,
  range: {
    min: 0,
    "5%": 2500,
    "10%": 5000,
    "15%": 7500,
    "20%": 10000,
    "25%": 12500,
    "30%": 15000,
    "35%": 17500,
    "40%": 20000,
    "45%": 22500,
    "50%": 25000,
    "55%": 27500,
    "60%": 30000,
    "65%": 32500,
    "70%": 35000,
    "75%": 37500,
    "80%": 40000,
    "85%": 42500,
    "90%": 45000,
    "95%": 47500,
    max: 50000,
  },
});

let snapValues = [
  document.getElementById("slider-snap-value-lower"),
  document.getElementById("slider-snap-value-upper"),
];

snapSlider.noUiSlider.on("update", function (values, handle) {
  snapValues[handle].innerHTML = values[handle] + "€";
});

//Slider Kilométrage
let snapSliderTwo = document.getElementById("slider-snapTwo");
noUiSlider.create(snapSliderTwo, {
  start: [0, 250000],
  snap: true,
  connect: true,
  range: {
    min: 0,
    "5%": 12500,
    "10%": 25000,
    "15%": 37500,
    "20%": 50000,
    "25%": 62500,
    "30%": 75000,
    "35%": 87500,
    "40%": 100000,
    "45%": 112500,
    "50%": 125000,
    "55%": 137500,
    "60%": 150000,
    "65%": 162500,
    "70%": 175000,
    "75%": 187500,
    "80%": 200000,
    "85%": 212500,
    "90%": 225000,
    "95%": 237500,
    max: 250000,
  },
});

let snapValuesTwo = [
  document.getElementById("slider-snap-value-lowerTwo"),
  document.getElementById("slider-snap-value-upperTwo"),
];
snapSliderTwo.noUiSlider.on("update", function (values, handle) {
  snapValuesTwo[handle].innerHTML = values[handle] + "Km";
});

//Slider Années
let snapSliderTrois = document.getElementById("slider-snapTrois");
noUiSlider.create(snapSliderTrois, {
  start: [1950, 2024],
  snap: true,
  connect: true,
  step: 1,
  range: {
    min: 1950,
    "5%": 1960,
    "10%": 1970,
    "15%": 1980,
    "20%": 1990,
    "30%": 2000,
    "40%": 2005,
    "50%": 2010,
    "55%": 2015,
    "60%": 2016,
    "65%": 2017,
    "70%": 2018,
    "75%": 2019,
    "80%": 2020,
    "85%": 2021,
    "90%": 2022,
    "95%": 2023,
    max: 2024,
  },
});

let snapValuesTrois = [
  document.getElementById("slider-snap-value-lowerTrois"),
  document.getElementById("slider-snap-value-upperTrois"),
];
snapSliderTrois.noUiSlider.on("update", function (values, handle) {
  snapValuesTrois[handle].innerHTML = values[handle];
});

document.getElementById("reset_prix").addEventListener("click", function () {
  snapSlider.noUiSlider.reset();
});
document.getElementById("reset_km").addEventListener("click", function () {
  snapSliderTwo.noUiSlider.reset();
});
document.getElementById("reset_annee").addEventListener("click", function () {
  snapSliderTrois.noUiSlider.reset();
});

snapSlider.noUiSlider.on("update", function (values, handle) {
  snapValues[handle].innerHTML = values[handle] + "€";
  // Mettre à jour les champs cachés du slider Prix
  document.getElementById("slider_prix_min").value = values[0];
  document.getElementById("slider_prix_max").value = values[1];
});

snapSliderTwo.noUiSlider.on("update", function (values, handle) {
  snapValuesTwo[handle].innerHTML = values[handle] + "Km";
  // Mettre à jour les champs cachés du slider Kilométrage
  document.getElementById("slider_km_min").value = values[0];
  document.getElementById("slider_km_max").value = values[1];
});

snapSliderTrois.noUiSlider.on("update", function (values, handle) {
  snapValuesTrois[handle].innerHTML = values[handle];
  // Mettre à jour les champs cachés du slider Années
  document.getElementById("slider_annee_min").value = values[0];
  document.getElementById("slider_annee_max").value = values[1];
});

// Variables pour gérer la pagination
let currentPage = 1;
const itemsPerPage = 3; // Nombre d'annonces par page modification pour avoir plus ou moins annonces par pages

// Mise à jour des résultats en fonction des filtres et de la pagination
function updateResults() {
  const prixMin = parseInt(
    document.getElementById("slider_prix_min").value,
    10
  );
  const prixMax = parseInt(
    document.getElementById("slider_prix_max").value,
    10
  );
  const kmMin = parseInt(document.getElementById("slider_km_min").value, 10);
  const kmMax = parseInt(document.getElementById("slider_km_max").value, 10);
  const anneeMin = parseInt(
    document.getElementById("slider_annee_min").value,
    10
  );
  const anneeMax = parseInt(
    document.getElementById("slider_annee_max").value,
    10
  );

  const formData = new FormData();
  formData.append("prixMin", prixMin);
  formData.append("prixMax", prixMax);
  formData.append("kmMin", kmMin);
  formData.append("kmMax", kmMax);
  formData.append("anneeMin", anneeMin);
  formData.append("anneeMax", anneeMax);

  // Configuration de la requête fetch
  const url = "./api/api_filtre.php";
  const options = {
    method: "POST",
    body: formData,
  };

  // Envoyer la requête AJAX
  fetch(url, options)
    .then((response) => response.json())
    .then((data) => {
      const annoncesContainer = document.getElementById("annoncesContainer");
      annoncesContainer.innerHTML = "";

      // Calcul des indices de début et de fin pour la pagination
      const startIndex = (currentPage - 1) * itemsPerPage;
      const endIndex = startIndex + itemsPerPage;
      const filteredAnnonces = data.Annonces.slice(startIndex, endIndex);

      // Parcourir les données JSON filtrées et créer une carte pour chaque annonce
      filteredAnnonces.forEach((annonce) => {
        const card = document.createElement("div");
        card.classList.add("col");
        card.innerHTML = `
          <div class="card shadow-sm admin_conteneur">
            <img src="${annonce.photo_principal}" alt="" class="index_text card_photo">
            <h3>${annonce.titre}</h3>
            <p class="card-text">Année : ${annonce.annee}<br>
              Kilométrage : ${annonce.kilometrage} Km<br>
              Prix : ${annonce.prix} €<br>
              Marque : ${annonce.marque}<br>
              Modèle : ${annonce.modele}
              </p>
              <div class="p-2">
              <button data-id="${annonce.Id_Annonces}" class="btn btn-sm btn-warning detailButton">Détail</button>
          </div>
          </div>
        `;

        annoncesContainer.appendChild(card);
      });

      // Mettre à jour la visibilité des boutons de pagination
      const prevButton = document.querySelector(
        "#pagination-container button:first-child"
      );
      const nextButton = document.querySelector(
        "#pagination-container button:last-child"
      );
      prevButton.disabled = currentPage === 1;
      nextButton.disabled = endIndex >= data.Annonces.length;
    })
    .catch((error) => {
      console.error(
        "Une erreur s'est produite lors de la récupération des données : ",
        error
      );
    });
}
// Fonction pour changer de page en fonction des boutons de pagination
function changePage(direction) {
  currentPage += direction;
  updateResults();
}

// Écouter les événements de changement des sliders
document.addEventListener("DOMContentLoaded", function () {
  currentPage = 1; // Initialise la page courante
  [snapSlider, snapSliderTwo, snapSliderTrois].forEach(function (slider) {
    slider.noUiSlider.on("update", function () {
      updateResults();
    });
  });
});
// Écouter les clics sur les boutons de pagination
document
  .getElementById("pagination-container")
  .addEventListener("click", function (event) {
    if (event.target.classList.contains("pagination-button")) {
      const direction = event.target.textContent === "Suivant" ? 1 : -1;
      changePage(direction);
    }
  });
document.addEventListener("click", function (event) {
  if (event.target.classList.contains("detailButton")) {
    const annonceId = event.target.getAttribute("data-id");
    fetchDetailAnnonce(annonceId);
  }
});

// fonction pour récupérer les détails de l'annonce
function fetchDetailAnnonce(annonceId, voitureId) {
  const url = "./api/api_detailAnnonce.php";

  const formData = new FormData();
  formData.append("Id_Annonces", annonceId);
  formData.append("Id_Voitures", voitureId);

  const options = {
    method: "POST",
    body: formData,
  };

  fetch(url, options)
    .then((response) => response.json())
    .then((data) => {
      const annoncesDetailContainer = document.getElementById(
        "annoncesDetailContainer"
      );
      annoncesDetailContainer.innerHTML = "";
      // Parcourir les données JSON et créer une carte pour chaque annonce
      if (data.Annonces.length > 0) {
        const premiereAnnonce = data.Annonces[0];
        const card = document.createElement("div");
        card.classList.add("col");
        card.innerHTML = `
          <div class=" admin_conteneur p-2">
          <h3 class="p-5">${premiereAnnonce.titre}<br></h3>
              <div class="annoncesContainer" id="annoncesContainer">
                  <div class="">
                      <div id="carouselExampleControls" class="carousel slide imageCardVentes" data-ride="carousel">
                          <div class="carousel-inner">
                              <div id="carousel_conteneur" >
                              <div class="carousel-item " >
                              </div>
                              </div>
                          </div>
                          <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                              <span class="sr-only"></span>
                          </a>
                          <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                              <span class="carousel-control-next-icon" aria-hidden="true"></span>
                              <span class="sr-only"></span>
                          </a>
                      </div>
                  </div>
                  <div class="annoncesDetail p-2">
                      <div class="admin_conteneur  p-4">
                          <p class="card-text">Année : ${premiereAnnonce.annee}<br>
                              Kilométrage : ${premiereAnnonce.kilometrage} Km<br>
                              Prix : ${premiereAnnonce.prix} €<br>
                              Marque : ${premiereAnnonce.marque}<br>
                              Modèle : ${premiereAnnonce.modele}<br>
                          </p>
                      </div>
                  </div>
                  <div class="p-2">
                      <div class="annoncesDetail">
                          <div id="optionsContainer" class="admin_conteneur card_option"></div>
                          <div id="ennergieContainer" class="admin_conteneur card_option"></div>
                      </div>
                  </div>
              </div>
              <p class="p-3 card_text admin_conteneur">Ce modèle vous intéresse n'hésitez pas à nous contacter avec le formulaire suivant:</p>
<div class="p-2">
    <div class="justify-content-center index_text p-2">
        <h2>NOUS CONTACTER</h2>
        <div>
        <form action="/api/api_contact.php" enctype="multipart/form-data" method="POST" id="formulaireee" onsubmit="return validateFormvente()">
                <h3>Annonce: ${premiereAnnonce.titre}| Marque: ${premiereAnnonce.marque} | Modèle: ${premiereAnnonce.modele} | Année: ${premiereAnnonce.annee} | Kilométrage: ${premiereAnnonce.kilometrage}Km</h3>
                <div class="FormulaireContact">
               
                    <label for="nom" class="text-primary">Nom:</label>
                    <input type="text" id="nomFormVente" name="nom" required/>
                    <label for="prenom" class="text-primary">Prenom:</label>
                    <input type="text" id="prenomFormVente" name="prenom" required/>
                </div>
                <div class="FormulaireContact">
                    <label for="mail" class="text-primary">Email:</label>
                    <input type="text" id="mailFormVente" name="mail"required />
                    <label for="telephone" class="text-primary">Telephone:</label>
                    <input type="text" id="telephoneFormVente" name="telephone"required />
                    <input type="hidden" id="Annonce" name="Annonce" value="${premiereAnnonce.titre} | Marque: ${premiereAnnonce.marque} | Modèle: ${premiereAnnonce.modele} | Année: ${premiereAnnonce.annee} | Kilométrage: ${premiereAnnonce.kilometrage}" />
                </div>
                <div class="p-2 FormulaireContact2">
                    <label for="message">message:</label>
                    <textarea id="messageFormVente" name="message"required></textarea>
                </div>
                <button type="submit"  name="Contact" class="ventes_bouton btn btn-primary"> VALIDER</button>
                <div class="admin_conteneur p-3 mb-2 mt-3">
                <img class="col-md-2 logo_footer" src="../assets/images/Logo Parrot.svg" alt="Logo Garage V. Parrot"></img>
                <h4>Garage V. Parrot</br>
                Téléphone : 05 46 00 00 00</br></h4>
                </div>
        </div>
        </form>
    </div>
</div>
              `;
        annoncesDetailContainer.appendChild(card);
        fetchOptions(premiereAnnonce.Id_Voitures);
        fetchEnergie(premiereAnnonce.Id_Voitures);
        fetchPhoto(
          premiereAnnonce.Id_Voitures,
          premiereAnnonce.photo_principal
        );
      } else {
        console.log("Aucune annonce trouvée.");
      }
    })
    .catch((error) => {
      console.error(
        "Une erreur s'est produite lors de la récupération des données : ",
        error
      );
    });
}
function fetchOptions(idVoitures) {
  const optionsUrl = "./api/api_optionVente.php";

  const formDataOptions = new FormData();
  formDataOptions.append("Id_Voitures", idVoitures);

  const optionsOptions = {
    method: "POST",
    body: formDataOptions,
  };

  fetch(optionsUrl, optionsOptions)
    .then((response) => response.json())
    .then((optionsData) => {
      const optionsContainer = document.getElementById("optionsContainer");
      optionsContainer.innerHTML = "<h5>OPTIONS:</h5>";

      optionsData.options.forEach((option) => {
        const optionElement = document.createElement("div");
        optionElement.innerText = `${option.optionn}`;
        optionsContainer.appendChild(optionElement);
      });
    })
    .catch((error) => {
      console.error(
        "Une erreur s'est produite lors de la récupération des options : ",
        error
      );
    });
}
function fetchEnergie(idVoitures) {
  const optionsUrl = "./api/api_energieVente.php";

  const formDataOptions = new FormData();
  formDataOptions.append("Id_Voitures", idVoitures);

  const optionsOptions = {
    method: "POST",
    body: formDataOptions,
  };

  fetch(optionsUrl, optionsOptions)
    .then((response) => response.json())
    .then((optionsData) => {
      const optionsContainer = document.getElementById("ennergieContainer");
      optionsContainer.innerHTML = "<h5>ENERGIES:</h5>";

      optionsData.energies.forEach((energies) => {
        const optionElement = document.createElement("div");
        optionElement.innerText = `${energies.energie}`;
        optionsContainer.appendChild(optionElement);
      });
    })
    .catch((error) => {
      console.error(
        "Une erreur s'est produite lors de la récupération des options : ",
        error
      );
    });
}
function fetchPhoto(idVoitures, photoPrincipal) {
  const optionsUrl = "./api/api_obtenirPhoto.php";
  const formDataOptions = new FormData();
  formDataOptions.append("Id_Voitures", idVoitures);
  const optionsOptions = {
    method: "POST",
    body: formDataOptions,
  };
  fetch(optionsUrl, optionsOptions)
    .then((response) => response.json())
    .then((optionsData) => {
      const optionsContainer = document.getElementById("carousel_conteneur");
      optionsContainer.innerHTML = "";
      // Ajoute la photo principale à la première diapositive du carousel
      const premiereDiapositive = document.createElement("div");
      premiereDiapositive.className = "carousel-item active";
      premiereDiapositive.innerHTML = `<img class="d-block imageCardVentes" src="${photoPrincipal}" alt="${photoPrincipal}">`;
      optionsContainer.appendChild(premiereDiapositive);
      // Ajoute les autres photos secondaires
      optionsData.Photos.forEach((Photos, index) => {
        const optionElement = document.createElement("div");
        optionElement.className = "carousel-item";
        optionElement.innerHTML = `<img class="d-block imageCardVentes" src="${Photos.photo_secondaire}" alt="${Photos.photo_secondaire}">`;
        optionsContainer.appendChild(optionElement);
      });
    })
    .catch((error) => {
      console.error(
        "Une erreur s'est produite lors de la récupération des options : ",
        error
      );
    });
}
//validation du formulaire de contact vente
function validateFormvente() {
  let nomFormVente = document.getElementById("nomFormVente").value;
  let prenomFormVente = document.getElementById("prenomFormVente").value;
  let mailFormVente = document.getElementById("mailFormVente").value;
  let telephoneFormVente = document.getElementById("telephoneFormVente").value;
  let messageFormVente = document.getElementById("messageFormVente").value;
  //Obligé usage que de lettre au nom ou prénom
  let namePattern = /^[a-zA-Z]+$/;
  if (!namePattern.test(nomFormVente) || !namePattern.test(prenomFormVente)) {
    alert("Le nom et le prénom ne doivent contenir que des lettres.");
    return false;
  }
  // Vérification du format de l'adresse email
  let emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
  if (!emailPattern.test(mailFormVente)) {
    alert("Veuillez entrer une adresse email valide.");
    return false;
  }
  //Vérification du format du téléphone
  let phonePattern = /^0[1-9]([-. ]?[0-9]{2}){4}$/;
  if (!phonePattern.test(telephoneFormVente)) {
    alert(
      "Veuillez entrer un numéro de téléphone français valide (10 chiffres, format : 06XXXXXXXX ou 05XXXXXXXX)."
    );
    return false;
  }
  if (messageFormVente.trim() === "") {
    alert("Veuillez entrer votre message");
    return false;
  }
  return true;
}

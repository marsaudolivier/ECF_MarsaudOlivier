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
      // Parcourir les données JSON et créer une carte pour chaque annonce
      data.Annonces.forEach((annonce) => {
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
    })
    .catch((error) => {
      console.error(
        "Une erreur s'est produite lors de la récupération des données : ",
        error
      );
    });
}
// Écouter les événements de changement des sliders
document.addEventListener("DOMContentLoaded", function () {
  [snapSlider, snapSliderTwo, snapSliderTrois].forEach(function (slider) {
    slider.noUiSlider.on("update", function () {
      updateResults();
    });
  });
});

document.addEventListener("click", function (event) {
  if (event.target.classList.contains("detailButton")) {
    const annonceId = event.target.getAttribute("data-id");
    fetchDetailAnnonce(annonceId);
  }
});

// fonction pour récupérer les détails de l'annonce
function fetchDetailAnnonce(annonceId) {
  const url = "./api/api_detailAnnonce.php";

  const formData = new FormData();
  formData.append("Id_Annonces", annonceId);

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
          <h3 class="p-5">${premiereAnnonce.titre}</h3>
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
              <p class="p-3 card_text admin_conteneur">Ce modèle vous intéresse hésité pas à nous contacter avec le formulaire suivant:</p>
<div class="p-2">
    <div class="justify-content-center index_text p-2">
        <h2>NOUS CONTACTER</h2>
        <div>
            <form action="/api/api_contact.php" enctype="multipart/form-data" method="POST"  id="formulaireee">
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
                    <input type="hidden" id="Annonce" name="Annonce" value="${premiereAnnonce.titre} | Marque: ${premiereAnnonce.marque} | Modèle: ${premiereAnnonce.modele} | Année: ${premiereAnnonce.annee} | Kilométrage: ${premiereAnnonce.kilometrage}" />
                </div>
                <div class="p-2 FormulaireContact2">
                    <label for="message">message:</label>
                    <textarea id="message" name="message"></textarea>
                </div>
                <button type="submit"  name="Contact" class="ventes_bouton btn btn-primary"> VALIDER</button>
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
      optionsContainer.innerHTML = "<h5>Energies:</h5>";

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


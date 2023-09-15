let snapSlider = document.getElementById('slider-snap');

noUiSlider.create(snapSlider, {
    start: [0,22500],
    snap: true,
    connect: true,
    range: {
        'min': 0,
        '10%': 2500,
        '20%': 5000,
        '30%': 7500,
        '40%': 10000,
        '50%': 12500,
        '60%': 15000,
        '80%': 17500,
        '90%': 20000,
        'max': 22500
    }
});

let snapValues = [
    document.getElementById('slider-snap-value-lower'),
    document.getElementById('slider-snap-value-upper')
];

snapSlider.noUiSlider.on('update', function (values, handle) {
    snapValues[handle].innerHTML = values[handle] + '€';
});

let snapSliderTwo = document.getElementById('slider-snapTwo');

noUiSlider.create(snapSliderTwo, {
    start: [0,225000],
    snap: true,
    connect: true,
    range: {
        'min': 0,
        '10%': 25000,
        '20%': 50000,
        '30%': 75000,
        '40%': 100000,
        '50%': 125000,
        '60%': 150000,
        '80%': 175000,
        '90%': 200000,
        'max': 225000
    }
});

let snapValuesTwo = [
    document.getElementById('slider-snap-value-lowerTwo'),
    document.getElementById('slider-snap-value-upperTwo')
];
snapSliderTwo.noUiSlider.on('update', function (values, handle) {
    snapValuesTwo[handle].innerHTML = values[handle] + 'Km';
});

let snapSliderTrois = document.getElementById('slider-snapTrois');

noUiSlider.create(snapSliderTrois, {
    start: [1950,2024],
    snap: true,
    connect: true,
    step : 1,
    range: {
        'min': 1950,
        '10%': 1970,
        '20%': 1990,
        '30%': 2000,
        '40%': 2005,
        '50%': 2010,
        '55%': 2015,
        '60%': 2016,
        '65%': 2017,
        '70%': 2018,
        '75%': 2019,
        '80%': 2020,
        '85%': 2021,
        '90%': 2022,
        '95%': 2023,
        'max': 2024
    }
});

let snapValuesTrois = [
    document.getElementById('slider-snap-value-lowerTrois'),
    document.getElementById('slider-snap-value-upperTrois')
];
snapSliderTrois.noUiSlider.on('update', function (values, handle) {
    snapValuesTrois[handle].innerHTML = values[handle] ;
});

document.getElementById('reset_prix').addEventListener('click', function () {
    snapSlider.noUiSlider.reset();
});
document.getElementById('reset_km').addEventListener('click', function () {
    snapSliderTwo.noUiSlider.reset();
});
document.getElementById('reset_annee').addEventListener('click', function () {
    snapSliderTrois.noUiSlider.reset();
});

snapSlider.noUiSlider.on('update', function (values, handle) {
    snapValues[handle].innerHTML = values[handle] + '€';
    // Mettre à jour les champs cachés du slider Prix
    document.getElementById('slider_prix_min').value = values[0];
    document.getElementById('slider_prix_max').value = values[1];
});

snapSliderTwo.noUiSlider.on('update', function (values, handle) {
    snapValuesTwo[handle].innerHTML = values[handle] + 'Km';
    // Mettre à jour les champs cachés du slider Kilométrage
    document.getElementById('slider_km_min').value = values[0];
    document.getElementById('slider_km_max').value = values[1];
});

snapSliderTrois.noUiSlider.on('update', function (values, handle) {
    snapValuesTrois[handle].innerHTML = values[handle];
    // Mettre à jour les champs cachés du slider Années
    document.getElementById('slider_annee_min').value = values[0];
    document.getElementById('slider_annee_max').value = values[1];
});

// Requête AJAX pour récupérer les modèles d'une marque
function updateResults() {
    const prixMin = parseInt(document.getElementById('slider_prix_min').value, 10);
    const prixMax = parseInt(document.getElementById('slider_prix_max').value, 10);
    const kmMin = parseInt(document.getElementById('slider_km_min').value, 10);
    const kmMax = parseInt(document.getElementById('slider_km_max').value, 10);
    const anneeMin = parseInt(document.getElementById('slider_annee_min').value, 10);
    const anneeMax = parseInt(document.getElementById('slider_annee_max').value, 10);
  
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
      annoncesContainer.innerHTML = '';
      // Parcourir les données JSON et créer une carte pour chaque annonce
      data.Annonces.forEach((annonce) => {
        const card = document.createElement("div");
        card.classList.add("col");
        card.innerHTML = `
          <div class="card shadow-sm admin_conteneur">
            <img src="${annonce.photo_principal}" alt="" class="index_text">
            <h3>${annonce.titre}</h3>
            <p class="card-text">Année : ${annonce.annee}<br>
              Kilométrage : ${annonce.kilometrage} Km<br>
              Prix : ${annonce.prix} €<br>
              Marque : ${annonce.marque}<br>
              Modèle : ${annonce.modele}
            </p>
          </div>
        `;
  
        annoncesContainer.appendChild(card);
      });
    })
    .catch((error) => {
      console.error("Une erreur s'est produite lors de la récupération des données : ", error);
    });
  
  }
  
  // Écouter les événements de changement des sliders
  document.addEventListener('DOMContentLoaded', function() {
    [snapSlider, snapSliderTwo, snapSliderTrois].forEach(function(slider) {
      slider.noUiSlider.on('update', function () {
        updateResults();
      });
    });
  });


  
//récupération de mon carousel
const carousel = document.getElementById("carousel");
//fonction asynchrone pour le carousel
async function fetchAvis() {
  try {
    const response = await fetch("./api/api_avis.php");
    const avisData = await response.json();
    displayAvis(avisData.avisData); 

    //Interval automatique du carousel a 3000ms
    $(".carousel").carousel({
      interval: 3000,
    });
  } catch (error) {
    console.error("Erreur lors de la récupération des avis :", error);
  }
}
//Affichage carousel
function displayAvis(avisData) {
  let html = `
        <div id="carouselExample" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">`;
//Calcul du nombre d'avis
  const numIterations = Math.ceil(avisData.length / 3);

  for (let i = 0; i < numIterations; i++) {
    const activeClass = i === 0 ? "active" : "";

    html += `
            <div class="carousel-item ${activeClass}">
                <div class="row">`;

    for (let j = i * 3; j < i * 3 + 3; j++) {
      if (avisData[j]) {
        html += `
                    <div class="col-md-4">
                        <div class="index_avis p-2">
                            <h3>Avis Client</h3>
                            <p>${avisData[j].commentaire}</p>
                            <p>${avisData[j].nom} ${avisData[j].prenom}</p>
                            <img src="./assets/images/etoile${avisData[j].note}.svg" alt="Note">
                        </div>
                    </div>`;
      }
    }

    html += `
                </div>
            </div>`;
  }

  html += `
            </div>
            <a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only"></span>
            </a>
            <a class="carousel-control-next" href="#carouselExample" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only"></span>
            </a>
        </div>`;

  carousel.innerHTML = html;
}

fetchAvis();
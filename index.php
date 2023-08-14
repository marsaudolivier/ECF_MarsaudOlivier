<?php
require_once("./templates/header.php");
?>
 <!--Intégration de la Fil ariane-->
 <a href="index.html" class="text-success p-2">Acceuil</a>
 <!--Ajout titre de la page-->
<h2>Bienvenue au Garage 
</br>  V. Parrot</h2>
<!--Ajout photo + style-->
<div class="p-4 d-flex">
  <img src="./assets/images/index1.jpg" alt="Notre mécanicien en pleine mécanique" class="index_image">
</div>
<!-- Ajout du premier paragraphe -->
<div class="index_text p-1 m-3">
  <p class="p-4">
    Vous cherchez un garage de confiance pour entretenir, réparer ou vendre votre voiture ? Ne cherchez plus ! Garage V. Parrot est là pour répondre à tous vos besoins en matière d'automobile.
  </br></br>
Fondé par Vincent Parrot, un professionnel de l'automobile avec plus de 15 ans d'expérience, notre garage est spécialisé dans la réparation de la carrosserie et de la mécanique des voitures, ainsi que dans leur entretien régulier pour garantir leur performance et leur sécurité. Nous mettons également en vente des véhicules d'occasion pour répondre à tous les besoins et tous les budgets.
</br></br>
Chez Garage V. Parrot, nous sommes passionnés par les voitures et nous mettons tout en œuvre pour offrir à nos clients un service de qualité, personnalisé et de confiance. Nous sommes convaincus que chaque voiture mérite les meilleurs soins, et c'est pourquoi nous nous engageons à fournir un service de qualité à chaque client.
</br></br>
Notre équipe de professionnels est composée d'experts en mécanique et en carrosserie, qui sont formés pour travailler sur tous les types de voitures, des plus anciennes aux plus récentes. Nous sommes équipés des dernières technologies et des outils les plus performants pour garantir un travail de qualité et une réparation rapide et efficace.
</br></br>
Nous comprenons que la réparation d'une voiture peut être stressante et coûteuse. C'est pourquoi nous offrons à nos clients un service personnalisé et transparent, avec des devis clairs et des explications détaillées sur les travaux à effectuer. Nous sommes également à l'écoute de nos clients et nous nous engageons à répondre à toutes leurs questions et à leurs préoccupations.
</br></br>
Chez Garage V. Parrot, nous sommes fiers de notre réputation de garage de confiance. Nous considérons notre atelier comme un véritable lieu de confiance pour nos clients, et nous sommes déterminés à maintenir cette réputation en offrant un service de qualité supérieure à chaque client.
</br></br>
Nous savons que la concurrence est rude dans l'industrie automobile, et c'est pourquoi nous avons décidé de créer une application web vitrine pour notre garage. Nous voulons mettre en avant la qualité de nos services et notre engagement envers nos clients. Nous sommes convaincus que notre application web vitrine sera un outil essentiel pour nous aider à nous faire connaître et à attirer de nouveaux clients.
</br></br>Alors, si vous cherchez un garage de confiance pour entretenir, réparer ou vendre votre voiture, ne cherchez plus ! Garage V. Parrot est là pour répondre à tous vos besoins en matière d'automobile. Contactez-nous dès maintenant pour prendre rendez-vous ou pour en savoir plus sur nos services. Nous sommes impatients de vous accueillir dans notre atelier et de prendre soin de votre voiture.
  </p>
</div>
<!--Ajout photo + style-->
<div class="p-4 d-flex">
  <img src="./assets/images/index2.jpg" alt="Notre mécanicien, en train de sérré une rotule" class="index_image">
</div>
<div class="index_text p-1 m-3">
  <h2 class="p-4">Nos services</h2>
</div>
<?php
require_once("lib/Services.php");
Services($pdo);
require_once("lib/avis.php");
Avis($pdo);
require_once("lib/contact.php");
Contact();
?>
  <div class="p-2"></div>
    <iframe class="map d-flex"
      src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d92456.53572705481!2d1.3504421381672491!3d43.600987421638955!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1stoulouse%20mairie!5e0!3m2!1sfr!2sfr!4v1690831922678!5m2!1sfr!2sfr"
      width="500" height="300" allowfullscreen="auto" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
      title="Carte de toulouse"></iframe>

    <div class="p-2 index_adresse">
      <h3>1 Rue du garage fictif</br>
        toulouse</h3>
    </div>
<?php
require_once("./templates/footer.php");
?>
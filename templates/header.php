<?php
require("./lib/pdo.php");
require("./lib/config.php");
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Venez découvrir chez Garage V. Parrot des services automobiles de qualité supérieure et un savoir-faire inégalé depuis 2021. 
    Nous sommes votre partenaire de confiance pour l'entretien, la réparation et la maintenance de votre véhicule. Prenez soin de votre voiture avec notre équipe expérimentée. 
    Demandez un devis dès aujourd'hui">
  <!-- Content-Security-Policy avec googlemap et script CDN -->
  <meta http-equiv="Content-Security-Policy" content="default-src 'self'; style-src 'self' https://fonts.googleapis.com 'unsafe-inline'; font-src 'self' https://fonts.gstatic.com; img-src https://* data: blob:; child-src 'self' https://www.google.com; script-src 'self' https://cdn.jsdelivr.net https://code.jquery.com 'unsafe-inline';">
  <title>Garage V. Parrot</title>
  <!-- CSS + Font Aref Rugaa usage de SAss pour compilation donc besoin que de main.css  -->
  <link rel="stylesheet" href="./styles/main.css">
  <link href="https://fonts.googleapis.com/css2?family=Aref+Ruqaa+Ink&family=Great+Vibes&display=swap" rel="stylesheet">
</head>

<body>
  <!--Intégration de la navbar Responsive-->
  <header class="navigation_bandeau d-flex">
    <img src="./assets/images/Logo Parrot.svg" class="logo" alt="Logo de notre garage V parrot">
    <h1 class="d-flex align-items-center text-center p-2">Garage
      V. Parrot</h1>
    <nav class="navbar navbar-expand-lg navbar-info text-info" data-bs-theme="dark">
      <a class="navbar-brand" href="../index.php"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-border-width" viewBox="0 0 16 16">
  <path d="M0 3.5A.5.5 0 0 1 .5 3h15a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5H.5a.5.5 0 0 1-.5-.5zm0 5A.5.5 0 0 1 .5 8h15a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H.5a.5.5 0 0 1-.5-.5zm0 4a.5.5 0 0 1 .5-.5h15a.5.5 0 0 1 0 1H.5a.5.5 0 0 1-.5-.5"/>
</svg>
      </button>
      <div class="collapse navbar-collapse text-primary navigation_link" id="navbarNavAltMarkup">
        <div class="navbar-nav">
          <?php foreach ($mainMenu as $key => $value) { ?>
            <a class="navigation_link navbar-text" href="<?= $key ?>"><?= $value ?></a>
          <?php } ?>
        </div>
      </div>
    </nav>
  </header>
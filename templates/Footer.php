<?php
require_once('./lib/horaires.php');
?>
<!--Ajout Pied de page-->
<div class="d-flex footer_bandeau text-center text-uppercase p-3">
    <div class="row col-12">
        <div class="col-12 col-md-5">
            <!-- Horaire du garage -->
            <h3 class="text-success">Horaires d’ouverture</h3>
            <?php horaires($pdo); ?>
        </div>
        <!-- Ajout logo + social -->
        <img class="col-0 col-md-2 logo_footer hidden" src="../assets/images/Logo Parrot.svg" alt="Logo Garage V. Parrot"></img>
        <div class="col-12 col-md-5 p-3">
            <h3 class="text-danger text-uppercase align-items-center text-center">Contacter Nous</h3>
            <p class="text-info">Garage V. Parrot</br>
                1 rue du garage</br>
                Toulouse</br>
                05 46 00 00 00</br>
            <div class="hidden">
                <a href="https://www.twitter.com/" title="Notre twitter">
                    <img src="../assets/images/twitter.svg" height="35px" width="35px">
                </a>
                <a href="https://www.facebook.com/" title="Notre Facebook">
                    <img src="../assets/images/facebook.svg" height="35px" width="35px" class=>
                </a>
                <a href="https://www.instagram.com/" title="Notre instagram">
                    <img src="../assets/images/instagram.svg" height="35px" width="35px">
                </a>
            </div>
        </div>
        <div class="col-12 text-success text-center p-1">
            <a class="navigation_link navbar-text p-5" href="cookies.php">politique des cookies</a>
            <a class="navigation_link navbar-text p-5" href="MentionsLegales.php">Mentions Légales</a>
        </div>
        <!-- Signature bas de page -->
        <div class="col-12 text-success text-center p-1">
            ECF Mr Marsaud Olivier
        </div>
    </div>

</div>
<!--Ajout JS-->
<?php // Ajout condition pour chargement des fichiez JS
if (isset($_SERVER["SCRIPT_NAME"]) && $_SERVER["SCRIPT_NAME"] == "/adminVoitures.php") { ?>
    <script src="../scripts/adminVoitures.js"></script>
<?php } ?>
<?php
if (isset($_SERVER["SCRIPT_NAME"]) && $_SERVER["SCRIPT_NAME"] == "/index.php") { ?>
    <script src="../scripts/formulaires.js"></script>
<?php } ?>
<?php
if (isset($_SERVER["SCRIPT_NAME"]) && $_SERVER["SCRIPT_NAME"] == "/ventes.php") { ?>
    <script src="../scripts/nouislider.min.js"></script>
    <script src="../scripts/ventesVoitures.js"></script>
<?php } ?>
<?php
if (isset($_SERVER["SCRIPT_NAME"]) && $_SERVER["SCRIPT_NAME"] == "/adminContacts.php") { ?>
    <script src="../scripts/adminContact.js"></script>
<?php } ?>
<?php
if (isset($_SERVER["SCRIPT_NAME"]) && $_SERVER["SCRIPT_NAME"] == "/adminHoraires.php") { ?>
    <script src="../scripts/FormAdminHoraires.js"></script>
<?php } ?>
<?php
if (isset($_SERVER["SCRIPT_NAME"]) && $_SERVER["SCRIPT_NAME"] == "/adminUtilisateurs.php") { ?>
    <script src="../scripts/FormAdminUtilisateurs.js"></script>
<?php } ?>
<?php
if (isset($_SERVER["SCRIPT_NAME"]) && $_SERVER["SCRIPT_NAME"] == "/adminServices.php") { ?>
    <script src="../scripts/FormAdminServices.js"></script>
<?php } ?>
<?php
if (isset($_SERVER["SCRIPT_NAME"]) && $_SERVER["SCRIPT_NAME"] == "/adminAvis.php") { ?>
    <script src="../scripts/FormAdminAvis.js"></script>
<?php } ?>
<?php
if (isset($_SERVER["SCRIPT_NAME"]) && $_SERVER["SCRIPT_NAME"] == "/index.php") { ?>
    <script src="../scripts/indexAvis.js"></script>
<?php } ?>
<script src="vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>
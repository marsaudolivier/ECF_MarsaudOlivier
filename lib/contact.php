<?php

function Contact(){
   ?> <div class="p-2">
      <div class="justify-content-center index_text p-2">
        <h2>NOUS CONTACTER</h2>
        <div>
          <div class="FormulaireContact">
            <label for="name" class="text-primary">Nom:</label>
            <input type="text" id="name" name="name" />
            <label for="name" class="text-primary">Prenom:</label>
            <input type="text" id="nom" name="name" />
          </div>
          <div class="FormulaireContact">
            <label for="email" class="text-primary">Email:</label>
            <input type="text" id="email" name="email" />
            <label for="phone" class="text-primary">Telephone:</label>
            <input type="text" id="phone" name="phone" />
          </div>
          <div class="FormulaireContact">
            <label for="subject" class="text-primary">Votre demande:</label>
            <select id="subject" name="subject" class="text-primary">
              <option value="achat">Achat</option>
              <option value="vente">Vente</option>
              <option value="location">Location</option>
              <option value="autre">Autre</option>
            </select>
          </div>
          <div class="p-2 FormulaireContact2">
            <label for="message">Message:</label>
            <textarea id="message" name="message"></textarea>
          </div>
          <button type="button" id="Sudmit" class="ventes_bouton btn btn-primary"> VALIDER</button>

        </div>
      </div>
    </div>
    <?php
}

# ECF MARSAUD olivier
Bonjour mon Nom est Marsaud Olivier, Actuellement en train de préparé ma certification DWWM.

Ce "site", est mon ECF, sur le sujet garage de mr V Parrot.





## Installation en local
1- Téléchargement et installation de mon Repo.

- Pour commencé il sera nécéssaire de clone mon projet.

```bash
git clone https://github.com/marsaudolivier/ECF_MarsaudOlivier
```
- Une foi clone placé vous dans le dossier de mon ECF pour installé grace a composer les dépendance nécéssaire a l'éxécution en local.
```bash
composer install
```
2- Installation de la BDD.
- Pour commencé récupéré l'ensemble des donnés sur le Repo SQL .
https://github.com/marsaudolivier/ECF_SQL_MarsaudO

- Pour la création en local, lancé votre serveur Apache via Wamp, Xamp ou autres.
Une fois lancé créée la base de données Exemple : marsaudolivier_garageparrot.

Puis utilisé le fichier Parrot.SQL, et installé dans votre base de données l’ensemble des tables présentes.

Ensuite nous allons créer l’utilisateurs VParrot : Exécuté le fichier CréationCompteMrParrot.php avec votre serveur APache une foi les données $user, $pass, $host, $port configuré (suivre les commentaires du code.)

Il Sera ensuite possible d’importer les données fictive présente dans le fichier : donnée_fictive_Parrot.sql .

### Lancement du site 

Vous pouvez désormais lancer le fichier index.php présent dans le repo du projet.
## Site déployé

Vous trouverez le site déployé sur alwaysdata a l'adresse suivante:

https://marsaudolivier.alwaysdata.net/

## Charte graphique

![Charte graphique](Livrable_studi\Visuel\CharteGraphique.png)

- Charte graphique vue mobile:
https://www.figma.com/file/rTPY9yQ7WFo9G3DD6w6OPZ/Parrot--V2?type=design&node-id=0-1&mode=design
- Charte graphique vue desktop:
https://www.figma.com/file/rTPY9yQ7WFo9G3DD6w6OPZ/Parrot--V2?type=design&node-id=36-24548&mode=design

## Authors

- [@Marsaudolivier](https://github.com/marsaudolivier)


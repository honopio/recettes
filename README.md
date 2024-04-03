## Guide d'installation du projet 
avec toutes les commandes à exécuter et les fichiers à configurer : git clone ... , composer install, npm install, modification du fichier .env, lancement des migrations, lancement du ou des serveurs, etc. 

### Clone du git, Gestionnaire de dependances, environnement de travail et generation de l'application key 
    git clone git@github.com:MIASHS-UGA-PWS/pws-projet-2024-recettes-lecire_piolat.git
    composer install
    cp .env.example .env    
    php artisan key:generate

### Inertia vue.js, installation et lancement du serveur
    npm install
    npm run dev

### Captcha Service Provider
    composer require mews/captcha

## Setup Sqlite
    DB_DATABASE=/ABSOLUTE_PATH/database/database.sqlite
    # DB_CONNECTION=mysql
    # DB_HOST=127.0.0.1
    # DB_PORT=3306
    # DB_DATABASE=larasite
    # DB_USERNAME=root
    # DB_PASSWORD=ic2a

### Lancement des migrations et seed
    php artisan migrate
    php artisan db:seed

### Lancement du serveur
    php artisan serve

## Parties implémentées
- Gestion des commentaires: formulaire + affichage liste
- Formulaire Captcha pour protéger le formulaire de contact
- Gestion des ingrédients et des tags
- Barre de recherche fonctionnelle
   - une recherche retourne toutes les recettes qui ont le contenu recherché dans leur titre, ingrédients, ou tags.
- affichage des notes et post des notes
TODO : AJAX + Admin

pour chaque partie de brèves instructions de ce que je dois tester (URL des pages à visiter, boutons à cliquer, commandes à lancer dans un terminal, etc)

## Fonctionnalités implémentées
ex: 4 - Ajout de rôles utilisateurs - Puis détails de ce que je dois faire pour tester ou vérifier

## Remarques
Optionnel

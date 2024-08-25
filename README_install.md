/!\ Exécuter les commandes sous Windows PowerShell, exécuté en tant qu'administrateur /!\
Ou Terminal sur Linux

Prérequis : 
- Avoir PHP à jour
- Installer composer : https://getcomposer.org/download/
- Installer Scoop : https://scoop.sh/ 
- Installer scoop avec COMMANDE 1: Set-ExecutionPolicy -ExecutionPolicy RemoteSigned -Scope CurrentUser
- Installer scoop avec COMMANDE 2: Invoke-RestMethod -Uri https://get.scoop.sh | Invoke-Expression
- Installer Node.js commande : scoop install nodejs
- Installer Symfony avec scoop : scoop install symfony-cli
- Aller à la racine du projet : cd chemin-projet
- Installer Webpack Encore : composer require symfony/webpack-encore-bundle
- Installer Tailwind CSS COMMANDE 1: npm install -D tailwindcss postcss postcss-loader autoprefixer
- Installer Tailwind CSS COMMANDE 2: npx tailwindcss init -p
- Effectuer la commande : npm run dev
- Installer Doctrine COMMANDE 1: composer require symfony/orm-pack
- Installer Doctrine COMMANDE 2: composer require --dev symfony/maker-bundle
- Créer la base de donnée (nom créé grâce au contenu du .env): php bin/console doctrine:database:create
- Migration Doctrine (tables...) COMMANDE 1: php bin/console make:migration
- Migration Doctrine (tables...) COMMANDE 2: php bin/console doctrine:migrations:migrate
- Importer les données du fichier .sql (fourni avec le projet) 

/!\ Exécuter les commandes sous Windows PowerShell, exécuté en tant qu'administrateur /!\
Ou Terminal sur Linux

Prérequis : 
- Avoir PHP à jour
- Installer composer : https://getcomposer.org/download/
- Installer Scoop : https://scoop.sh/ 
(commande scoop :
Set-ExecutionPolicy -ExecutionPolicy RemoteSigned -Scope CurrentUser
Invoke-RestMethod -Uri https://get.scoop.sh | Invoke-Expression
)
- Installer Node.js commande : scoop install nodejs
- Installer Symfony avec scoop : scoop install symfony-cli
- Aller à la racine du projet : cd chemin-projet
- Installer Webpack Encore : composer require symfony/webpack-encore-bundle
- Installer Tailwind CSS : npm install -D tailwindcss postcss postcss-loader autoprefixer
                           npx tailwindcss init -p
Effectuer la commande : npm run dev
Installer Doctrine : composer require symfony/orm-pack
                     composer require --dev symfony/maker-bundle
Créer la base de donnée (nom créé grâce au contenu du .env): php bin/console doctrine:database:create
Migration Doctrine (tables...): php bin/console make:migration
                                php bin/console doctrine:migrations:migrate
Importer les données du fichier .sql (fourni avec le projet) 

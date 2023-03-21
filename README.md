
# Amanie Cosmetics
----------------

## Contents
-   [Requirements](#-requirements)
-   [Configuration](#-configuration)
-   [Building your app](#-building-your-app)

## 📋 Requirements
- :elephant: PHP >= 8.2
- MariaDB = 10.5
- Composer = 1.10.19

## :gear: Configuration
0. Create a .env file on the folder
1. Override .env with create .env.local 
2. Update the variables on the .env.local at your environement 


## 🎉 Building your app  
1. Installer les dependances à l'aide de la commande `composer install`
2. Importer le script SQL dans votre SGBD `amanie_cosmetics.sql` OU utiliser les migrations
3. Verifier la valeur de la variable d'environement DATABASE_URL dans le .env 
4. Lancer le serveur Symfony à l'aide de la commande `symfony serve`

## Default Credentials 
1. Compte USER
Email : test@test.fr
Password: test
2. Compte Admin
Email : admin@admin.fr
Password: admin
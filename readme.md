## Music Vercors Festival V2

### Objectif et consignes du projet

L'objectif est de développer une nouvelle version du projet "Vercors Music Festival", en ajoutant au formulaire de réservation précedemment créé une base de données relationnelle.

Le projet doit respecter les consignes suivantes :
1. Respecter le design pattern MVC
2. Conserver les informations en base de données
3. Les visiteurs doivent pouvoir s'inscrire, se connecter et voir leurs réservations.
4. Les administrateurs doivent pouvoir voir toutes les réservations, les modifier et les supprimer.
5. Chaque réservation doit envoyer un mail de confirmation à l'utilisateur.
6. Le MCD doit être cohérent et permettre des évolutions.
7. Les champs sont nettoyés et protégés contre les injections SQL.

Pour réaliser ce projet nous avons utilisé la structure MVC, la création de base de données relationnelle en se basant sur des schémas MLD et MCD, ainsi que les requêtes SQL. 

### Config.php

Pour que le projet fonctionne, il faut modifier les informations contenues dans le fichier config.php qui se trouve à la racine du projet.

```php
        //config.php file content
        //Remplacer 'localhost' par l'adresse de votre base de données
        define('DB_HOST', 'localhost');
        //Remplacer 'vercors' par le nom de votre base de données
        define('DB_NAME', 'vercors');
        //Remplacer 'vercors' par votre nom d'utilisateur
        define('DB_USER', 'vercors');
        //Remplacer 'vercors' par votre mot de passe
        define('DB_PWD', 'vercors');
        //Remplacer 'vercors_' par le préfixe défini dans votre base de données s'il y en a un 
        define('PREFIXE', 'vercors_');
        
        define('HOME_URL', '/');

        //'DB_INITIALIZED' doit être défini à FALSE lors de la première initialisation du projet
        define('DB_INITIALIZED', FALSE);
```
### Migration

A la première initialisation du projet, le fichier Vercors-database.sql est chargé.
Ce fichier se trouve dans le dossier src/Migrations. 
Pour modifier la structure ou le contenu de la base de données, il faut éditer ce fichier. 

### Utilisateur par défaut Admin

La base de données est initialisée avec un utilisateur par défaut qui se nomme Admin :
1. Mail : admin@admin.admin
2. Password : admin

### Fichiers utiles

1. Le fichier MCD se trouve dans le dossier Ressources. 

### Versions

Ce projet a été créé avec :
1. PHP 8.3.2
2. MySQL 5.7 (Although it can work with PHP versions from 8.x)


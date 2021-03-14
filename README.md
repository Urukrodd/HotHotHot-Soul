# HotHotHot !

HotHotHot est une application web conçue en PHP et JavaScript qui dont le but est être un interface d'information et de gestion d'un système domotique.

## Installation

Nous utilisons une base de données MYSQL avec PhpMyAdmin et un serveur composé de PHP 8.0 et Apache.
Pour la base de données, PHP et Apache, il est possible de passer par un WAMP ou de l'installer localement.

NB : Avant de lancer l'application, il faut effectuer les migrations (`php migrations.php` à la racine de l'application), et installer Composer (`composer install` à la racine de l'application). PHP 8 est obligatoire pour effectuer ces migrations.

La configuration de la base de données se fait dans le .env (un .env.example est disponible pour donner la syntaxe à suivre).
La manière la plus simple de lancer l'application métier est d'effectuer un `php -S [monaddresse]` depuis le dossier `public/` du framework. 

### Lancer l'application

> :warning: **Attention**: faites attention à toute application qui pourrait utiliser le port 80, 8080 ou 3306! Cela peut perturber le bon déroulementde l'application.

Pour lancer l'application, il vous faudra taper ces commandes depuis la racine du projet : 

```
composer install
```

```
php migrations.php
```

```
cd public/
php -S [monaddresse]
```

### Comptes Utilisateurs

L'application se trouve sur [le port 80](http://localhost:80). Pour accéder directement à la base de données, cela se
passe sur [le port 3306](http://localhost:3306). Pour accéder à la base de données avec PhpMyAdmin, il faut vous rendre
sur [le port 8080](http://localhost:8080).

L'appplication ne marche qu'avec un type de fichier qui est le XLSX. Pour que tout marche, veuillez utiliser
ce [template](https://drive.google.com/file/d/1yrEBeDg6ypIsj1i8ccbXeVn_YEbebCZF/view?usp=sharing)

> Il se trouve aussi à la racine du projet sous le nom de list.xlsx

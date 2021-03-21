# HotHotHot !

HotHotHot est une application web conçue en PHP et JavaScript qui dont le but est être un interface d'information et de gestion d'un système domotique.

## Installation

Nous utilisons une base de données MYSQL avec PhpMyAdmin et un serveur composé de PHP 8.0 et Apache. Pour la base de données, PHP et Apache, il est possible de passer par un WAMP ou de l'installer localement.

NB : Avant de lancer l'application, il faut effectuer les migrations (`php migrations.php` à la racine de l'application), et installer Composer (`composer install` à la racine de l'application). PHP 8 est obligatoire pour effectuer ces migrations.

La configuration de la base de données se fait dans le .env (un .env.example est disponible pour donner la syntaxe à suivre). La manière la plus simple de lancer l'application métier est d'effectuer un `php -S [monaddresse]` depuis le dossier `public/` du framework.


### Lancer l'application

> :warning: **Attention**: fermez WAMP ou tout autres logiciel utilisant le port 80, 8080 ou 3306!

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

### Créer un compte utilisateur

Pour créer un compte utilisateur, il faut utiliser la commande :

```
php core/Commands/createSimpleUser.php username email password
```

### Créer un compte Super utilisateur

Pour créer un compte super utilisateur, il faut utiliser la commande :

```
php core/Commands/createSuperUser.php username email password
```


### Générer et regénerer la documentation

Pour générer la documentation : 
- S'assurer de la présence de fichiers Markdown (.md) dans `/doc/markdown`.
Ensuite exécuter la commande

```
php soulGen.php
```
La documentation sera générée dans `public/docs/` et accessible depuis la partie "documentation du site".

### Utilisation

L'application se trouve sur [le port 80](http://localhost:80). Pour accéder directement à la base de données, cela se
passe sur [le port 3306](http://localhost:3306). Pour accéder à la base de données avec PhpMyAdmin, il faut vous rendre
sur [le port 8080](http://localhost:8080).

L'appplication ne marche qu'avec un type de fichier qui est le XLSX. Pour que tout marche, veuillez utiliser
ce [template](https://drive.google.com/file/d/1yrEBeDg6ypIsj1i8ccbXeVn_YEbebCZF/view?usp=sharing)

> Il se trouve aussi à la racine du projet sous le nom de list.xlsx

## Créer une page Web

Afin de créer une page web, vous devez réaliser plusieurs étapes. Vous devez d'abord créer votre Controller et votre Model. Puis ensuite la View et enfin l'indexation.

### Controller

Vous devez tout d'abord créer un ```controller.php``` dans ```/controllers```.
- Dans chaque controller.php vous devez, au minimum, mettre c'est ligne ci-dessous:

```
namespace app\controllers;
use app\core\Application;
use app\core\Controller;

class NomControlleur extend Controller {
    // TODO
}
```

Vous devez ensuite créer une fonction qui va afficher la View.

- Il y a 2 façons d'afficher votre vue. Soit l'afficher sans données:

```
public function index(): string
{
    // TODO
    return $this->render('le_nom_de_votre_view.html.twig');
}
```

- Si vous souhaitez passer des valeurs en paramètre de retour, vous pouvez aussi passer un ```array()``` en second paramètre dans la fonction de retour.

```
public function index(): string
{
    // TODO
    return $this->render('le_nom_de_votre_view.html.twig', array(
        "Cle 1" => "Valeur 1",
        "Cle 2" => "Valeur 2",
        "Cle 3" => ....
    ));
}
```

### Model

Vous pouvez créer un model si vous le souhaitez. Vous devrez créer ce ```model.php``` dans ```/models```.

- Afin de créer votre ```Model```, vous devrez mettre ces lignes ci-dessous:

```
namespace app\models;
use app\core\Application;

class NomModel {
    // TODO
}
```

> Votre model doit avoir le **même nom** que votre ```model.php```.

### View

Pour afficher notre page web, nous utilisons [Twig](https://twig.symfony.com/) qui est un moteur de templates pour le langage de programmation PHP.

- Pour créer votre ```View```, vous devez créer votre ```view.html.twig``` dans ```/views``` puis l'appeler comme vu précédemment. 

> **Attention !!** Vos fichiers doivent **obligatoirement** avoir comme suffixe " .html.twig".

### Indexation

Enfin, une fois le ```Model```, la ```View```et le```Controller``` créé, il ne reste plus qu'a créer la route dans le fichier ```index.php``` qui se trouve dans ```/public```.

Il y a deux façons differentes pour afficher la page web.

- Si vous voulez afficher seulement une ```View``` sans ```controller``` alors vous pouvez ajouter cette ligne dans ```index.php```:

```
$app = new Application(dirname(__DIR__), $config);

$app->router->get('/route', 'view.html.twig');

$app->run();
```

- Si vous voulez utiliser un ```Controller```:

```
$app = new Application(dirname(__DIR__), $config);

$app->router->get('/route', [Controller::class, 'index']);

$app->run();
```

En premier argument de la fonction ```get()```, vous devez renseigner l'**URL** que vous voulez utiliser.
Le second argument de ```get()``` renseigne soit la ```View``` à afficher, soit le ```Controller``` et la ```fonction``` à utiliser.

> Vous pouvez aussi utiliser la fonction ```post()``` au lieu de ```get()```. Les arguments de la fonction sont les mêmes.

# Base de données

## Connexion à la base de données

Pour vous connecter à la base de données, vous devez créer un fichier ```.env``` à la racine de votre pojet en vous servant de ```.env.example```.

```
DATABASE_HOST=host
DATABASE_NAME=dbname
DATABASE_USER=user
DATABASE_PASSWORD=password
DATABASE_PORT=3306
```

## Migrations

Le Framework possède un système de migration.
Dans ```/migrations/m0001_initial.php``` vous pouvez ajouter toute vos requetes SQL que vous voulez executer lors de la création de votre Framework.


## Installation

Le projet PageTypeToPrint utilise le langage PHP pour transformer le texte saisi au format markdown en HTML, afin de pouvoir l’afficher dans un navigateur web, et en générer un PDF imprimable, via Paged.js et les fonctionnalités internes des navigateurs (Chrome ou Chromium, pour le moment).

Téléchargez le code du projet [en cliquant ici](https://github.com/esadpyrenees/PageTypeToPrint/zipball/main/). 

Le dossier _PageTypeToPrint_ doit être décompressé dans un environnement de serveur web local bénéficiant d’une version de PHP supérieure à 8.0 (voir [ci-dessous](#version-de-php)).
Une fois décompressé, le dossier _PageTypeToPrint_ doit être placé dans le dossier `htdocs`.

Si vous pouvez démarrer un serveur web local avec PHP 8, passez à [Configuration et contenu](contenu.md). 

Sinon, poursuivez ci-dessous…


## En détails

Sur un ordinateur “domestique“, on peut installer un esnemble de logiciels qui intègre les différents fonctionnalités d’un serveur web. On parle alors de serveur local ou de serveur de développement.

Les outils les plus simples à utiliser sont : [MAMP](https://www.mamp.info/en/downloads/), [WAMP](https://www.wampserver.com/) et [Xampp](https://www.apachefriends.org/fr/index.html).

Alternativement, si PHP est installé, dans un terminal :

```sh
cd votre/dossier/de/travail/PageTypeToPrint
php -S localhost:8888  
# cette commande permet d’accéder à la page web sur http://localhost:8888
```


### AMP ?

L’accronyme AMP signifie Apache + MySQL + PHP.

* Apache est un _serveur web_ : le serveur HTTP répond aux requêtes et transmet les pages Web.
* MySQL (ou Maria DB) et un _Serveur de base de données_.
* PHP est un langage de script : il va permettre d’effectuer des opérations sur le seveur et fabriquer des pages HTML.

### M / W / X + AMP

- [M(AMP)](https://www.mamp.info/en/downloads/) est utilisable sur Mac (originellement) et sur Windows
- [W(AMP)](https://www.wampserver.com/) Server est dédié à Windows
- [X(AMP)p](https://www.apachefriends.org/fr/index.html) est multiplateforme (à utiliser si les deux autres ne fonctionnent pas sur votre ordinateur) 

### MAMP ou Xampp?

[MAMP](https://www.mamp.info/en/downloads/) est l’outil le plus simple. Il s’installe comme une application habituelle (double-clicker sur l’installeur puis suivre les étapes), avec comme spécificité sur Windows de préférer être installé à la racine du disque dur, dans un dossier `C:\\MAMP` ou `C:\\Xampp`. Xampp n’est guère plus compliqué à installer mais offre une interface moins simple.

Attention à ne pas installer MAMP Pro (inutile dans ce contexte, et payant).

L’installation génère un sous-dossier nommé `htdocs` qui est destiné à stocker vos sites web locaux. Sur OSX et MAMP, ce dossier est situé dans `Applications/MAMP/htdocs`, sur Windows dans `C:\\MAMP\htdocs` ou `C:\\Xampp\htdocs`. Cet emplacement est configurable dans les préférences de MAMP ou Xampp.

C’est dans ce dossier qu’il convient de décompresser le code de PageTypeToPrint, afin de pouvoir le visualiser dans un navigateur web.

### Démarrer

Une fois l’application de serveur installée, il faut la démarrer : “Démarrer les serveurs” avec MAMP ou “Apache > Start” avec Xampp.

Le site devient alors accessible à l’adresse `http://localhost/PageTypeToPrint` ou `http://localhost:8888/PageTypeToPrint` si le **port** d’Apache est configuré sur 8888 (c’est parfois le cas par défaut).

### Version de PHP

Si rien ne s’affiche (ou seulement le sommaire du document), la version de PHP est vraisemblablement inférieure à 8.0. MAMP et XAMPP permettent de configurer cette version dans leur paramètres.


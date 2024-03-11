
## Installation

Téléchargez le projet :

<a class="bigbutton" href="https://github.com/esadpyrenees/PageTypeToPrint/zipball/main/">↓ Code source </a> 

Le fichier doit être décompressé dans un environnement de serveur web bénéficiant d’une version de PHP supérieure à 8.0 (par exemple, le dossier `htdocs` dans MAMP ; voir ci-dessous).

Si vous pouvez démarrer un serveur web local avec PHP 8, passez à : 

<a class="bigbutton" href="../contenu">→ Configuration et contenu</a> 

Sinon, poursuivez ci-dessous…


## En détails

 _PageTypeToPrint_ utilise PHP, un langage web qui s’exécute du côté du serveur, disponible chez l’immense majorité des hébergeurs web.

Sur un ordinateur “domestique“, on peut installer un logiciel qui intègre les différents fonctionnalités d’un serveur web. On parle alors de _serveur local_ ou de _serveur de développement_.

Les outils les plus simples à utiliser sont [Herd](https://herd.laravel.com/) ou [MAMP](https://www.mamp.info/en/downloads/), utilisables sur Mac OS et sur Windows, et [XAMPP](https://www.apachefriends.org/fr/index.html), multiplateforme (à utiliser si Herd et MAMP ne fonctionnent pas sur votre ordinateur).


### Herd, MAMP ou Xampp?

[Herd](https://herd.laravel.com/) est une application de serveur local récente qui, à partir de la saisie d’un dossier de base (où l’on veut dans l’arborescence du disque dur) servira chaque sous dossier à l’URL [http://mon-sous-dossier.test](#). Voir la [documentation](https://herd.laravel.com/docs/1/getting-started/paths). 

[MAMP](https://www.mamp.info/en/downloads/) s’installe comme une application habituelle (double-clicker sur l’installeur puis suivre les étapes), avec comme spécificité sur Windows de s’installer à la racine du disque dur, dans un dossier `C:\\MAMP` ou `C:\\Xampp`. Xampp n’est guère plus compliqué à installer mais offre une interface moins simple.

Attention à ne pas installer MAMP Pro (inutile dans ce contexte, et payant).

L’installation génère un sous-dossier nommé `htdocs` qui est destiné à stocker vos sites web locaux. Sur OSX et MAMP, ce dossier est situé dans `Applications/MAMP/htdocs`, sur Windows dans `C:\\MAMP\htdocs` ou `C:\\Xampp\htdocs`. Cet emplacement est configurable dans les préférences de MAMP ou Xampp.

C’est dans ce dossier qu’il convient de décompresser le code de PageTypeToPrint, afin de pouvoir le visualiser dans un navigateur web.

### Démarrer

Une fois l’application de serveur installée, il faut la démarrer : “Démarrer les serveurs” avec MAMP ou “Apache > Start” avec Xampp.

Le site devient alors accessible à l’adresse `http://localhost/PageTypeToPrint` ou `http://localhost:8888/PageTypeToPrint` si le **port** d’Apache est configuré sur 8888 (c’est parfois le cas par défaut).

### Version de PHP

Si rien ne s’affiche (ou seulement le sommaire du document), la version de PHP est vraisemblablement inférieure à 8.0. MAMP et XAMPP permettent de configurer cette version dans leur paramètres.


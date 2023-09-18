## Thème

Le thème par défaut (`theme/esadpyrenees`) contient deux dossiers – pour les scripts `js` et les feuilles de style `CSS` – et trois fichiers: `body.php`, `print_head.php` et `screen_head.php`.

### Modifier le thème

Pour modifier l’apparence des documents, il est possible de dupliquer le thème par défaut, pour être en mesure d’éditer à la fois les styles graphiques, les scripts et la structure HTML du document.

#### body.php

Ce fichier contient l’ensemble de la structure HTML du document.

Les contenus HTML des versions écran et imprimable sont identiques par défaut, mais il est possible de les différencier en utilisant une condition :
```php
// à la place de :
include( "$theme_url/body.php" );
// utiliser :
include( isset($_GET["print"]) ? "$theme_url/print_body.php" : "$theme_url/screen_body.php");
```

#### print_head.php

Ce fichier contient l’ensemble des styles et des scripts nécessaires à l’affichage écran.

#### screen_head.php

Ce fichier contient l’ensemble des styles et des scripts nécessaires à l’impression, notamment, l’appel à la librairie __paged.js__.
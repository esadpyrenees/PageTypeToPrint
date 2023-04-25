


## Templates

Les différents gabarits, ou *templates*, sont:

* *default* : le gabarit de base.
* *appendices* : le gabarit pour les annexes générales et l’iconographie.
* *interview* : le gabarit pour les entretiens. 
* *references* : le gabarit pour les références, bibliographie, sitographie, etc.

Les logiques de _templates_ peuvent être étendues pour prendre en charge d’autres logiques de mise en page. Voir les fichiers `css/style.css` et `css/print.css`.

## HTML & CSS

La structure HTML englobante de chaque gabarit est définie dans le fichier `_inc/pagetypetoprint.php`.

On peut souhaiter la modifier pour générer un balisage spécifique à un nouveau type de page ou pour modifier la gestion des titres courants.

Les styles spécifiques associés à chaque gabarit de page sont gérés dans les deux fichiers `css/style.ccss` et `css/print.ccss`, dans des sections aisément repérables grâce aux commentaires.



## Templates

Les différents gabarits, ou *templates*, sont:

* *default* : le gabarit de base.
* *appendices* : le gabarit pour les annexes générales et l’iconographie.
* *interview* : le gabarit pour les entretiens. 
* *references* : le gabarit pour les références, bibliographie, sitographie, etc.
* *autofolder* : un gabarit très similaire à *appendices* pour automatiser l’inclusion d’un dossier d’images

Les logiques de _templates_ peuvent être étendues pour prendre en charge d’autres logiques de mise en page. 

## Étendre ou modifier l’outil

La structure HTML englobante de chaque gabarit est définie dans le fichier `_inc/PageTypeToPrint.php`.

On peut souhaiter la modifier pour générer un balisage spécifique à un nouveau type de page ou pour modifier la gestion des titres courants.

Les styles spécifiques associés à chaque gabarit de page sont gérés dans les deux fichiers `css/style.css` et `css/print.css` présents dans le thème, dans des sections aisément repérables grâce aux commentaires.

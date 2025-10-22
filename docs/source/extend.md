

## Extensions

PageTypeToPrint propose une expérience de publication et de mise en page _web + print_ qui ne nécessite pas d’écrire de code (ni PHP, ni JavaScript, ni HTML ou CSS). 

L’outil est néanmoins conçu pour être modifié, augmenté ou détourné ; et servir de base à une appropriation progressive des logiques _web to print_.

Le plus souvent, il est souhaitable de dupliquer le thème par défaut, pour être en mesure d’éditer à la fois les styles graphiques, les scripts et la structure HTML du document.

### Gabarits

La structure HTML englobante de chaque gabarit est définie dans le fichier `_inc/PageTypeToPrint.php`.

On peut souhaiter la modifier pour générer un balisage spécifique à un nouveau type de page ou pour modifier la gestion des titres courants.

Les styles spécifiques associés à chaque gabarit de page sont gérés dans les deux fichiers `css/style.css` et `css/print.css` présents dans le thème, dans des sections aisément repérables grâce aux commentaires.

### Aller plus loin

- Premiers pas dans [la modification des logiques d’affichage](extendcss.md)
- Faire un [livret A5 recto-verso](booklet.md)
- Utiliser un pad public pour engager une [écriture collaborative](pads.md)
- Automatiser l’importation d’un [dossier d’images](autofolder.md)
- Parcourir les usages avancés des [notes de bas de page / de côté](advanced-notes.md)
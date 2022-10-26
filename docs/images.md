[↩ Retour à la documentation](index.md)

## Images

Des images légendées peuvent être insérées grâce à un _shortcode_ spécifique.

Les images peuvent être intégrées au fil du texte sous forme de note de côté :
```
(imagenote: url/de_limage.jpg caption: La légende de l’image)
```
Mais également sous forme de blocs :
```
(figure: url/de_limage.jpg caption: La légende de l’image)
````
On peut ajouter des `class` aux images :
```
(figure: url/de_limage.jpg class: maclass monautreclass)
````
Pour distinguer les images à l’arrière-plan blanc de celui de la page, une `class` dédiée (`.notwhite`) est disponible :
```
(figure: url/de_limage.jpg class: notwhite)
````
Pour aligner les images de note à gauche ou à droite (en contexte d’impression) utiliser les `class` suivantes : `printleft` `printright`:
```
(imagenote: url/de_limage.jpg class: printleft)
````
Pour les annexes, organisées sur une grille de 12 colonnes (_template_ `appendices`), quelques autres `class` sont prédéfinies :

* `offset2` décale l’image en colonne 3
* `offset4` décale l’image en colonne 5
* `offset6` décale l’image en colonne 7
* `offset8` décale l’image en colonne 9
* `half` dimensionne l’image sur 6 colonnes (la moitié de la largeur)
* `full` dimensionne l’image sur 12 colonnes (toute la largeur)
* `third` dimensionne l’image sur 4 colonnes (un tiers de la largeur)
* `twothird` dimensionne l’image sur 8 colonnes (deux tiers de la largeur)

Par exemple :
```
(figure: url/de_limage.jpg class: notwhite offset6 half)
```

## Vidéos

Pour intégrer une vidéo Youtube ou Vimeo, utiliser le _shortcode_ `video` et l’URL de la page :
```
(video: https://www.youtube.com/watch?v=yfskVxCn_qo class: maclass caption: La légende de la vidéo)
(video: https://vimeo.com/708803521 class: maclass caption: La légende de la vidéo)
```

En version print, l’URL de la vidéo est affichée sous sa légende.



[↪ Composition du glossaire](glossaire.md)



## Images & vidéos

Des images et vidéos légendées peuvent être insérées grâce à des « _shortcodes_ » spécifiques.

### Images

#### Images de note

Les images peuvent être intégrées au fil du texte sous forme de note de côté :
```pttp
(imagenote: content/images/fichier.jpg caption: La légende et _la source_.)
```
#### Image pleine largeur

Mais également sous forme de bloc au sein du texte :

```pttp 
(image: content/images/fichier.jpg caption: La légende et _la source_.)
```

#### Figures
Ou encore sous forme d’appels de figures :

```pttp 
(figure: content/images/fichier.jpg caption: La légende et _la source_.)
```

Cette dernière modalité introduit dans le texte un lien hypertexte qui renvoit à l’image affichée en fin de section. Cela autorise un affichage d’images de plus grandes tailles qu’au fil du texte.


### Vidéos

Pour intégrer une vidéo Youtube ou Vimeo, utiliser le _shortcode_ `video` et l’URL de la page :
```pttp
(video: https://www.youtube.com/watch?v=yfskVxCn_qo class: maclass caption: La légende de la vidéo)
(video: https://vimeo.com/708803521 class: maclass caption: La légende de la vidéo)
```

Pour la version imprimable, il est souhaitable de déterminer quelle image sera imprimée, grâce à l’attribut `poster`:
```pttp
(video: https://www.youtube.com/watch?v=yfskVxCn_qo poster: images/videocover.jpg)
```

En version print, l’URL de la vidéo est affichée sous sa légende.

### Mise en forme des images

On peut ajouter des `class` aux images :

```pttp
(figure: content/images/fichier.jpg class: maclass monautreclass)
```

Pour distinguer les images à l’arrière-plan blanc de celui de la page, une `class` dédiée (`notwhite`) est disponible :

```pttp
(figure: content/images/fichier.jpg class: notwhite)
```

Pour aligner les images de note à gauche ou à droite (en contexte d’impression) utiliser les `class` suivantes : `printleft` `printright` :

```pttp
(imagenote: content/images/fichier.jpg class: printleft)
```

Pour des images sous forme de blocs qui demandent une grande largeur d’affichage, on peut utiliser la `class: full` :

```pttp
(image: content/images/fichier.jpg class: full)
```

Voir [la section suivante](appendices.md) pour déterminer les tailles d’affichage pour les images insérées grace à `(figure: …)`.
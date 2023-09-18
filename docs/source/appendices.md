

## Annexes

Pour les annexes, organisées sur une grille de 12 colonnes (_template_ `appendices`), quelques `class` sont prédéfinies pour faciliter la mise en page :

* `offset0` : pas de décalage (valeur par défaut)
* `offset2` décale l’image en colonne 3
* `offset4` décale l’image en colonne 5
* `offset6` décale l’image en colonne 7
* `offset8` décale l’image en colonne 9
* `quarter` dimensionne l’image sur 3 colonnes (un quart de la largeur — valeur par défaut)
* `third` dimensionne l’image sur 4 colonnes (un tiers de la largeur)
* `half` dimensionne l’image sur 6 colonnes (la moitié de la largeur)
* `twothird` dimensionne l’image sur 8 colonnes (deux tiers de la largeur)
* `threequarter` dimensionne l’image sur 9 colonnes (trois quarts de la largeur)
* `full` dimensionne l’image sur 12 colonnes (toute la largeur)

Par exemple :
```pttp
(figure: url/de_limage.jpg class: notwhite offset6 half) 
```
### Web _vs_ print



Pour diférencier la mise en page des images entre l’écran et l’impression, on peut établir des styles différents pour chaque contexte :

```pttp
(figure: images/01.jpg class: half print: full)
```
↑ Cette image occupera la moitié de la largeur de l’empagement en version écran, et la pleine largeur en version imprimable.



### À l’aide !

Pour aider à la mise en page “visuelle” des images, on peut activer un utilitaire visuel qui aide à déterminer le code d’intégration des images.

En contexte écran, ajouter `/?layout` à l’URL.   
En contexte de prévisualisation print : `/?print&layout`.   

![image layout helper](images/layout-helper.png)


Chaque figure se voit alors doté d’un outil permettant de définir la largeur de la figure (`quarter`, `third`, `half`, `twothird`, `threequarter` ou `full`) et son décalage (`offset0`, `offset2`, `offset4`, `offset6` ou `offset8`). 

⚠️ Le code d’intégration de la figure est alors copié dans le presse-papier, et doit être collé dans le document markdown source. Attention, en contexte d’impression, la mise en page n’est pas recalculée. Il faut modifier le code d’intégration de la figure concernée dans le fichier markdown, l’enregistrer, puis actualiser la page dans le navigateur.


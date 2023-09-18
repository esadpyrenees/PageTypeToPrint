## Catalogue d’images

On peut déterminer que la source d’un contenu ne soit ni un fichier markdown, ni l’URL d’un pad, mais un dossier d’images.

C’est une solution moins souple et moins précise que la structuration d’une série d’images via les logiques décrites dans la [gestion des annexes](appendices.md), mais beaucoup plus rapide :)

```php
$parts = [
  [
    // le titre de la section, tel qu’il apparaitra dans le sommaire
    "title" => "Images en vrac", 
    // la déclaration "file" reste vide (ou est supprimée)
    "file" => "", 
    // on déclare le chemin vers le dossier
    "autofolder" => "images/dossier", 
    // le gabarit de mise en page
    "template" => "default" 
  ],
  …
]
```
Les fichiers gif, jpg, png, svg et webp seront automatiquement intégrés dans une succession d’éléments `<figure>`. 

Les images verticales (hauteur > largeur) auront une class `portrait` ; les horizontales une class `landscape`.
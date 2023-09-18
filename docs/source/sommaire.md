

## Sommaire

### Écran
À l’écran, le sommaire est généré automatiquement depuis les éléments contenus dans la liste définie dans le fichier `config.yml`. Seuls les titres de section apparaissent.

L’élément `<nav>` qui le contient est cloné via javascript, afin d’apparaître à la fois en introduction du document et au fil de la lecture.

### Impression
En contexte d’impression, il est généré à partir des balises `<h2>` et `<h3>` (à l’intérieur de l’élément `<main>`) du document (c’est à dire, des titres précédés de `##` et `###` dans les fichiers markdown). Les titres de section ainsi que les « sous-parties » sont donc visibles.




## Sommaire

Le sommaire du document est établi différemment selon son affichage, écran ou exportation PDF.

### Écran
À l’écran, le sommaire est généré automatiquement depuis les entrées `parts` déclarés dans le fichier [`config.yml`](contenu.md). Seuls les titres de section apparaissent.

Cela permet de choisir des titres courts pour le sommaire web (affiché en colonne de gauche dans le gabarit `esadpyrenees`) tout en conservant des titres plus longs dans le coprs du texte.

☞ L’élément `<nav>` qui le contient est cloné via javascript, afin d’apparaître à la fois en introduction du document et au fil de la lecture.

### Impression
En contexte d’impression, il est généré à partir du texte complet des balises `<h2>` et `<h3>` (à l’intérieur de l’élément `<main>`) du document (c’est à dire, des titres précédés de `##` et `###` dans les fichiers markdown). Les titres de section ainsi que les « sous-parties » sont donc visibles.



## Démo

Une démo est accessible en ligne sur [ateliers.esad-pyrenees.fr/pagetypetoprint](https://ateliers.esad-pyrenees.fr/pagetypetoprint/) avec sa version [_print_](https://ateliers.esad-pyrenees.fr/pagetypetoprint/?print) et le [document pdf](https://ateliers.esad-pyrenees.fr/pagetypetoprint/) généré. 

## RTFM

👏 Il 👏 est 👏 souhaitable 👏 de 👏 lire 👏 attentivement 👏 cette 👏 page 👏 de 👏 documentation 👏 avant 👏 de 👏 démarrer. 👏

## Installation

Téléchargez le code [en cliquant ici](https://github.com/esadpyrenees/PageTypeToPrint/zipball/master/). Le dossier _PageTypeToPrint_ doit être décompressé dans un environnement de serveur web local avec une version de PHP supérieure à 8.0.

Sur Windows ou sur OSX, on peut utiliser [MAMP](https://www.mamp.info/en/downloads/) et placer le dossier _PageTypeToPrint_ dans `htdocs`.

En savoir plus : [comment installer et démarrer un serveur de développement](https://github.com/esadpyrenees/PageTypeToPrint/wiki/Questions-de-serveur).

### Mise en ligne

Alternativement (ou bien plus tard, une fois terminé le processus d’édition), le document peut être mis en ligne sur un serveur (le serveur de l’ÉSAD Pyrénées ou sur un compte étudiant hébergé par Alwaysdata – [me demander](mailto:julien.bidoret@esad-pyrenees.fr)). Il faut alors s’assurer que le serveur est bien capable de servir le site via une version de PHP supérieure à 8.0 (sur Alwaysdata, [voir ici](https://admin.alwaysdata.com/environment/)).

## Utilisation

Le fichier `config.php` doit être édité afin d’y référencer les différentes parties du document, saisir son titre, votre année, nom et diplôme.

En cas de difficultés, après avoir lu cette introduction et examiné l’exemple, vous pouvez demander de l’aide en [formulant une _issue_](https://github.com/esadpyrenees/PageTypeToPrint/issues) ; si vous souhaitez apporter une solution aux problèmes fréquemment rencontrés, rendez-vous dans le [wiki](https://github.com/esadpyrenees/PageTypeToPrint/wiki).

## Le contenu

Un contenu de démonstration (texte et images) peut être [téléchargé ici](https://ateliers.esad-pyrenees.fr/pagetypetoprint/demo-base.zip). Un autre, basé sur le document écrit d’Aurore Tajan (merci ;) peut être [téléchargé là](https://ateliers.esad-pyrenees.fr/pagetypetoprint/demo-aurore.zip)

Le contenu du document est organisé sous la forme de documents texte au format markdown, qui permet de le structurer afin de le transformer automatiquement en HTML.
Voir plus bas [la documentation](#markdown) de la syntaxe markdown (titres, italiques, citations, etc.). 

Les différentes parties du document sont déclarées sous la forme d’un tableau associatif dans le fichier `config.php` :
```php
$parts = [
  [
    "title" => "Introduction",
    "file" => "1.intro.md",
    "template" => "default"
  ],
  [
    "title" => "Titre 2",
    "file" => "2.deuxieme-partie.md",
    "template" => "default"
  ],
  …
]
```

Le `title` sert à déterminer l’`id` de la section et à générer le sommaire.

Les fichiers markdown (à l’extension `.md`) sont numérotés par convention (pour une meilleure organisation).

À chaque partie peut être affecté un gabarit (*template*), qui permet de définir sa mise en forme (à la fois écran et print).

## Templates

Les différents *templates* sont:
* *default*  
 Le gabarit de base.
* *appendices*  
 Le gabarit pour les annexes générales et l’iconographie.
* *interview*  
 Le gabarit pour les entretiens. 
* *references*  
 Le gabarit pour les références, bibliographie, sitographie, etc.

Les logiques de _templates_ peuvent être étendues pour prendre en charge d’autres logiques de mise en page.

## Version imprimable / pdf

La version imprimable est accessible depuis l’URL du document associée à la requête `?print`. Par exemple, `http://localhost:8888/pagetypetoprint/?print`.

Le PDF résultant doit être généré (Fichier > Imprimer > Format PDF) depuis un navigateur compatible (Chromium ou Chrome). 

Quelques réglages de paramètres d’impression sont souvent nécessaires : désactiver les entêtes et pieds de pages du navigateur, contrôler la mise à l’échelle, vérifier le format, et cocher l’option permettant d’imprimer les arrière-plans.

Suite à l’exportation du fichier, il doit être stocké dans le dossier de travail, et nommé en fonction de l’option configurable dans le fichier `config.php`.


## Composition 

### Sommaire

À l’écran, le sommaire est généré automatiquement depuis les éléments contenus dans le tableau associatif `$parts`. Il est cloné via javascript, afin d’apparaître à la fois en introduction du document et au fil de la lecture.

En contexte d’impression, il est généré à partir des balises `<h2>` et `<h3>` (à l’intérieur de l’élément `<main>`) du document.

### Images
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

### Vidéos

Pour intégrer une vidéo Youtube ou Vimeo, utiliser le _shortcode_ `video` et l’URL de la page :
```
(video: https://www.youtube.com/watch?v=yfskVxCn_qo class: maclass caption: La légende de la vidéo)
(video: https://vimeo.com/708803521 class: maclass caption: La légende de la vidéo)
```
En version print, l’URL de la vidéo est affichée sous sa légende.

### Entretiens

Une logique de mise en forme spécifique est proposée pour les retranscriptions d’entretiens. Le contenu peut être structuré ainsi :
```md
**Votre nom** **Votre question**

**Nom de la personne interview·ée** Sa réponse

**VN** **Votre 2e question (VN sont vos initiales)**

**PI** Sa 2e réponse (PI sont ses initiales)
```

### Glossaire

Le glossaire obéit à une logique de structuration singulière. Il est englobé dans un élément personnalisé (_glossary_), et chaque terme est également englobé dans un élément _term_ :
```md
¶¶¶ glossary

::: term
Premier terme
:    Définition du premier terme
:::

::: term
Second terme 
:    Définition du second terme
:::

¶¶¶
```
### Colonnes

Le contenu peut être réparti en trois colonnes en utilisant la notation :
```md
::: columns

Contenu

:::
```
### Micro-typographie

La majeure partie des problématiques de micro-typographie est corrigée automatiquement (points de suspension, espaces avant et après ! ? « » “ ”, unités). Cela ne dispense pas du soin à apporter à la composition du texte !

* Pour une espace mot insécable, utiliser `&nbsp;`    
* Pour une espace fine insécable, utiliser `&#8239;`
* Pour un exposant, utiliser `XX^e^ siècle`, afin d’afficher XX<sup>e</sup> siècle

À l’impression, on peut forcer un saut de page en intégrant le code :
```html
<br class="breakpage">
```

### Notes

Pour créer une note, insérer `[^identifiant_de_la_note]` au fil du texte, puis créer un paragraphe contentant :   
`[^identifiant_de_la_note] : Contenu de la note mise en forme.`


## Markdown 

| Élement | Syntaxe Markdown |
| ----------- | ----------- |
| Titres | `# H1`<br>`## H2`<br>`### H3` |
| Gras | `**bold text**` |
| Italique | `*italicized text*` |
| Citation | `> blockquote` |
| Liste ordonnée | `1. First item`<br>`2. Second item`<br>`3. Third item` |
| Liste non-ordonnée | `- First item`<br>`- Second item`<br> `- Third item` |
| Code | \``code`\` |
| Filet horizontal | `---` |
| Lien | `[title](https://www.example.com)` |
| Image | `![alt text](image.jpg)` |
| Note de bas de page 	|  `Here's a sentence with a footnote. [^1]`<br>`[^1]: This is the footnote.` | 
| ID de titre  | `### My Great Heading {#custom-id}` |
| Liste de définition |	`term`<br>`: definition`
| Barré |	`~~The world is flat.~~` |
| Indice | `H~2~O` |
| Exposant | `X^2^ ` |
| Surligné |	`I need to highlight these ==very important words==` |

### Paragraphes et sauts de ligne
Pour créer un paragraphe, laisser une ligne blanche entre deux lignes de texte :
> `Un premier paragraphe.` <br> <br> `Un deuxième paragraphe.`

Pour forcer un saut de ligne, saisir deux espaces en fin de ligne :
> `Un premier vers.  ` <br> `Un deuxième vers.`

### Styles de texte
Vous pouvez utiliser `_` ou `*` autour d'un mot pour le mettre en italique (deux pour le mettre en gras).
> `_italique_` s'affiche ainsi : _italique_  
> `**gras**` s'affiche ainsi : **gras**  
> `**_gras-italique_**` s'affiche ainsi : **_gras-italique_**  
> `~~barré~~` s'affiche ainsi : ~~barré~~  

### Liens
On peut créer un lien en mettant le texte cliquable entre crochets et l’URL associée entre parenthèses : 

> `Un [lien](https://esad-pyrenees.fr)` s’affiche ainsi : Un [lien](https://esad-pyrenees.fr)

### Images

Pour insérer une image, on peut utiliser la syntaxe Markdow native :
> `![Texte alternatif](url/de_limage.jpg)`

La syntaxe spécifique (non markdown) `(figure: fichier.jpg)` est plus appropriée à la structuration des documents et mémoires (notamment du fait de la possibilité de légendes).

### Citations
Des citations peuvent être créées grâce au signe `>` :

> `> Le texte de la citation !`

### Titres
Les titres et intertitres peuvent être crées grâce à `#` répété une ou plusieurs fois en début de ligne :
> `# Titre de niveau 1`  
> `## Titre de niveau 2`  
> `### Titre de niveau 3`

Dans le contexte de ces documents, on évitera le niveau de titre 1, réservé au titre du document.

### Listes

Des listes ordonnées et non-ordonnées peuvent être créées grâce à la syntaxe suivante :
> `1. élément`  
> `2. élément`  
> `3. élément`

Ou
> `* élément`  
> `* élément`  
> `* élément`


### Aller plus loin

Lire la documentation sur [markdownguide.org](https://www.markdownguide.org/) et [MarkdownIt](https://markdown-it.github.io/) (cette librairie ajoute des éléments utiles : abbréviations, notes de bas de page, listes de définition, tableaux, attributs `class` et `id` pour les éléments…). 


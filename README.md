# PageTypeToPrint

PageTypeToPrint est un gabarit destiné à la mise en forme normalisée d’un document écrit de DNA ou d’un mémoire de DNSEP.
Il est conçu avec comme hypothèse principale la simplicité de l’édition (contenu textuel au format *markdown*), mais peut être adapté, augmenté et personnalisé.

## Le contenu
Le contenu du document est organisé sous la forme de documents texte au format markdown, qui permet de le structurer afin de le transformer automatiquement en HTML.
Voir plus bas [la documentation](#md) de la syntaxe markdown (titres, italiques, citations, etc.). 

Les différentes parties du document sont déclarées sous la forme d’un tableau associatif dans le fichier `index.php`. :
<pre>
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
</pre>

Le titre sert à déterminer l’`id` de la section et à générer le sommaire.

Les fichiers markdown (à l’extension `.md`) sont numérotés par convention (pour une meilleure organisation).

À chaque partie peut être affecté un gabarit (*template*), qui permet de définir sa mise en forme (à la fois écran et print).

## Templates

Les différents *templates* sont:
* *default*  
 Le gabarit de base.
* *appendices*  
 Le gabarit pour les annexes générales.
* *interview*  
 Le gabarit pour les entretiens. 
* *references*  
 Le gabarit pour les références, bibliographie, sitographie, etc.

## Version imprimable / pdf

La version imprimable ~~est~~ sera accessible depuis l’URL du document associée à la requête `?print`. Par exemple, `http://localhost:5500/?print`.  

Le PDF résultant doit être généré depuis un navigateur compatible (Chromium ou Chrome, pour le moment).


## Trucs et astuces

### Sommaire

Le sommaire est généré automatiquement depuis les éléments contenus dans le tableau associatif `$parts`.

Il est cloné via javascript, afin d’apparaître à la fois en introduction du document et au fil de la lecture (à l’intérieur de l’élément `<main>`).

### Images
Des images (légendées) peuvent être insérées grâce à un code spécifique : 

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
(figure: url/de_limage.jpg class: maclass)
````
Pour distinguer les images à l’arrière-plan blanc de celui de la page, une `class` dédiée (`.notwhite`) est disponible :
```
(figure: url/de_limage.jpg class: notwhite)
````

### Vidéos (Youtube)

Pour intégrer une vidéo Youtube :
```
![Texte alternatif](IDENTIFIANTDELAVIDEO "Titre de la vidéo")
```
L’identifiant peut être extrait de l’URL de la page Youtube : https://www.youtube.com/watch?v=IDENTIFIANTDELAVIDEO

### Entretiens

Une logique de mise en forme spécifique est proposée pour les retranscriptions d’entretiens. Le contenu peut être structuré ainsi :
```md
**Votre nom** **Votre question**

**Nom de la personne interview·ée** Sa réponse

**VN** **Votre 2e question (VN sont vos initiales)**

**PI** Sa 2e réponse (PI sont ses initiales)
```

### Glossaire

Le glossaire obéit à une logique de structuration singulière. Il est lui-même englobé dans un élément personnalisé, et chaque terme l’est également :
```md
¶¶¶ glossary

::: term
terme
:    définition
:::

::: term
terme 2
:    définition 2
:::

¶¶¶
```
### Colonnes

Le contenu peut être réparti en colonnes en utilisant la notation :
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

### Notes

Pour créer une note, insérer `[^identifiant_de_la_note]` au fil du texte, puis créer un paragraphe contentant :   
`[^identifiant_de_la_note] : Contenu de la note mise en forme avec du **gras**, de l’*italique* ou des [liens](https://…)`


## Crédits

PageTypeToPrint s’appuie sur plusieurs librairies : 
* [MarkdownIt](https://opencollective.com/markdown-it) et [MarkdownIt-php](https://github.com/kaoken/markdown-it-php), pour la transformation du contenu markdown en HTML.
* [JoliTypo](https://github.com/jolicode/JoliTypo/) pour la correction microtypographique.
* [Paged.js](https://pagedjs.org/) pour l’impression et la génération de PDF.

La logique et une partie du code source des “_shortcodes_” (figure, imagenote…) est empruntée à [Kirby](https://github.com/getkirby).

## Markdown {#md}

### Paragraphes et sauts de ligne
Pour créer un paragraphe, laisser une ligne blanche entre deux lignes de texte :
> `Un premier paragraphe.` <br> <br> `Un deuxième paragraphe.`

Pour forcer un saut de ligne, saisir deux espaces en fin de ligne :
> `Un premier vers.  ` <br> `Un deuxième vers.`

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

### En bref

| Element | Markdown Syntax |
| ----------- | ----------- |
| Heading | `# H1`<br>`## H2`<br>`### H3` |
| Bold | `**bold text**` |
| Italic | `*italicized text*` |
| Blockquote | `> blockquote` |
| Ordered List | `1. First item`<br>`2. Second item`<br>`3. Third item` |
| Unordered List | `- First item`<br>`- Second item`<br> `- Third item` |
| Code | \``code`\` |
| Horizontal Rule | `---` |
| Link | `[title](https://www.example.com)` |
| Image | `![alt text](image.jpg)` |
| Footnote 	|  `Here's a sentence with a footnote. [^1]`<br>`[^1]: This is the footnote.` | 
| Heading ID  | `### My Great Heading {#custom-id}` |
| Definition List |	`term`<br>`: definition`
| Strikethrough |	`~~The world is flat.~~` |
| Subscript | `H~2~O` |
| Superscript | `X^2^ ` |
| Highlight |	`I need to highlight these ==very important words==` |

### Aller plus loin

Lire la documentation sur [markdownguide.org](https://www.markdownguide.org/)

La librairie [MarkdownIt](https://markdown-it.github.io/) ajoute des éléments utiles : abbréviations, notes de bas de page, listes de définition (pour un glossaire, par exemple), tableaux, attributs `class` et `id` pour les éléments… 

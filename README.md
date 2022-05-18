# PageTypeToPrint

PageTypeToPrint est un gabarit destiné à la mise en forme normalisée d’un document écrit de DNA ou d’un mémoire de DNSEP.
Il est conçu avec comme hypothèse principale la simplicité de l’édition (contenu textuel au format *markdown*), mais peut être adapté, augmenté et personnalisé.

## Le contenu
Le contenu du document est organisé sous la forme de documents texte au format markdown, qui permet de structurer le contenu afin de le transformer automatiquement en HTML.
Voir [la documentation](https://daringfireball.net/projects/markdown/syntax) de la syntaxe markdown (titres, italiques, citations, etc.). La librairie MarkdownIt ajoute des éléments utiles : abbréviations, notes de bas de page, listes de définition (pour un glossaire, par exemple), tableaux, attributs `class` et `id` pour les éléments… 

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

Le titre est invisible, mais sert à déterminer l’`id` de la section.

Les fichiers markdown (à l’extension `.md`) sont numérotés par convention (pour une meilleure organisation).

À chaque partie peut être affecté un gabarit (*template*), qui permet de définir sa mise en forme.

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

MarkdownIt permet l’ajout de notes (de côté / de base de page).

Pour créer une note, insérer `[^identifiant_de_la_note]` au fil du texte, puis créer un paragraphe contentant :   
`[^identifiant_de_la_note] : Contenu de la note mise en forme avec du **gras**, de l’*italique* ou des [liens](https://…)`


## Crédits

PageTypeToPrint s’appuie sur plusieurs librairies : 
* [MarkdownIt](https://opencollective.com/markdown-it) et [MarkdownIt-php](https://github.com/kaoken/markdown-it-php), pour la transformation du contenu markdown en HTML.
* [JoliTypo](https://github.com/jolicode/JoliTypo/) pour la correction microtypographique.
* [Paged.js](https://pagedjs.org/) pour l’impression et la génération de PDF.
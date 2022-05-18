# PageTypeToPrint

PageTypeToPrint est un gabarit destiné à la mise en forme normalisée d’un document écrit de DNA ou d’un mémoire de DNSEP.
Il est conçu avec comme hypothèse principale la simplicité de l’édition (contenu textuel au format *markdown*), mais peut être adapté, augmenté et personnalisé.

## Le contenu
Le contenu du document est organisé sous la forme de documents texte au format Markdown Extra. 
Voir [la documentation](https://daringfireball.net/projects/markdown/syntax) de la syntaxe Markdown (titres, italiques, citations, etc.). Markdown Extra ajoute des éléments utiles : abbréviations, notes de bas de page, listes de définition (pour un glossaire, par exemple), tableaux, attributs `class` et `id` pour les éléments… Voir [la documentation](https://michelf.ca/projects/php-markdown/extra/).

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
La version imprimable est accessible depuis l’URL du document associée à la requête `?print`. Par exemple, `http://localhost:5500/?print`.  

Le PDF résultant doit être généré depuis un navigateur compatible (Chromium ou Chrome, pour le moment).



## Trucs et astuces

### Sommaire

Le sommaire est généré automatiquement depuis les éléments contenus dans le tableau associatif `$parts`.

Il est cloné via javascript, afin d’apparaître à la fois en introduction du document et au fil de la lecture (à l’intérieur de l’élément `<main>`).

### Micro-typographie

La majeure partie des problématiques de micro-typographie est corrigée automatiquement (points de suspension, espaces avant et après ! ? « » “ ”, unités). Cela ne dispense pas du soin à apporter à la composition du texte !

* Pour une espace mot insécable, utiliser `&nbsp;`    
* Pour une espace fine insécable, utiliser `&#8239;`
* Pour un exposant, utiliser `XX<sup>e</sup> siècle`, afin d’afficher XX<sup>e</sup> siècle

### Notes

Markdown Extra permet l’ajout de notes de côté / de base de page.

Pour créer une note, insérer `[^identifiant_de_la_note]` au fil du texte, puis créer un paragraphe contentant :   
`[^identifiant_de_la_note] : Contenu de la note mise en forme avec du **gras**, de l’*italique* et des [liens](https://…)`


## Crédits

PageTypeToPrint s’appuie sur plusieurs librairies : 
* [Parsedown](https://parsedown.org/) et [ParsedownExtra](https://github.com/erusev/parsedown-extra/), pour la transformation du contenu markdown en HTML.
* Bientôt, une version étendue de ParsedownExtra, avec [ParsedownExtraPlugin](https://github.com/taufik-nurrohman/parsedown-extra-plugin/) pour le support natif des `figure` / `figcaption`.
* [JoliTypo](https://github.com/jolicode/JoliTypo/) pour la correction microtypographique.
* [Paged.js](https://pagedjs.org/) pour l’impression et la génération de PDF.
## Catalogue d’images

On peut déterminer que la source d’un contenu ne soit ni un fichier markdown, ni l’URL d’un pad, mais un dossier d’images.

C’est une solution moins souple et moins précise que la structuration d’une série d’images via les logiques décrites dans la [gestion des annexes](appendices.md), mais beaucoup plus rapide :)

```yaml
parts:

  - title: Images en vrac 
    file: "" # la déclaration "file" reste vide (ou est supprimée)
    folder: images/dossier # on déclare le chemin vers le dossier 
    template: autofolder # le gabarit de mise en page 
  
  …

```
Les fichiers gif, jpg, png, svg et webp seront automatiquement intégrés dans une succession d’éléments `<figure>`. 

Les images verticales (hauteur > largeur) auront une class `portrait` ; les horizontales une class `landscape`.

### Exemple pas à pas

Le thème `catalogue` simplifie à l’extrême les logiques initiales de _PageTypeToPrint_ pour n’en conserver qu’une structure minimale :

- à l’écran : une simple page qui liste des images en faisant varier leur taille et leur mise en page de manière aléatoire.
- en version imprimée : un format A4 fermé imposé automatiquement sur format A3 (feuilles à plier et encarter pour fabriquer un livret).

Une démo est accessible dans sa [version écran](https://ateliers.esad-pyrenees.fr/pagetypetoprint/catalogue/) et dans sa [version imprimable](https://ateliers.esad-pyrenees.fr/pagetypetoprint/catalogue/?print).

#### Étape 1 : configuration du document

```yml
# Le thème
theme: "catalogue"

# Le titre 
title: Three D Scans

# Des méta-données spécifiques peuvent être créées 
url: threedscans.org
date: 19/09/2023

# Structure du contenu 
parts:
  - title: Three D Scans
    folder: content/images # ← le dossier d’images
    template: autofolder # ← le gabarit 
  
  - title: About
    file : content/about.md
    template : default
```

#### Étape 2 : simplification de `body.php`

Suppression de la navigation, du sommaire et des titres courants.

```html
<header id="header">
    <!-- Le titre  -->
    <h1><?= $title ?></h1>
    <!-- le folio -->
    <span class="folio"></span>
    <!-- affichage des méta-données spécifiques -->
    <div class="meta">
        <span class="meta-url"><a href="<?= $url ?>"><?= $url ?></a></span>        
        <span class="meta-date"><?= $date ?></span>      
    </div>
</header>
<main id="main">
    <!-- le contenu -->      
    <?= $html() ?>
</main>
```
#### Étape 2 : simplification de la CSS `style.css`

Une large part de la feuille de style par défaut n’est pas utile dans le cadre d’un simple catalogue d’image. On peut ainsi supprimer une grande part des règles de mise en forme : méta-données, typographie, navigation, gabarits _interview_, _appendices_, glossaire, colonnes, images de note, notes de marge, etc.

Les règles correspondant au gabarit `autofolder` peuvent déterminer une grille _responsive_ et préciser le comportement des images et des légendes :

```css
.autofolder .content {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
  grid-gap: var(--spacer);
}
.autofolder .figure {
  margin: 0;
  padding: 0;
}
.autofolder img {
  width: 100%;
  height: 100%;
  object-fit: contain;
  object-position: bottom;
}
.autofolder figcaption {
  text-align: center;
  font-size: .75em;
  text-transform: uppercase;
  letter-spacing: 0.15em;
  height: 1.5em;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}
```

#### Étape 3 : Modifications de `screen_head.php`

Les appels du script `screen/sidenotes.js` et des scripts d’[aide à la mise en page](../appendices/#à-l’aide-!) sont supprimés. 

Dans l’exemple de thème `catalogue`, on ajoute un appel au script (`screen/script.js`), qui intervient pour modifier aléatoirement la largeur des figures et déstructurer la grille.


#### Étape 4 : Modifications de la CSS `print.css`

Déclaration du format de page et de la pagination par défaut, ainsi que de la page de couverture et des pages vides.


```css
@page {
  size: 210mm 297mm;
}  
@page:right {
  margin: 1cm 2cm 2.5cm 1cm;
  @bottom-right-corner {
    content: element(folioRunning);
    text-align: left;
  }
}
@page:left {
  margin: 1cm 1cm 2.5cm 2cm;
  @bottom-left-corner {
    content: element(folioRunning);
    text-align: left;
  }
}
@page cover {
  margin: 1cm 1cm 2.5cm 1cm;    
  @bottom-left-corner { display: none; }
  @bottom-right-corner { display: none; }
}
@page:blank {
  @bottom-left-corner { display: none; }
  @bottom-right-corner { display: none; }
}
  
```

#### Étape 5 : Modifications de `print_head.php`

Les appels des scripts liés aux notes iconographiques et de bas de page, au sommaire, etc. sont supprimés. 

Le format fermé (A4) étant défini en CSS, on inclut l’appel du script `print/imposition.js` qui permet de générer l’imposition des pages A4 et de modifier le format de sortie pour que deux pages puissent être imprimées sur la même face.

Si besoin, ce script insère des pages blanches pour que la pagination soit un multiple de quatre.

Dans l’exemple de thème `catalogue` –juste pour montrer que c’est possible…–, on ajoute un appel au script `print/bigfigures.js`, qui intervient pour modifier la largeur et la hauteur de certaines figures, sélectionnées manuellement via leur `id`.
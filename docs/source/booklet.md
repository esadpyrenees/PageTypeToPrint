## Livret A5

Cet exemple se propose de transformer le gabarit d’une simple page A4 (recto seul) vers une double page A5 (recto-verso) en supprimant toute association à l’ÉSAD Pyrénées.

Le code correspondant à cet exemple est accessible sur la branche `booklet` du dépôt. 
Il peut être téléchargé sur [ateliers.esad-pyrenees.fr/pagetypetoprint/PageTypeToPrint-A5Booklet.zip](https://ateliers.esad-pyrenees.fr/pagetypetoprint/PageTypeToPrint-A5Booklet.zip).
Une démo est visible sur [ateliers.esad-pyrenees.fr/pagetypetoprint-booklet](http://ateliers.esad-pyrenees.fr/pagetypetoprint-booklet/?print)

* `js/print/pagedjs.css`
    * desactivation de la feuille de style interface/recto-verso.css
* `index.php`
    * courants et folio: suppression du logo ESAD et du diplôme
    * courants et folio: réorganisation pour positionnement en bas de page uniquement
    * notes de <del>marge</del> bas de page, suppression des scripts `js/screen/notes.js` et `js/print/marginNotes.js` 
* `css/print.css`
    * format et marges  
    * gestion des titres courants 
    * notes de marge 
    * mise en page du sommaire 

### Détails CSS print

Format et marges:
```css
@page {
  size: 148mm 210mm;

  @bottom-left-corner {
    content: element(folioRunning);
    text-align: left;
  }
  @bottom-left {
    content: element(titleRunning);
    text-align: left;
  }
  @footnote {
    float: bottom;
  }
}  
@page:right {
  margin: 1cm 2cm 2.5cm 1cm;
}
@page:left {
  margin: 1cm 1cm 2.5cm 2cm;
}
@page cover {
  margin: 1cm 1cm 2.5cm 1cm;    
  @bottom-left-corner {
    display: none;
  }
  @bottom-left {
    display: none;
  }
}
@page:blank {
  @bottom-left-corner {
    display: none;
  }
  @bottom-left {
    display: none;
  }
}
```

Couverture, réorganisation :
```css
  .meta-year { grid-column: 3; grid-row: 1; }
  .meta-data { grid-column: 1; grid-row: 1; }
```
Modifications des titres courants : 
```css
  /* running title */
  .runningtitle {
    display: none;
    position: running(titleRunning);
  }
  .folio{
    font-weight: bold;
    text-align: right;
  }
  .folio::before{
    content: counter(page);
    font-weight: bold;
  }
  .pagedjs_margin .runningtitle {
    gap:var(--spacer);
    padding: 1cm 0 .5cm;
    display: flex !important;
    justify-content: space-between;
  }
  .pagedjs_left_page .runningtitle {
    flex-direction: row-reverse;
  }
  .pagedjs_right_page .runningtitle {
    flex-direction: row;
  }
  .pagedjs_left_page .runningtitle .title,
  .pagedjs_right_page .runningtitle .name { display: none; }
```

Modification des images de note :
```css
  .imagenote {
    width: 33%;
    display: block;
    margin: var(--spacer) 0 0 var(--spacer);
    font-size: var(--smallsize);    
  }
  .imagenote.printleft {
    float: left;
    margin: var(--spacer) var(--spacer) 0 0;
  }
  .imagenote.printright {
    float: right;
    margin: var(--spacer) 0 0 var(--spacer);
  }
```

Pour les annexes, suppression des marges spécifiques, affichage du titre et suppresion du retrait dans les interviews :
```css
section.appendices { /* margin-left: -6.5cm; */ }
.appendices > h2 { /* display: none; */ }
section.references { /* margin-left: -6.5cm; */ }
.references > h2 { /* display: none; */ }
.interview > h2 { /* display: none; */ }
.interview p {
  --indent: 0px;
}
Glossaire et références bibliographiques sur deux colonnes uniquement :
```css
.glossary,
.columns {
  font-size: 0.85em;
  columns: 2;
  column-gap: var(--spacer);
}
```

Saut de page avant le sommaire :
```css
  #nav {
    page-break-before: right;
    page-break-after: right;
    counter-reset: page 1;
    height: auto;
  }
```
Mise en page du sommaire :
```css
#list-toc-generated .toc-element a::before {
  /* position: absolute; */
  /* margin-left: calc(-4em - 20px); */
  display: inline-block;
  text-align: left;
}
#list-toc-generated .toc-element-level-2 a::before {
  /* margin-left: calc(-4em - 40px); */
}
```
---
title: Notes avancées
summary: Gestion avancée des notes « textuelles » et des notes « iconographiques »
---



## Notes avancées

PageTypeToPrint gère nativement deux types de notes : des notes « textuelles » et des notes « iconographiques ».


### Notes textuelles

Elles sont générées grâce à l’extension `MarkdownItFootnote` et suivent le format d’appel et de création de notes markdown le plus commun :    
```html
Insérer un appel de note[^appel], puis créer un paragraphe contentant :   

[^appel]: Contenu de la note.
```

Les appels de notes sont insérés au fil du texte :
```html
<p>Insérer un appel de note<sup class="footnote-ref"><a href="#fn1" id="fnref1">1</a></sup>, puis créer un paragraphe contentant : </p>
```

L’ensemble des notes se retrouve à la fin du document, dans une liste. Un lien de retour vers l’appel de note est inséré à la fin de son contenu :
```html
<hr class="footnotes-sep">
<section class="footnotes">
  <ol class="footnotes-list">
    <li id="fn1" class="footnote-item"><p>Contenu de la note <a href="#fnref1" class="footnote-backref">&#8617;&#65038;</a><p></li>
    […]
  </ol>
</section>
``` 

#### Affichage écran : notes textuelles en marge

Pour l’affichage à l’écran, le script `js/screen/sideNotes.js` parcourt les appels de note, récupère leur contenu cible et l’insère au fil du texte, à la place de l’appel de note initial, dans une structure HTML constituée de trois éléments :
```html
<label class="sn-toggle-label" for="sn-note-fn1">1</label>
<input type="checkbox" id="sn-note-fn1" class="sn-toggle">
<aside class="sn-note" data-ref="2"><p>Contenu de la note</p></aside>
```
Ces éléments permettent un affichage _responsive_ des notes : soit sur le côté du texte si le viewport est suffisamment grand, soit au sein du texte après un clic sur le `label` en affichage mobile (voir la section “Notes” du fichier `css/styles.css`).

#### Impression : notes textuelles en bas de page

En contexte d’impression, la structure HTML des notes textuelles est soumise à une modification similaire grâce au script `js/screen/footNotes.js` afin de suivre le balisage recommandé dans la spécification HTML du W3C. Les notes textuelles seront ainsi intégrées au bas de chaque page par la librairie `paged.js`.

Si l’on souhaite déplacer les notes de bas de page en marge, ce script devra être désactivé et une opération similaire à celle à laquelles sont soumises les notes iconographiques devra être opérée.

### Notes iconographiques

Les notes iconographiques ( ou _images de note_) sont générées grâce au _shortcode_ `(imagenote: fichier.jpg)` inséré après le mot qu’elles précisent :
```pttp
Les illustrations de Gustave Doré(imagenote: images/gustave.jpg caption: Gustave Doré) sont gravées dans les mémoires.
```
Elles peuvent bénéficier de l’ensemble des attributs liés aux figures (`class` et `caption`) et sont insérées au fil du texte grâce au parsing des _shortcodes_ de la librairie `_inc/Specials/Tags.php`.

En contexte d’impression, elles mises en marge grâce au script `js/print/imageNotes.js`.
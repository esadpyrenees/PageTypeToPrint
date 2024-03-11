

## Markdown 

Le contenu textuel du document est saisi dans le langage de balisage léger _markdown_, très largement utilisé et documenté partout sur le web.

On trouvera ci-dessous une brève documentation sur l’usage de _markdown_, sinon poursuivre vers la [version imprimable / pdf](print.md).

### Syntaxe

| Élement | Syntaxe Markdown |
| ----------- | ----------- |
| Titres | `# H1`<br>`## H2`<br>`### H3` |
| Gras | `**texte en gras**` |
| Italique | `_texte en italique_` |
| Citation | `> blockquote` |
| Liste ordonnée | `1. Premier item`<br>`2. Deuxième item`<br>`3. Troisième item` |
| Liste non-ordonnée | `- Premier item`<br>`- Deuxième item`<br> `- Troisième item` |
| Code | ```code` `` |
| Filet horizontal | `---` |
| Lien | `[titre](https://www.example.com)` |
| Image | `![alternative textuelle](image.jpg)` ⚠️ [cf. Images](images.md) |
| Note de bas de page 	|  `Ceci est une phrase avec une note de bas de page. [^1]`<br>`[^1]: Ceci est la note.` ⚠️ [cf. Notes](notes.md) | 
| ID de titre  | `### Mon titre avec id {#custom-id}` |
| Liste de définition |	`terme`<br>`: définition`
| Barré |	`~~La terre est plate.~~` |
| Indice | `H~2~O` |
| Exposant | `X^2^ ` |
| Surligné |	`Je veux surligner ces ==mots très importants==` |

### Paragraphes et sauts de ligne
Pour créer un paragraphe, laisser une ligne blanche entre deux lignes de texte :
> `Un premier paragraphe.` <br> <br> `Un deuxième paragraphe.`

Pour forcer un saut de ligne, saisir deux espaces en fin de ligne :
<blockquote>
<p><code>Un premier vers.  </code> <br> <code>Un deuxième vers.</code></p>
</blockquote>

### Styles de texte
Vous pouvez utiliser `_` ou `*` autour d'un mot pour le mettre en italique (deux pour le mettre en gras).
> `_italique_` s'affiche ainsi : _italique_  
> `**gras**` s'affiche ainsi : **gras**  
> `**_gras-italique_**` s'affiche ainsi : **_gras-italique_**  
> `~~barré~~` s'affiche ainsi : <del>barré</del>  
> `==surligné==` s'affiche ainsi : <mark>surligné</mark>

### Liens
On peut créer un lien en mettant le texte cliquable entre crochets et l’URL associée entre parenthèses : 

> `Un [lien](https://esad-pyrenees.fr)` s’affiche ainsi : Un [lien](https://esad-pyrenees.fr)

### Images

Pour insérer une image, on peut utiliser la syntaxe Markdow native :
> `![Texte alternatif](url/de_limage.jpg)`

⚠️ La syntaxe spécifique (non markdown) `(figure: fichier.jpg)` est plus appropriée à la structuration des documents et mémoires (notamment du fait de la possibilité de légendes). Voir [Composition : images et vidéos](images.md).

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


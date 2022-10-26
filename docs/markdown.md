
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


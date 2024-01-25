

## Typographie

La majeure partie des problématiques de micro-typographie est corrigée automatiquement (points de suspension, espaces avant et après ! ? « » “ ”, unités). 

Cete automatisation ne dispense aucunement du soin à apporter à la composition typographique du texte !


### Sauts de page ou de colonnes

À l’impression, on peut forcer un saut de page en intégrant le code :
```html
<br class="breakpage">
```
Les sauts de page doivent être intégrés en fin de section / chapitre plutôt qu’au début du suivant.

Pour forcer un saut dans des colonnes (notes de bas de page, notamment), utiliser :
```html
<br class="breakcolumn">
```
Des sauts de ligne conditionnels (écran _ou_ impression) peuvent être générés grâce aux balises :

```html
<br class="breakscreen"><!-- uniquement à l’écran -->
<br class="breakprint"><!-- uniquement à l’impression -->
```  


### Espaces

* Pour une espace mot insécable, utiliser `&nbsp;`    
* Pour une espace fine insécable, utiliser `&#8239;`

### Apostrophe courbe et guillemets


Les apostrophes sont composées grâce au signe ’ et pas '.

Les « guillemets droits », simples ou doubles (" et ') devraient être proscrits. Dans PageTypeToPrint, en Markdown, ils sont automatiquement remplacés par des guillemets français («»). 

Les guillemets français devraient être utilisés dans l’immense majorité des cas. Les guillemets anglais (“”) sont réservés à la mise entre guillemets au sein-même d’un texte déjà entre guillemets français :
> « Une citation peut contenir des mots “entre guillemets”. »

Les caractères dans le tableau ci-dessous peuvent être composés directement (les entités HTML ne sont présentées qu’à titre informatif).


| Nom | Entité HTML |  Commentaire |
|---|---|---|
| <strong>’</strong> | &<span>rsquo;</span> | Apostrophe courbe |
| <strong>« » </strong> | &<span>laquo;</span> &<span>raquo;</span> | Guillemet français ouvrant et fermant |
| <strong>“ ”</strong> | &<span>ldquo;</span> &<span>rdquo;</span>  | Guillemet anglais ouvrant et fermant |

### Exposants

Pour un exposant, utiliser `XX^e^ siècle`, afin d’afficher XX<sup>e</sup> siècle. Les abbréviations premier, deuxième, etc. se composent également en exposants : « `la 1^re^ vague et la 2^e^ vague` » pour afficher « la 1<sup>re</sup> vague et la 2<sup>e</sup> vague ». 

### Points de suspension
Les points de suspension doivent être composés grâce au caractère dédié : « … ».    
(Pas en faisant se succéder trois points : ...).


### Spacing

Pour réduire une ligne de texte et empêcher un saut malencontreux (veuves ou orphelines), on peut introduire au sein du texte markdown des balises `span` qui vont permettre de régler finement le _spacing_ d’une phrase ou d’une ligne:

```html
Lorem <span style="--ls:4">ipsum dolor sit amet, consectetur adipiscing elit.</span> Sed non risus […] 
```
Dans la CSS doit être présent :
```css
[style^="--ls"] { letter-spacing: calc(var(--ls, 0) * -0.001em); }
```
La valeur attribuée à la propriété `--ls` permettra d’étendre le _spacing_ (si elle est négative) ou de le resserrer si elle est positive. L’inspecteur web permet de modifier la valeur à la volée afin de l’ajuster précisément.

⚠️ Attention, ne procéder à ces ajustements qu’en toute fin de mise en forme, quand tout le reste a été fait !

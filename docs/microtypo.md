[↩ Retour à la documentation](index.md)

## Micro-typographie

La majeure partie des problématiques de micro-typographie est corrigée automatiquement (points de suspension, espaces avant et après ! ? « » “ ”, unités). Cela ne dispense aucunement du soin à apporter à la composition du texte !


### Espaces

* Pour une espace mot insécable, utiliser `&nbsp;`    
* Pour une espace fine insécable, utiliser `&#8239;`

## Apostrophe courbe et guillemets


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

### Sauts de page ou de colonnes

À l’impression, on peut forcer un saut de page en intégrant le code :
```html
<br class="breakpage">
```

Pour forcer un saut dans des colonnes (notes de bas de page, notamment), utiliser :
```html
<br class="breakcolumn">
```

[↪ Composition des notes de marge et des images de note](notes.md)
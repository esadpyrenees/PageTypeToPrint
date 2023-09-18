
## Bibliographie

Une logique de mise en forme spécifique est proposée pour les annexes bibliographiques. Un gabarit spécifique (_references_) est prévu pour déclarer la bibliographie dans les sections du fichier `config.yml` : 

```yml
- title: Bibliographie
  file: content/text/7.biblio.md
  template: references
```
## Préconisations

Dans la bibliographie, les références sont ordonnées par ordre alphabétique du nom d’auteur⋅ice (s’il y a plusieurs références d’un⋅e même auteur⋅ice, elles sont classées chronologiquement). 

Toutes les sources citées dans le texte doivent aussi être citées dans la bibliographie.

Les normes recommandées ci-dessous sont issues de la spécification [ISO-690:2010](https://fr.wikipedia.org/wiki/ISO_690).  

### Abbréviations utiles

**_Ibid._** s’utilise lorsque la note porte sur le même ouvrage que la note précédente. 

_**Op. cit.**_ s’utilise lorsqu’un ouvrage a déjà été cité précédemment, mais que d’autres ouvrages ont été cités depuis. Avec _op. cit._, on mentionne quelques mots du titre, mais on fait l’économie de la répétition de la source complète.

Ces deux abbréviations se composent en italique.

### Pour citer un livre

Le titre du livre doit être en italique. En cas de d’ouvrage collectif, indiquer « . Prénom NOM des auteurs principaux, dir. » après le titre de l’ouvrage.  Si vous citez un chapitre, ajouter « Numéro et titre du chapitre. Pages. ».

> NOM, Prénom des auteur⋅ices. _Titre du livre_. Édition. Ville d’édition&#8239;: Nom de l’éditeur, Année de publication. Collection.

```html
PAPANEK, Victor. _Design for the Real World: Human Ecology and Social Change_. New-York&#8239;: Pantheon Books, 1971.
```

### Pour citer un article

Le titre de l’article doit être entre guillemets. Le titre de la revue ou du journal doit être en italique. Si vous citez un quotidien, indiquer la date du jour.

> NOM, Prénom des auteur⋅ices. « Titre de l’article ». Dans&#8239;: _Titre de la revue_. Année de publication, Volume (Numéro), Pages. URL si publication en ligne.

```html
DREYFUS, John et Fernand BAUDIN. «&#8239;L’invention des lunettes et l’apparition de l’imprimerie&#8239;». Dans&nbsp;: _Communication & Langages_. 1989, (N^o^&nbsp;79), pp. 73-86. 
```

### Pour citer une page web

Le titre de la page doit être en italique.

> NOM, Prénom des auteur⋅ices. _Titre de la page_. Date de publication (ou de mise à jour) si disponible. Site Internet. URL [Consulté le …].

```html
ERTZSCHEID, Olivier. _Une question de génération. Vers un capitalisme sémiotique_. 12 octobre 2022. Affordance.info. https://affordance.framasoft.org/2022/10/question-generation-capitalisme-semiotique/ [Consulté le 13 octobre 2022].
```

### Pour citer une vidéo en ligne

Le titre de la vidéo doit être en italique.

> NOM, Prénom des auteur⋅ices. _Titre de la vidéo_. Date si disponible. Disponible sur URL [Vidéo consultée le …].

```md
PRADIER, Manon. _Avec Vincent_. 2016. Disponible sur https://youtu.be/3DNsGRUHF7s [Vidéo consultée le 13 octobre 2022].
```

NB: les vidéos YouTube ont une URL courte (accessible via la commande “Partager”) préférable pour une mise en page plus condensée.

## Colonnes

Hors de la bibliographie, au sein du texte, le contenu peut également être réparti en trois colonnes en utilisant la notation&#8239;:

```md
::: columns

Contenu

:::
```

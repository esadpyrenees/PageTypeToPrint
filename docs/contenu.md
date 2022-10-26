[↩ Retour à la documentation](index.md)

## Configuration

Le fichier `config.php` doit être édité afin d’y référencer les différentes parties du document, saisir son titre, votre année, nom et diplôme.

## Le contenu

Un contenu de démonstration (texte et images) peut être [téléchargé ici](https://ateliers.esad-pyrenees.fr/pagetypetoprint/demo-base.zip). 

Le contenu du document est organisé sous la forme de documents texte au format markdown, qui permet de le structurer afin de le transformer automatiquement en HTML.
Voir plus bas [la documentation](#markdown) de la syntaxe markdown (titres, italiques, citations, etc.). 

Les différentes parties du document sont déclarées sous la forme d’un tableau associatif dans le fichier `config.php` :

```php
$parts = [
  [
    "title" => "Introduction", // le titre de la section, tel qu’il apparaitra dans le sommaire
    "file" => "text/1.intro.md", // le fichier markdown contenant le contenu (texte de la section)
    "template" => "default" // le gabarit de mise en page à utiliser (mis en forme via CSS)
  ],
  [
    "title" => "Titre 2",
    "file" => "2.deuxieme-partie.md",
    "template" => "default"
  ],
  …
]
```

Le `title` sert à déterminer l’`id` de la section et à générer le sommaire.

Les fichiers markdown (à l’extension `.md`) sont numérotés pour une meilleure organisation ; ils sont placés dans le dossier “text”.

À chaque partie peut être affecté un gabarit (*template*), qui permet de définir sa mise en forme (à la fois écran et print).


[↪ Gabarits de mise en page](gabarits.md)

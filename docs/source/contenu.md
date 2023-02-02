

## Configuration

Le fichier `config.php` doit être édité afin d’y référencer les différentes parties du document, saisir son titre, votre année, nom et diplôme.

## Le contenu

Un contenu de démonstration (texte et images) peut être [téléchargé ici](https://ateliers.esad-pyrenees.fr/pagetypetoprint/demo-base.zip). 

Le contenu du document est organisé sous la forme d’une série de documents au format [markdown](#markdown), correspondant à chacun des chapitres. Ces différentes sections sont déclarées dans le fichier `config.php` :

```php
$parts = [
  [
    // le titre de la section, tel qu’il apparaitra dans le sommaire
    "title" => "Introduction", 
    // le fichier markdown contenant le contenu (texte de la section)
    "file" => "text/1.intro.md", 
    // le gabarit de mise en page à utiliser (mis en forme via CSS)
    "template" => "default" 
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

Les fichiers markdown (à l’extension `.md`) peuvent être numérotés pour une meilleure organisation ; ils sont placés dans le dossier “text”.

À chaque partie peut être affecté un gabarit (*template*), qui permet de définir sa mise en forme (à la fois écran et print).




## Contenu 

PageTypeToPrint est fourni avec un contenu d’exemple, stocké dans le dossier `content`. S’il peut être intéreressant de conserver une copie de sauvegarde de ce dossier pour référence, la meilleure manière de démarrer est de **supprimer le contenu** des sous-dossiers `text` et `images`.

L’organisation des fichiers est libre ; mais la distinction entre textes et images (les dossiers `text` et `images`), tout comme la numérotation manuelle des fichiers markdown (`1.intro.md`, `2.partie1.md`, etc.) permet de consever une structure claire au contenu.

Pour prévenir tout problème, on veillera à **éviter accents, espaces ou capitales** dans les nom de fichiers et de dossiers.

## Configuration

Le fichier `config.yml` doit être édité afin d’y référencer les différentes parties du document, saisir son titre, votre année, nom et diplôme.

### Le thème

Les logiques d’affichage _screen_ et _print_ sont dépendantes du thème sélectionné dans le fichier `config.yml`: 
```yml
theme: esadpyrenees
```
### D2claration du contenu

Le contenu du document est organisé sous la forme d’une série de documents au format [markdown](#markdown), correspondant à chacune des sections du document. Ces différentes sections sont déclarées dans le fichier `config.yml` :

```yml
parts:

  - title: Introduction
    # ↑ le titre de la section, tel qu’il apparaitra dans le sommaire
    file: content/text/1.intro.md
    # ↑ le fichier markdown du contenu (texte de la section)
    template: default   
    # ↑ le gabarit de mise en page à utiliser 
    
  - title: Titre 2
    file: content/text/2.deuxieme-partie.md
    template: default
  
  …
```

Le `title` sert à déterminer l’`id` de la section et à générer le sommaire.

Les fichiers markdown (à l’extension `.md`) peuvent être numérotés pour une meilleure organisation ; ils sont placés par convention dans le dossier “content/text” mais peuvent être stockés ailleurs.

À chaque partie peut être affecté un gabarit (*template*), qui permet de définir sa mise en forme (à la fois écran et print).

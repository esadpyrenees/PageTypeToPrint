## Édition collaborative

Sur le principe largement répandu de « pad-to-print » ([pad2print](https://gitlab.com/Luuse/pad2print) de Luuse, [Ethertoff](http://osp.kitchen/tools/ethertoff/) ou [Ether2html](http://osp.kitchen/tools/ether2html/) d’Open Source Publishing, [Collabprint](https://gitlab.com/quentinjuhel/collabprint) de Quentin Juhel, [Octomode](https://git.vvvvvvaria.org/varia/octomode) de Varia), l’outil permet de déterminer des _pads_ comme source de contenus. 

La structure de contenu du document (une série de documents au format [markdown](#markdown)) est déclarée dans le fichier `config.yml`, mais plutôt que l’usage standard, dédié à des documents stockés dans un sous-dossier, on déclare alors l’url de pads publics :

```yml
parts:
  
  - title: Introduction collective
    # ↑ le titre de la section, tel qu’il apparaitra dans le sommaire
    file: ""
    # ↑ la déclaration "file" reste vide (ou est supprimée)
    pad: https://pad.esad-pyrenees.club/p/pagetypetoprint
    # ↑ on déclare l’URL du pad public
    template: default
    # ↑ le gabarit de mise en page
  …
```
Il est attendu que le contenu du pad soit nativement rédigé en markdown ; le format d’exportation utilisé étant la version texte brut.

NB: contrairement aux fichiers markdown locaux, il n’est pas possible d’écrire de HTML au sein des pads, mis à part pour l’usage de `<br>`. Les éventuelles class sont autorisées : `<br class="breakprint">`, ` <br class="breakpage">`, `<br class="breakcolumn">` ou `<br class="breakscreen">`.

Les entités HTML (`$nbsp;`, `&#8239;`, etc.) sont préservées.
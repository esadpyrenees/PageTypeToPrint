# Thème

Pour modifier l’apparence visuelle et les logiques fonctionnelles d’une publication, dupliquer l’un des thèmes fournis.

## Structure des thèmes

Chaque thème doit contenir à minima trois fichiers :

- `body.php`, qui contient la structure HTML du contenu ;
- `screen_head.php`, qui inclue les appels vers les fichiers CSS et JS nécessaires à l’affichage écran ;
- `print_head.php`, qui inclue les appels vers les fichiers CSS et JS nécessaires à la génération du document PDF imprimable (notamment, la librairie paged.js).

Les dossiers `css` et `js` contiennent les feuilles de styles et scripts pour chacun des thèmes.

## Thèmes par défaut

Le dossier `esadpyrenees` contient le thème par défaut, développé pour les mémoires de DNSEP et documents écrits de DNA de l’École supérieure d’art et de design des Pyrénées.

Le dossier `booklet` contient un thème dédié à la conception dun livret broché, au format A5.
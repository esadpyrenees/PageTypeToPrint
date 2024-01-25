# Changelog

Documentation des évolutions successives de l’outil.

L’[historique du dépôt](https://github.com/esadpyrenees/PageTypeToPrint/commits/main/) offre une vision plus détaillée, bien que plus bruyante.

### Hotfix

Mise à jour du _fixer_ JoliTypo par défaut pour prenndre en compte les unités (symboles monétaires, pourcentages…)


### Figures — 01 2024

Ajout d’une fonctionnalité d’insertion d’images qui permet d’insérer au sein du texte des appels de figures. L’affichage des figures est alors déporté en fin de section.

⚠️ Les logiques CSS liées aux figures (au fil du texte ou dans les annexes) introduisent une évolution incompatible avec le précédent système de mise en page : `(figure: fichier.jpg class: quarter)` devient `(figure: fichier.jpg width: 3)`. Voir [la documentation dédiée](https://esadpyrenees.github.io/PageTypeToPrint/appendices/).


### Yaml — 09 2023

À l’occasion de la rentrée 2023, un nettoyage et une nouvelle mise en forme de la documentation (bye bye ReadTheDocs) adossée à une configuration plus simple (php → yaml) du projet.


### Cambrai – 07 2023

Suite aux journées OpenOpen organisées par l’ÉSAC Cambrai, le fonctionnement de PageTypeToPrint a été revu pour améliorer et faciliter l’extensibilité de l’outil, notamment en y intégrant une logique de thème.
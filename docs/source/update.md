## Mise à jour de PageTypeToPrint

La dernière version de PageTypeTopPrint est accessible sur : [github.com/esadpyrenees/PageTypeToPrint](https://github.com/esadpyrenees/PageTypeToPrint/). On peut la télécharger ici :

<a class="bigbutton" href="https://github.com/esadpyrenees/PageTypeToPrint/zipball/main/">↓ Télécharger </a> 

Pour mettre à jour l’outil et conserver le contenu mis en forme dans une précédente version, deux possibilités :

### Pour (re)partir sur de bonnes bases

Assurez-vous de conserver une sauvegarde de votre travail.

Télécharger le fichier zip puis le décompresser dans un environnement de serveur web bénéficiant d’une version de PHP supérieure à 8.0 (par exemple, le dossier `htdocs` dans MAMP ; voir [Installation](installation.md)).

Supprimer le dossier `content` et le fichier `config.yml`, et les remplacer par ceux de la précédente version.

L’ensemble de la structure du document et de son contenu seront conservés, mais aucune des modifications apportées au [thème](theme.md) ne sera transférée.

### Conserver le thème personnalisé

Si l’on souhaite conserver des modifications apportées au thème, il est également possible, après avoir téléchargé la dernière version, de remplacer l’ancien dossier `_inc` par le nouveau (ce dossier contient les mécanismes internes à PageTypeToPrint ainsi que les librairies PHP MarkdownIt et JoliTypo).

Pour plus de finesse et de précision, consulter le fichier [Changelog](https://github.com/esadpyrenees/PageTypeToPrint/blob/main/CHANGELOG.md) qui indique quelles sont les dernières modifications et l’impact éventuel qu’elles peuvent avoir sur de précédentes installations. 
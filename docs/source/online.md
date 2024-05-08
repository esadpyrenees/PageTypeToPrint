
## Mise en ligne et publication

Une fois terminé le processus d’édition sur un serveur local, le document peut être mis en ligne sur un serveur web de production (le serveur de l’ÉSAD Pyrénées ou un compte étudiant hébergé par Alwaysdata – [me demander](mailto:julien.bidoret@esad-pyrenees.fr)). Il faut alors s’assurer que le serveur est bien capable de servir le site via une version de PHP supérieure à 8.0 (sur Alwaysdata, [voir ici](https://admin.alwaysdata.com/environment/)).

Le lien « Imprimer », présent dans le fichier `body.php` du thème (par défaut, `theme/esadpyrenees/body.php`) peut être supprimé pour ne conserver que le seul « Télécharger ».

### PTTP comme générateur de site statique

Si l’on souhaite générer un « site statique » (une simple page HTML, sans PHP ; par ex. pour héberger la page sur Neocities), on peut utiliser PHP en ligne de commande :

```sh
# pour générer la version web
php index.php > index.html
# pour générer la version imprimable 
# (pas très utile, mieux vaut mettre en ligne le PDF final)
php index.php '&print' > print.html
```

Dans le cas de PHP fourni par MAMP, il faut connaître le chemin de l’exécutable PHP :

```sh
# Exemple sur Mac OSX (vérifier la version de PHP)
/Applications/MAMP/bin/php/php8.1.0/bin/php index.php > index.html
```
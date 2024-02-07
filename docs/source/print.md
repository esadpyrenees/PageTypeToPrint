

## Version imprimable

On peut accéder à la prévisualisation de la version imprimable depuis l’URL `/?print`. Par exemple, `http://localhost:8888/pagetypetoprint/?print`.

### Générer un fichier PDF

Un fichier PDF peut être produit en utilisant la fonction « d’impression vers PDF » d’un navigateur compatible (Chromium ou Chrome) : Fichier > Imprimer > Format PDF . 

Quelques réglages de paramètres d’impression sont souvent nécessaires : désactiver les entêtes et pieds de pages du navigateur, contrôler la mise à l’échelle, vérifier le format, désactiver les marges par défaut et cocher l’option permettant d’imprimer les arrière-plans.

### Version finale téléchargeable

Suite à l’exportation du document au format PDF, le fichier résultant devra être stocké dans le dossier de publication. 

On peut alors saisir le nom du fichier dans `config.yml` :
```yml
# Le nom du fichier pdf généré, par ex. : titre-du-document--prenom-nom.pdf
pdf: "mon-fichier.pdf"
``` 

⚠️ Le lien « Imprimer », présent dans le fichier `body.php` du thème (par défaut, dans le dossier `theme/esadpyrenees/body.php`) pourra alors être supprimé pour ne conserver que le seul « Télécharger ».

### Poids de fichier

Si les images utilisées sont nombreuses et de haute définition, le poids du fichier pdf résultant peut être très important.

Il est alors nécessaire de compresser le PDF pour un envoi et une publication en ligne. On peut recourir à un [service en ligne](https://smallpdf.com/fr/compresser-pdf) ou utiliser [GhostScript](https://ghostscript.readthedocs.io/en/latest/Install.html) en ligne de commande :

```sh
gs -sDEVICE=pdfwrite -dCompatibilityLevel=1.4 -dPDFSETTINGS=/prepress -dNOPAUSE -dQUIET -dBATCH -sOutputFile=compressed.pdf source.pdf
```
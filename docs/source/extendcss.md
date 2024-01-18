## Modifier l’affichage

Pour modifier l’apparence des documents, il est possible de dupliquer le thème par défaut, pour être en mesure d’éditer à la fois les styles graphiques, les scripts et la structure HTML du document.

N’hésitez pas à partager vos thèmes ! En contribuant au [code sur GitHub](https://github.com/esadpyrenees/PageTypeToPrint/) ou par e-mail, en [me signalant](mailto:julien.bidoret@esad-pyrenees.fr) vos modifications.

### Changer le caractère typographique

Une fois le thème par défaut dupliqué et le fichier `config.yml` mis à jour, modifier le fichier `themes/votre_theme/css/style.css` du thème pour déclarer le (ou les) nouveau(x) catactère(s), et modifier la valeur de `--fontfamily` dans les propriétés personnalisées.

```css
@font-face {
  font-family: "Superserif";
  src: url("fonts/superserif.woff2") format("woff2");
  font-weight: normal;
  font-style: normal;
}
:root {
  /* typographie */
  --fontfamily: "Superserif", serif;
  …
}
```
### Supprimer l’identité de l’ÉSAD Pyrénées

Pour la couverture, supprimer l’arrière-plan du `header` dans le fichier `css/print.css` :
```css
#header {
  /*background: url(logo.svg) no-repeat 0 100%;*/
}
```
Pour les titre courants, supprimer l’image dans le fichier `body.php`:
```html
<!-- le folio courant (version print) -->
<div class="runningfolio">
    <span class="folio"></span>
    <!-- <img src="css/logo.png" alt="ESAD Pyrénées"> -->
</div>
```



### Modifier le format
Format et marges
```css
@page {
  size: 148mm 210mm;

  @bottom-left-corner {
    content: element(folioRunning);
    text-align: left;
  }
  @bottom-left{
    content: element(titleRunning);
    text-align: left;
  }
  @footnote {
    float: bottom;
  }
}  
@page:right{
  margin: 1cm 2cm 2.5cm 1cm;
}
@page:left{
  margin: 1cm 1cm 2.5cm 2cm;
}
@page cover {
  margin: 1cm 1cm 2.5cm 1cm;    
  @bottom-left-corner {
    display: none;
  }
  @bottom-left{
    display: none;
  }
}
@page:blank{
  @bottom-left-corner {
    display: none;
  }
  @bottom-left{
    display: none;
  }
}
```

<?php 
  // Le contenu et sa structure sont modifiables depuis le fichier config.php
  // Chargement de l’application de gestion du contenu
  require_once '_inc/PageTypeToPrint.php';    
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- dummy favicon -->
  <link href="data:image/x-icon;base64,AAABAAEAEBAQAAAAAAAoAQAAFgAAACgAAAAQAAAAIAAAAAEABAAAAAAAgAAAAAAAAAAAAAAAEAAAAAAAAAAAAAAAEhEQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAEAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAD//wAA//8AAP//AAD//wAA//8AAP//AAD//wAA//8AAP7/AAD//wAA//8AAP//AAD//wAA//8AAP//AAD//wAA" rel="icon" type="image/x-icon" />

  <!-- Le titre du mémoire / doc écrit – votre nom -->
  <title><?= strip_tags( $title ) ?> — <?= $name ?></title>
  
  <!-- Styles communs -->
  <link rel="stylesheet" href="css/style.css">

  <!-- Styles print -->
  <link rel="stylesheet" href="js/print/pagedjs.css">
  <!-- Styles print -->
  <link rel="stylesheet" href="css/print.css" media="print">    
  <!-- Paged.js -->
  <script src="js/print/paged.polyfill.js"></script>
  <!-- Notes iconographiques -->
  <script src="js/print/imageNotes.js"></script>
  <!-- Sommaire paginé -->
  <script src="js/print/createToc.js"></script> 
  <!-- Reload in place -->
  <script src="js/print/reloadInPlace.js"></script> 
  <!-- Notes de bas de page -->
  <script src="js/print/footNotes.js"></script> 
  <!-- URLs trop longues -->
  <script src="js/print/breakUrls.js"></script> 
  <!-- On print -->
  <script src="js/print/onPrint.js"></script>

  <!-- Aide pour la mise en page des images -->
  <?php if(isset($_GET["layout"])): ?>
    <script src="js/layout/turndown.js"></script>
    <script src="js/layout/layout.js"></script>    
    <link rel="stylesheet" href="js/layout/layout.css" media="screen">
  <?php endif ?>

</head>
<body>
    
  <!-- Le contenu HTML des versions écran et imprimable est identique -->
  <!-- Pour différencier les deux versions, supprimer l’inclusion de body ci-dessous et insérer, puis modifier son contenu -->
  <?php include("body.php") ?>

</body>
</html>
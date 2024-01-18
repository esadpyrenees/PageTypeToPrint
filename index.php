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
  <title><?= strip_tags( $title ) ?> <?= isset($name) ? "— $name" : "" ?></title>
  
  <!-- le thème -->
  <?php 
    // Si le fichier index.php est invoqué en ligne de commande :
    if (PHP_SAPI === 'cli'){ parse_str(implode('&', array_slice($argv, 1)), $_GET); }
    // Impression ou écran ?
    include( isset($_GET["print"]) ? "$theme_url/print_head.php" : "$theme_url/screen_head.php"); ?>
  
</head>
<body class="<?= isset($_GET["print"]) ? "print" : "screen" ?>" >
  
  <!-- Les contenus HTML des versions écran et imprimable sont identiques par défaut -->
  <!-- Il est possible de les différencier en utilisant une condition similaire au thème ci-dessus -->
  
  <?php include( $theme_url . "/body.php" )?>
  
</body>
</html>
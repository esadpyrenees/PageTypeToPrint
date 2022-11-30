<?php 
  // Le contenu et sa structure sont modifiables depuis le fichier config.php
  // Chargement de l’application de gestion du contenu
  require_once '_inc/pagetypetoprint.php';    
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Le titre du mémoire / doc écrit – votre nom -->
  <title><?= $title ?> — <?= $name ?></title>
  
  <!-- Styles communs -->
  <link rel="stylesheet" href="css/style.css">

  <?php if(isset($_GET["print"])): ?>
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
  <?php else :?>    
    <!-- Notes de marge -->
    <script src="js/screen/sideNotes.js"></script>
    <!-- Scripts communs -->
    <script src="js/screen/script.js"></script>
  <?php endif ?>
  <!-- Aide pour la mise en page des images -->
  <?php if(isset($_GET["layout"])): ?>
    <script src="js/layout/turndown.js"></script>
    <script src="js/layout/layout.js"></script>    
    <link rel="stylesheet" href="js/layout/layout.css" media="screen">
  <?php endif ?>
</head>
<body>
    
  <header id="header">
    <!-- Le titre du mémoire / doc écrit -->
    <h1><?= $title ?></h1>
    <!-- Le sous-titre éventuel (si pas de sous-titre, supprimer le h2) -->
    <h2><?= $subtitle ?></h2>

    <!-- le titre courant (version print) -->
    <div class="runningtitle">
      <div><?= $name ?></div>
      <div><?= $title ?></div>
    </div>

    <!-- le folio courant (version print) -->
    <div class="runningfolio">
      <span class="folio"></span>
      <img src="css/logo.png" alt="ESAD Pyrénées">
      <!-- Votre diplôme -->
      <span class="diploma"><?= $diploma ?></span>
    </div>
    
    <div class="meta">
      <!-- l’année YYYY – YYYY  -->
      <div class="meta-year"><?= $year ?></div>
      <!-- Votre nom -->
      <div class="meta-name"><?= $name ?></div>
      <div class="meta-data">
        <!-- Votre diplôme, option et mention -->
        <p>
          <?= $diploma ?> <br>
          <?= $mention ?> 
        </p>
        <p>
          École supérieure d’art &amp; de design des&nbsp;Pyrénées<br> 
          <!-- Votre pôle éventuel -->
          <?= $pole ?>
        </p>
      </div>
    </div>
    <nav>
      <a href="#nav">Lire en ligne</a>
      <a href="?print" title="Web to print">Imprimer</a>
      <!-- Modifier l’URL -->
      <a href="<?= $pdf ?>">Télécharger</a>
    </nav>
  </header>

  <!-- la navigation (= le sommaire) -->
  <nav id="nav">
    <h2>Sommaire</h2>
    <ul class="nav-ul">
      <?= $nav() ?>
    </ul>
  </nav>

  <main id="main">
    <!-- le contenu -->      
    <?= $html() ?>
  </main>

</body>
</html>
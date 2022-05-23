<?php 

  // Contenu
  $parts = [
    [
      "title" => "Introduction",
      "file" => "text/1.intro.md",
      "template" => "default"
    ],
    [
      "title" => "L’album comme média spécifique",
      "file" => "text/2.album.md",
      "template" => "default"
    ],
    [
      "title" => "L’album, vecteur de stéréotypes de genre&nbsp;?",
      "file" => "text/3.vecteur.md",
      "template" => "default"
    ],
    [
      "title" => "Une réelle (r)évolution ?",
      "file" => "text/4.revolution.md",
      "template" => "default"
    ],
    [
      "title" => "En conclusion",
      "file" => "text/5.conclusion.md",
      "template" => "default"
    ],
    [
      "title" => "Annexes",
      "file" => "text/6.annexes.md",
      "template" => "appendices"
    ],
    [
      "title" => "Entretiens",
      "file" => "text/7.entretiens.md",
      "template" => "interview"
    ],
    [
      "title" => "Glossaire",
      "file" => "text/8.glossaire.md",
      "template" => "references"
    ],
    [
      "title" => "Références",
      "file" => "text/9.references.md",
      "template" => "references"
    ],
    [
      "title" => "Remerciements",
      "file" => "text/10.remerciements.md",
      "template" => "default"
    ]
  ];

  // chargement de l’application de gestion du contenu
  include_once '_inc/pttp.php';  
  
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Album jeunesse et stéréotypes de genre, une (r)évolution&nbsp;? — Aurore Tajan</title>
  <link rel="stylesheet" href="css/style.css">
  <?php if(isset($_GET["print"])): ?>
    <link rel="stylesheet" href="js/paged/pagedjs.css">
    <link rel="stylesheet" href="css/print.css" media="print">
    <script>paged = true</script>
    <script src="js/paged/paged.polyfill.js"></script>
    <!-- Notes de marge -->
    <script src="js/paged/marginNotes.js" type="text/javascript"></script>
    <!-- Sommaire paginé -->
    <script src="js/paged/createToc.js"></script> 
    <!-- Reload in place -->
    <script src="js/paged/reloadInPlace.js"></script> 
    <!-- Autres -->
    <script src="js/paged/handlers.js"></script> 
  <?php else :?>
    <script>paged = false;</script>
    <script src="js/notes.js"></script>
    <script src="js/script.js"></script>
  <?php endif ?>
</head>
<body>

  <header id="header">
    <!-- Le titre du mémoire / doc écrit -->
    <h1>Album jeunesse et stéréotypes de genre, une (r)évolution ?</h1>
    <!-- Le sous-titre éventuel (si pas de sous-titre, supprimer le h2) -->
    <h2></h2>

    <!-- le titre courant (version print) -->
    <div class="runningtitle">
      <div>Aurore Tajan</div>
      <div>Album jeunesse et stéréotypes de genre, une (r)évolution ?</div>
    </div>

    <!-- le folio courant (version print) -->
    <div class="runningfolio">
      <span class="folio"></span>
      <img src="css/logo.png" alt="">
      <!-- Votre diplôme -->
      <span class="diploma">DNA Design</span>
    </div>
    
    <div class="meta">
      <!-- l’année YYYY – YYYY  -->
      <div class="meta-year">2021 – 2022</div>
      <!-- Votre nom -->
      <div class="meta-name">Aurore Tajan</div>
      <div class="meta-data">
        <!-- Votre diplôme, option et mention -->
        <p>
          DNA Design <br>
          Mention Design graphique Multimédia 
        </p>
        <p>
          École supérieure d’art &amp; de design des&nbsp;Pyrénées<br> 
          <!-- Votre pôle éventuel -->
          Pôle Nouveaux médias
        </p>
      </div>
    </div>
    <nav>
      <a href="#nav">Lire en ligne</a>
      <a href="?print" title="Web to print: Chrome ou Chromium">Imprimer</a>
      <a href="url_du_document.pdf">Télécharger</a>
    </nav>
  </header>

  <!-- la navigation (= le sommaire) -->
  <nav id="nav">
    <h2>Sommaire</h2>
    <ul class="nav-ul">
    <?php foreach($parts as $part): 
      $title = $part["title"];
      $template = $part["template"];
      $slug = slugify($title);
      ?>
      <li id="nav-<?= $slug ?>" class="nav-<?= $template ?>"><a href="#<?= $slug ?>"><?= $title ?></a></li>
    <?php endforeach ?>
    </ul>
  </nav>

  <main id="main">
    <!-- le contenu -->      
    <?= buildHTML($parts) ?>
  </main>

</body>
</html>
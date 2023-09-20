<header id="header">
    <!-- Le titre  -->
    <h1><?= $title ?></h1>
    <!-- le folio -->
    <span class="folio"></span>
    <!-- affichage des méta-données spécifiques -->
    <div class="meta">
        <span class="meta-url"><a href="<?= $url ?>"><?= $url ?></a></span>        
        <span class="meta-date"><?= $date ?></span>
        <a href="?print">print!</a>
    </div>
</header>
<main id="main">
    <!-- le contenu -->      
    <?= $html() ?>
</main>
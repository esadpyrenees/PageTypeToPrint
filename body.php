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
        École supérieure <br class="breakprint">d’art &amp; de design <br class="breakprint">des&nbsp;Pyrénées<br>  <br class="breakprint">
        <!-- Votre pôle éventuel -->
        <?= $pole ?>
    </p>
    </div>
</div>
<nav id="quicklinks">
    <a href="#nav">Lire en ligne</a>
    <a href="print.php" title="Web to print">Imprimer</a>
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
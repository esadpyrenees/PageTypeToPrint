<!-- Styles communs -->
<link rel="stylesheet" href="<?= $theme_url ?>/css/style.css">

<!-- Notes de marge -->
<script src="<?= $theme_url ?>/js/screen/sideNotes.js" media="screen"></script>
<!-- Scripts communs  -->
<script src="<?= $theme_url ?>/js/screen/script.js" media="screen"></script>

<!-- Aide pour la mise en page des images -->
<?php if(isset($_GET["layout"])): ?>
  <script src="<?= $theme_url ?>/js/layout/turndown.js"></script>
  <script src="<?= $theme_url ?>/js/layout/layout.js"></script>    
  <link rel="stylesheet" href="<?= $theme_url ?>/js/layout/layout.css" media="screen">
<?php endif ?>
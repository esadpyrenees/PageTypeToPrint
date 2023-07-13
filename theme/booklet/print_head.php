<!-- Styles communs -->
<link rel="stylesheet" href="<?= $theme_url ?>/css/style.css">
<!-- Styles print (paged js) -->
<link rel="stylesheet" href="<?= $theme_url ?>/js/print/pagedjs.css">
<!-- Styles print -->
<link rel="stylesheet" href="<?= $theme_url ?>/css/print.css" media="print">    

<!-- Paged.js -->
<script src="<?= $theme_url ?>/js/print/paged.polyfill.js"></script>
<!-- Sommaire paginé -->
<script src="<?= $theme_url ?>/js/print/createToc.js"></script> 
<!-- Reload in place -->
<script src="<?= $theme_url ?>/js/print/reloadInPlace.js"></script> 
<!-- Notes de bas de page -->
<script src="<?= $theme_url ?>/js/print/footNotes.js"></script> 
<!-- URLs trop longues -->
<script src="<?= $theme_url ?>/js/print/breakUrls.js"></script> 
<!-- On print -->
<script src="<?= $theme_url ?>/js/print/onPrint.js"></script>

<!-- Aide pour la mise en page des images -->
<?php if(isset($_GET["layout"])): ?>
  <script src="<?= $theme_url ?>/js/layout/turndown.js"></script>
  <script src="<?= $theme_url ?>/js/layout/layout.js"></script>    
  <link rel="stylesheet" href="<?= $theme_url ?>/js/layout/layout.css" media="screen">
<?php endif ?>

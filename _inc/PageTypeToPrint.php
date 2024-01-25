<?php 
  
  /* 
  
    Ce fichier permet de générer la structure HTML de la navigation et du texte, 
    au sein de deux variables : `$nav` et `$html`.

    La structure du `$html` est déterminée en fonction du template utilisé pour 
    chaque partie du document, tel que définis dans le fichier config.php.

    Le contenu de chaque fichier markdown est soumis au parsing de la librairie
    MarkdownIt qui transforme le texte en html et lui applique plusieurs plugins :
      - notes de bas de page
      - balises sup, sub, abbr, dl et mark
      - balises personnalisées (mise en colonnes, glossaire)

    Les shortcodes (image: …), (figure: …), (imagenote: …) et (video: …) sont traités grâce 
    aux fonctions situées dans le fichier Specials/Tags.php

    La micro-typographie française est corrigée automatiquement (autant que 
    possible) grâce à la librairie JoliTypo.

    Enfin, au contenu textuel des liens hypertextes (<a href="">contenu</a>)  
    sont automatiquement insérés des sauts de ligne conditionnels (<wbr>)
    permettant d’éviter aux liens trop longs de “casser” la mise en page.

    --

    This file generates the HTML structure of the navigation and text, within 
    two variables: `$nav` and `$html`.

    The structure of the `$html` is determined by the template used for each 
    part of the document, as defined in config.php.

    The content of each markdown file is parsed by the MarkdownIt library 
    which transforms the text into html and applies several plugins to it:
      - footnotes
      - sup, sub, abbr, dl and mark tags
      - custom tags (column layout, glossary)

    Shortcodes (image: …), (figure: …), (imagenote: …) and (video: …) are handled by 
    functions in the Specials/Tags.php file

    The French micro-typography is automatically corrected (as far as possible) 
    possible) thanks to the JoliTypo library.

    Finally, to the textual content of hyperlinks (<a href="">content</a>)  
    are automatically inserted with conditional line breaks (<wbr>)
    to avoid long links "breaking" the page layout.

  */


  // Configure the content structure in ../config.yml:
  require_once __DIR__ . '/Spyc/Spyc.php'; 
  extract( Spyc::YAMLLoad(__DIR__."/../config.yml") ); 

  // Loading libraries
  spl_autoload_register(function ($class) {
    $file = preg_replace('#\\\|_(?!.+\\\)#','/', $class) . '.php';
    if (stream_resolve_include_path($file)){
      require $file;
    }
  });
  use JoliTypo\Fixer;
  use Kaoken\MarkdownIt\MarkdownIt;
  use Kaoken\MarkdownIt\Plugins\MarkdownItFootnote;
  use Kaoken\MarkdownIt\Plugins\MarkdownItSup;
  use Kaoken\MarkdownIt\Plugins\MarkdownItDeflist;
  use Kaoken\MarkdownIt\Plugins\MarkdownItContainer;
  use Kaoken\MarkdownIt\Plugins\MarkdownItMark;
  use Kaoken\MarkdownIt\Plugins\MarkdownItSub;
  use Kaoken\MarkdownIt\Plugins\MarkdownItAbbr;
  
  // Loading utilities
  include_once 'PageTypeToPrint/Tags.php';
  include_once 'PageTypeToPrint/Pad.php';
  include_once 'PageTypeToPrint/BreakAnchors.php';
  include_once 'PageTypeToPrint/AutoFolder.php';

  // theme URL
  $theme_url = "theme/" . ( isset($theme) ? $theme : "esadpyrenees" );
   
  // Util: format markdown text from files
  // build nav
  $nav = function() use($parts){
    $nav = "";
    foreach($parts as $part){
      $part_title = $part["title"];
      $template = $part["template"];
      // each section is assigned an `id` generated from the section title
      $slug = slugify($part_title);
      $nav .= "<li id='nav-$slug' class='nav-$template'><a href='#$slug'>$part_title</a></li>";
    }
    return $nav;
  };  

    
  // Running title, if set
  $runningtitle = isset($runningtitle) ? $runningtitle : $title;
  
  // Util: format markdown text from files
  // build html
  $html = function() use($parts, $name){
    
    // Setup an empty mardown string
    $md = "";

    // Concatenate parts
    foreach($parts as $part){

      // switch between sources modes :
      // - $file: a markdown file
      // - $pad: a public etherpad url
      // - $folder: a folder to autoload images

      $file = array_key_exists("file", $part) ? $part["file"] : null; 
      $pad = array_key_exists("pad", $part) ? $part["pad"] : null;
      $folder = array_key_exists("folder", $part) ? $part["folder"] : null;

      if (empty($file) && !empty($pad) ) {
        // we have a pad URL…
        // wait 500ms in hope to avoid “HTTP/1.1 429 Too Many Requests”
        usleep(500 * 1000); 
        $content = pad_get_contents( $pad );
      } else if (empty($file) && !empty($folder) ) {
        // we have a folder of images…
        $content = folder_get_contents( $folder );
      } else if(!empty($file)) {
        // we have a local file
        $content = file_get_contents( $file );
      } else {
        // we got nothing…
        $dump = var_export($part, true);
        $content = "No content source found within this part:<br><pre>$dump</pre>";
      }

      // base data for each part
      $part_title = $part["title"];
      $template = $part["template"] ;
      // each section is assigned an `id` generated from the section title
      $slug = slugify( $part_title );

      // According to template, set the HTML structure of part
      if($template != "default"){
        $content = "<div class='runningtitle'><div>$name</div><div>$part_title</div></div>\n\n$content";
      }
      if($template == "appendices" || $template == "autofolder"){
        $content = "<h2>$part_title</h2><div class='content' markdown=1>\n\n$content\n\n</div>";
      }
      // parse shortcodes and iconographic groups
      $specials = specials($content); 
      $content = $specials["md"];
      $figures = $specials["figures"];

      // add content to markdown string 
      $md .= "<section id='$slug' class='$template' markdown=1>\n\n$content\n\n</section>\n\n";
      // if we need to include an icnographic group at the end of the previous section
      $figures_count = count($figures);
      if($figures_count){ 
        $md .= "<section id='$slug-figure' class='figures_page' markdown=1 data-figures-count='$figures_count'><div class='content' markdown=1>\n\n";
        foreach($figures as $figure){
          $md .= $figure;
        }
        $md .= "\n\n</div></section>\n\n";
      }
     
    }


    // MarkdownIt instanciation
    // Documentation : https://github.com/markdown-it/markdown-it
    $mdit = new MarkdownIt([
      "html"=> true, // Enable HTML tags in source
      "typographer"=> false, // Enable some language-neutral replacement + quotes beautification
      "linkify"=> true // Autoconvert URL-like text to links
    ]);

    // MarkdownIt standard plugins
    $mdit->plugin(new MarkdownItFootnote());
    $mdit->plugin(new MarkdownItSup());
    $mdit->plugin(new MarkdownItDeflist());
    $mdit->plugin(new MarkdownItMark() );
    $mdit->plugin(new MarkdownItSub() );
    $mdit->plugin(new MarkdownItSup() );
    $mdit->plugin(new MarkdownItAbbr() );
    // MarkdownIt custom plugins
    $mdit->plugin(new MarkdownItContainer(), "columns");
    $mdit->plugin(new MarkdownItContainer(), "glossary", ["marker" => "¶"]);
    $mdit->plugin(new MarkdownItContainer(), "term");

    $html = $mdit->render($md);
    
    // Fix typography with JoliTypo Fixer
    // Documentation : https://github.com/jolicode/JoliTypo
    $fixer = new Fixer(array('Ellipsis', 'Dash', 'SmartQuotes', 'CurlyQuote', 'NoSpaceBeforeComma', 'Unit', 'FrenchNoBreakSpace'));
    $fixer->setLocale('fr_FR');
    $html = $fixer->fix($html);
    
    // break long anchor texts
    $html = breakAnchors($html);

    // Return HTML
    return $html;
    
  };

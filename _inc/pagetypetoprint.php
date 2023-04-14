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

    Les shortcodes (figure: …), (imagenote: …) et (video: …) sont traités grâce 
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

    Shortcodes (figure: …), (imagenote: …) and (video: …) are handled by 
    functions in the Specials/Tags.php file

    The French micro-typography is automatically corrected (as far as possible) 
    possible) thanks to the JoliTypo library.

    Finally, to the textual content of hyperlinks (<a href="">content</a>)  
    are automatically inserted with conditional line breaks (<wbr>)
    to avoid long links "breaking" the page layout.

  */


  // Configure the content structure here:
  include __DIR__."/../config.php";
  

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
  include_once 'Specials/Tags.php';
  
  
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
    
  
  // Util: format markdown text from files
  // build html
  $html = function() use($parts, $name){
    $md = "";
    // Concatenate parts
    foreach($parts as $part){

      $file = $part["file"];
      $pad = $part["pad"];

      if (empty($file) && !empty($pad) ) {
        // we have a pad URL…
        $content = pad_get_contents( $pad );
      } else {
        // local file
        $content = file_get_contents( $file );
      }
      
      $part_title = $part["title"];
      $template = $part["template"] ;
      // each section is assigned an `id` generated from the section title
      $slug = slugify( $part_title );

      // According to template, set the HTML structure of part
      if($template != "default"){
        $content = "<div class='runningtitle'><div>$name</div><div>$part_title</div></div>\n\n$content";
      }
      if($template == "appendices"){
        $content = "<h2>$part_title</h2><div class='content' markdown=1>\n\n$content\n\n</div>";
      }
      $md .= "<section id='$slug' class='$template' markdown=1>\n\n$content\n\n</section>\n\n";
    }
    // Parse special tags (figure, image, video)
    $md = specials($md);

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
    $fixer = new Fixer(array('Ellipsis', 'Dash', 'SmartQuotes', 'CurlyQuote', 'FrenchNoBreakSpace'));
    $fixer->setLocale('fr_FR');
    $html = $fixer->fix($html);
    
    // break long anchor texts
    $html = breakAnchorTexts($html);
    // Return HTML
    return $html;
    
  };

  function breakAnchorTexts($doc){
    function insertWbr($anchortext){
      return "a" . $anchortext;
    };
    return preg_replace_callback('/<a(.+?)>(.+?)<\/a>/i', function($matches){
      // var_dump($matches[1]);
      $html = "<a" . $matches[1] . ">";
      $anchortext = $matches[2];
      $anchortext = preg_replace("/\/\//",  '//<wbr>', $anchortext );
      $anchortext = preg_replace("/,/",  ',<wbr>', $anchortext );
      $anchortext = preg_replace("/(\/|\~|\-|\.|\,|\_|\?|\#|\%)/",  "<wbr>$1", $anchortext );
      $anchortext = preg_replace("/,/",  ',<wbr>&#8209;', $anchortext );
      $html .= $anchortext;
      $html .= "</a>";
      return $html;
    }, $doc);
  }
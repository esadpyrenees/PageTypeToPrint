<?php 
  
  // Configurer le contenu ici :
  include __DIR__."/../config.php";
  
  // Chargement des librairies
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
  use Kaoken\MarkdownIt\Plugins\YoutubeIt;
  
  // Chargement des utilitaires
  include_once 'Specials/Tags.php';
  
  
  // Util: format markdown text from files
  $nav = function() use($parts){
    $nav = "";
    foreach($parts as $part){
      $part_title = $part["title"];
      $template = $part["template"];
      $slug = slugify($part_title);
      $nav .= "<li id='nav-$slug' class='nav-$template'><a href='#$slug'>$part_title</a></li>";
    }
    return $nav;
  };  
    
  

  // Util: format markdown text from files
  $html = function() use($parts, $name){
    $md = "";
    // Concatenate parts
    foreach($parts as $part){
      $part_title = $part["title"];
      $slug = slugify( $part_title );
      $content = file_get_contents( $part["file"] );
      $template = $part["template"] ;
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
    
    $mdit = new MarkdownIt([
       "html"=> true,
       "typographer"=> true,
       "linkify"=> true,
       "typographer" =>  false
    ]);
    $mdit->plugin(new MarkdownItFootnote());
    $mdit->plugin(new MarkdownItSup());
    $mdit->plugin(new MarkdownItDeflist());
    // $mdit->plugin(new YoutubeIt());
    $mdit->plugin(new MarkdownItContainer(), "columns");
    $mdit->plugin(new MarkdownItContainer(), "glossary", ["marker" => "¶"]);
    $mdit->plugin(new MarkdownItContainer(), "term");

    $html = $mdit->render($md);
    
    // Fix typography
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
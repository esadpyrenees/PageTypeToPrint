<?php
  use Kaoken\MarkdownIt\MarkdownIt;

  // Util: slugify string
  function remove_accent($str){
    $char_map = ['À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'Ae', 'Å'=>'A', 'Æ'=>'A', 'Ā'=>'A', 'Ą'=>'A', 'Ă'=>'A', 'Ç'=>'C', 'Ć'=>'C', 'Č'=>'C', 'Ĉ'=>'C', 'Ċ'=>'C', 'Ď'=>'D', 'Đ'=>'D', 'È'=>'E', 'É'=>'E', 'Ê'=>'E', 'Ë'=>'E', 'Ē'=>'E', 'Ę'=>'E', 'Ě'=>'E', 'Ĕ'=>'E', 'Ė'=>'E', 'Ĝ'=>'G', 'Ğ'=>'G', 'Ġ'=>'G', 'Ģ'=>'G', 'Ĥ'=>'H', 'Ħ'=>'H', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ī'=>'I', 'Ĩ'=>'I', 'Ĭ'=>'I', 'Į'=>'I', 'İ'=>'I', 'Ĳ'=>'IJ', 'Ĵ'=>'J', 'Ķ'=>'K', 'Ľ'=>'K', 'Ĺ'=>'K', 'Ļ'=>'K', 'Ŀ'=>'K', 'Ł'=>'L', 'Ñ'=>'N', 'Ń'=>'N', 'Ň'=>'N', 'Ņ'=>'N', 'Ŋ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'Oe', 'Ø'=>'O', 'Ō'=>'O', 'Ő'=>'O', 'Ŏ'=>'O', 'Œ'=>'OE', 'Ŕ'=>'R', 'Ř'=>'R', 'Ŗ'=>'R', 'Ś'=>'S', 'Ş'=>'S', 'Ŝ'=>'S', 'Ș'=>'S', 'Š'=>'S', 'Ť'=>'T', 'Ţ'=>'T', 'Ŧ'=>'T', 'Ț'=>'T', 'Ù'=>'', 'Ú'=>'', 'Û'=>'', 'Ü'=>'Ue', 'Ū'=>'', 'Ů'=>'', 'Ű'=>'', 'Ŭ'=>'', 'Ũ'=>'', 'Ų'=>'', 'Ŵ'=>'W', 'Ŷ'=>'Y', 'Ÿ'=>'Y', 'Ý'=>'Y', 'Ź'=>'Z', 'Ż'=>'Z', 'Ž'=>'Z', 'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'ae', 'ā'=>'a', 'ą'=>'a', 'ă'=>'a', 'å'=>'a', 'æ'=>'ae', 'ç'=>'c', 'ć'=>'c', 'č'=>'c', 'ĉ'=>'c', 'ċ'=>'c', 'ď'=>'d', 'đ'=>'d', 'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ē'=>'e', 'ę'=>'e', 'ě'=>'e', 'ĕ'=>'e', 'ė'=>'e', 'ƒ'=>'f', 'ĝ'=>'g', 'ğ'=>'g', 'ġ'=>'g', 'ģ'=>'g', 'ĥ'=>'h', 'ħ'=>'h', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ī'=>'i', 'ĩ'=>'i', 'ĭ'=>'i', 'į'=>'i', 'ı'=>'i', 'ĳ'=>'ij', 'ĵ'=>'j', 'ķ'=>'k', 'ĸ'=>'k', 'ł'=>'l', 'ľ'=>'l', 'ĺ'=>'l', 'ļ'=>'l', 'ŀ'=>'l', 'ñ'=>'n', 'ń'=>'n', 'ň'=>'n', 'ņ'=>'n', 'ŉ'=>'n', 'ŋ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o', 'ö'=>'oe', 'ø'=>'o', 'ō'=>'o', 'ő'=>'o', 'ŏ'=>'o', 'œ'=>'oe', 'ŕ'=>'r', 'ř'=>'r', 'ŗ'=>'r', 'ś'=>'s', 'š'=>'s', 'ť'=>'t', 'ù'=>'', 'ú'=>'', 'û'=>'', 'ü'=>'ue', 'ū'=>'', 'ů'=>'', 'ű'=>'', 'ŭ'=>'', 'ũ'=>'', 'ų'=>'', 'ŵ'=>'w', 'ÿ'=>'y', 'ý'=>'y', 'ŷ'=>'y', 'ż'=>'z', 'ź'=>'z', 'ž'=>'z', 'ß'=>'ss', 'ſ'=>'ss', 'Α'=>'A', 'Ά'=>'A', 'Ἀ'=>'A', 'Ἁ'=>'A', 'Ἂ'=>'A', 'Ἃ'=>'A', 'Ἄ'=>'A', 'Ἅ'=>'A', 'Ἆ'=>'A', 'Ἇ'=>'A', 'ᾈ'=>'A', 'ᾉ'=>'A', 'ᾊ'=>'A', 'ᾋ'=>'A', 'ᾌ'=>'A', 'ᾍ'=>'A', 'ᾎ'=>'A', 'ᾏ'=>'A', 'Ᾰ'=>'A', 'Ᾱ'=>'A', 'Ὰ'=>'A', 'Ά'=>'A', 'ᾼ'=>'A', 'Β'=>'B', 'Γ'=>'G', 'Δ'=>'D', 'Ε'=>'E', 'Έ'=>'E', 'Ἐ'=>'E', 'Ἑ'=>'E', 'Ἒ'=>'E', 'Ἓ'=>'E', 'Ἔ'=>'E', 'Ἕ'=>'E', 'Έ'=>'E', 'Ὲ'=>'E', 'Ζ'=>'Z', 'Η'=>'I', 'Ή'=>'I', 'Ἠ'=>'I', 'Ἡ'=>'I', 'Ἢ'=>'I', 'Ἣ'=>'I', 'Ἤ'=>'I', 'Ἥ'=>'I', 'Ἦ'=>'I', 'Ἧ'=>'I', 'ᾘ'=>'I', 'ᾙ'=>'I', 'ᾚ'=>'I', 'ᾛ'=>'I', 'ᾜ'=>'I', 'ᾝ'=>'I', 'ᾞ'=>'I', 'ᾟ'=>'I', 'Ὴ'=>'I', 'Ή'=>'I', 'ῌ'=>'I', 'Θ'=>'TH', 'Ι'=>'I', 'Ί'=>'I', 'Ϊ'=>'I', 'Ἰ'=>'I', 'Ἱ'=>'I', 'Ἲ'=>'I', 'Ἳ'=>'I', 'Ἴ'=>'I', 'Ἵ'=>'I', 'Ἶ'=>'I', 'Ἷ'=>'I', 'Ῐ'=>'I', 'Ῑ'=>'I', 'Ὶ'=>'I', 'Ί'=>'I', 'Κ'=>'K', 'Λ'=>'L', 'Μ'=>'M', 'Ν'=>'N', 'Ξ'=>'KS', 'Ο'=>'O', 'Ό'=>'O', 'Ὀ'=>'O', 'Ὁ'=>'O', 'Ὂ'=>'O', 'Ὃ'=>'O', 'Ὄ'=>'O', 'Ὅ'=>'O', 'Ὸ'=>'O', 'Ό'=>'O', 'Π'=>'P', 'Ρ'=>'R', 'Ῥ'=>'R', 'Σ'=>'S', 'Τ'=>'T', 'Υ'=>'Y', 'Ύ'=>'Y', 'Ϋ'=>'Y', 'Ὑ'=>'Y', 'Ὓ'=>'Y', 'Ὕ'=>'Y', 'Ὗ'=>'Y', 'Ῠ'=>'Y', 'Ῡ'=>'Y', 'Ὺ'=>'Y', 'Ύ'=>'Y', 'Φ'=>'F', 'Χ'=>'X', 'Ψ'=>'PS', 'Ω'=>'O', 'Ώ'=>'O', 'Ὠ'=>'O', 'Ὡ'=>'O', 'Ὢ'=>'O', 'Ὣ'=>'O', 'Ὤ'=>'O', 'Ὥ'=>'O', 'Ὦ'=>'O', 'Ὧ'=>'O', 'ᾨ'=>'O', 'ᾩ'=>'O', 'ᾪ'=>'O', 'ᾫ'=>'O', 'ᾬ'=>'O', 'ᾭ'=>'O', 'ᾮ'=>'O', 'ᾯ'=>'O', 'Ὼ'=>'O', 'Ώ'=>'O', 'ῼ'=>'O', 'α'=>'a', 'ά'=>'a', 'ἀ'=>'a', 'ἁ'=>'a', 'ἂ'=>'a', 'ἃ'=>'a', 'ἄ'=>'a', 'ἅ'=>'a', 'ἆ'=>'a', 'ἇ'=>'a', 'ᾀ'=>'a', 'ᾁ'=>'a', 'ᾂ'=>'a', 'ᾃ'=>'a', 'ᾄ'=>'a', 'ᾅ'=>'a', 'ᾆ'=>'a', 'ᾇ'=>'a', 'ὰ'=>'a', 'ά'=>'a', 'ᾰ'=>'a', 'ᾱ'=>'a', 'ᾲ'=>'a', 'ᾳ'=>'a', 'ᾴ'=>'a', 'ᾶ'=>'a', 'ᾷ'=>'a', 'β'=>'b', 'γ'=>'g', 'δ'=>'d', 'ε'=>'e', 'έ'=>'e', 'ἐ'=>'e', 'ἑ'=>'e', 'ἒ'=>'e', 'ἓ'=>'e', 'ἔ'=>'e', 'ἕ'=>'e', 'ὲ'=>'e', 'έ'=>'e', 'ζ'=>'z', 'η'=>'i', 'ή'=>'i', 'ἠ'=>'i', 'ἡ'=>'i', 'ἢ'=>'i', 'ἣ'=>'i', 'ἤ'=>'i', 'ἥ'=>'i', 'ἦ'=>'i', 'ἧ'=>'i', 'ᾐ'=>'i', 'ᾑ'=>'i', 'ᾒ'=>'i', 'ᾓ'=>'i', 'ᾔ'=>'i', 'ᾕ'=>'i', 'ᾖ'=>'i', 'ᾗ'=>'i', 'ὴ'=>'i', 'ή'=>'i', 'ῂ'=>'i', 'ῃ'=>'i', 'ῄ'=>'i', 'ῆ'=>'i', 'ῇ'=>'i', 'θ'=>'th', 'ι'=>'i', 'ί'=>'i', 'ϊ'=>'i', 'ΐ'=>'i', 'ἰ'=>'i', 'ἱ'=>'i', 'ἲ'=>'i', 'ἳ'=>'i', 'ἴ'=>'i', 'ἵ'=>'i', 'ἶ'=>'i', 'ἷ'=>'i', 'ὶ'=>'i', 'ί'=>'i', 'ῐ'=>'i', 'ῑ'=>'i', 'ῒ'=>'i', 'ΐ'=>'i', 'ῖ'=>'i', 'ῗ'=>'i', 'κ'=>'k', 'λ'=>'l', 'μ'=>'m', 'ν'=>'n', 'ξ'=>'ks', 'ο'=>'o', 'ό'=>'o', 'ὀ'=>'o', 'ὁ'=>'o', 'ὂ'=>'o', 'ὃ'=>'o', 'ὄ'=>'o', 'ὅ'=>'o', 'ὸ'=>'o', 'ό'=>'o', 'π'=>'p', 'ρ'=>'r', 'ῤ'=>'r', 'ῥ'=>'r', 'σ'=>'s', 'ς'=>'s', 'τ'=>'t', 'υ'=>'y', 'ύ'=>'y', 'ϋ'=>'y', 'ΰ'=>'y', 'ὐ'=>'y', 'ὑ'=>'y', 'ὒ'=>'y', 'ὓ'=>'y', 'ὔ'=>'y', 'ὕ'=>'y', 'ὖ'=>'y', 'ὗ'=>'y', 'ὺ'=>'y', 'ύ'=>'y', 'ῠ'=>'y', 'ῡ'=>'y', 'ῢ'=>'y', 'ΰ'=>'y', 'ῦ'=>'y', 'ῧ'=>'y', 'φ'=>'f', 'χ'=>'x', 'ψ'=>'ps', 'ω'=>'o', 'ώ'=>'o', 'ὠ'=>'o', 'ὡ'=>'o', 'ὢ'=>'o', 'ὣ'=>'o', 'ὤ'=>'o', 'ὥ'=>'o', 'ὦ'=>'o', 'ὧ'=>'o', 'ᾠ'=>'o', 'ᾡ'=>'o', 'ᾢ'=>'o', 'ᾣ'=>'o', 'ᾤ'=>'o', 'ᾥ'=>'o', 'ᾦ'=>'o', 'ᾧ'=>'o', 'ὼ'=>'o', 'ώ'=>'o', 'ῲ'=>'o', 'ῳ'=>'o', 'ῴ'=>'o', 'ῶ'=>'o', 'ῷ'=>'o', '¨'=>'', '΅'=>'', '᾿'=>'', '῾'=>'', '῍'=>'', '῝'=>'', '῎'=>'', '῞'=>'', '῏'=>'', '῟'=>'', '῀'=>'', '῁'=>'', '΄'=>'', '΅'=>'', '`'=>'', '῭'=>'', 'ͺ'=>'', '᾽'=>'', 'А'=>'A', 'Б'=>'B', 'В'=>'V', 'Г'=>'G', 'Д'=>'D', 'Е'=>'E', 'Ё'=>'E', 'Ж'=>'ZH', 'З'=>'Z', 'И'=>'I', 'Й'=>'I', 'К'=>'K', 'Л'=>'L', 'М'=>'M', 'Н'=>'N', 'О'=>'O', 'П'=>'P', 'Р'=>'R', 'С'=>'S', 'Т'=>'T', 'У'=>'', 'Ф'=>'F', 'Х'=>'KH', 'Ц'=>'TS', 'Ч'=>'CH', 'Ш'=>'SH', 'Щ'=>'SHCH', 'Ы'=>'Y', 'Э'=>'E', 'Ю'=>'Y', 'Я'=>'YA', 'а'=>'A', 'б'=>'B', 'в'=>'V', 'г'=>'G', 'д'=>'D', 'е'=>'E', 'ё'=>'E', 'ж'=>'ZH', 'з'=>'Z', 'и'=>'I', 'й'=>'I', 'к'=>'K', 'л'=>'L', 'м'=>'M', 'н'=>'N', 'о'=>'O', 'п'=>'P', 'р'=>'R', 'с'=>'S', 'т'=>'T', 'у'=>'', 'ф'=>'F', 'х'=>'KH', 'ц'=>'TS', 'ч'=>'CH', 'ш'=>'SH', 'щ'=>'SHCH', 'ы'=>'Y', 'э'=>'E', 'ю'=>'Y', 'я'=>'YA', 'Ъ'=>'', 'ъ'=>'', 'Ь'=>'', 'ь'=>'', 'ð'=>'d', 'Ð'=>'D', 'þ'=>'th', 'Þ'=>'TH', 'ა'=>'a', 'ბ'=>'b', 'გ'=>'g', 'დ'=>'d', 'ე'=>'e', 'ვ'=>'v', 'ზ'=>'z', 'თ'=>'t', 'ი'=>'i', 'კ'=>'k', 'ლ'=>'l', 'მ'=>'m', 'ნ'=>'n', 'ო'=>'o', 'პ'=>'p', 'ჟ'=>'zh', 'რ'=>'r', 'ს'=>'s', 'ტ'=>'t', 'უ'=>'', 'ფ'=>'p', 'ქ'=>'k', 'ღ'=>'gh', 'ყ'=>'q', 'შ'=>'sh', 'ჩ'=>'ch', 'ც'=>'ts', 'ძ'=>'dz', 'წ'=>'ts', 'ჭ'=>'ch', 'ხ'=>'kh', 'ჯ'=>'j', 'ჰ'=>'h' ];
    return strtr($str, $char_map);
  }
  function slugify($str) {
      return mb_strtolower(preg_replace(array('/[^a-zA-Z0-9 \'-]/', '/[ -\']+/', '/^-|-$/'), array('', '-', ''), remove_accent($str)));
  }

  // quickndirty log util
  function pttp_log($log_msg) {
    $log_dirname = "log";
    if (!file_exists($log_dirname)) {
        mkdir($log_dirname, 0777, true);
    }
    if(is_array($log_msg)){
      $log_msg = print_r($log_msg, true);
    }
    $log_file_data = $log_dirname.'/log_' . date('d-M-Y') . '.log';    
    file_put_contents($log_file_data, $log_msg . "\n", FILE_APPEND);
  } 


  // Parse “special” shortcodes and returns array() :
  // [
  //   "shortcode"=> string: type of shorcode, 
  //   "html" => string: html,
  //   "figure" => string: optional, html for remote figure (in case of figure)
  // ] 
  // shortcodes can be: imagenote, video, image, figure

  $figures_index = 0;

  function parse_shortcode($string){

    global $figures_index;

    $ostring = $string;
    
    $type  = null;
    $value = null;
    $attrs = [];
    
    $tag = trim(ltrim($string, '('));
    if (substr($tag, -1) === ')') {
      $tag = substr($tag, 0, -1);
    }

    $type = trim(substr($tag, 0, strpos($tag, ':')));
    $type = strtolower($type);
    $attr = ['class', 'caption', 'print', 'poster', 'col', 'printcol', 'width', 'printwidth'];

    array_unshift($attr, $type);

    // extract all attributes
    $regex = sprintf('/(%s):/i', implode('|', $attr));
    $search = preg_split($regex, $tag, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);

    // $search is now an array with alternating keys and values
    // convert it to arrays of keys and values
    $chunks = array_chunk($search, 2);
    $keys   = array_column($chunks, 0);
    $values = array_map('trim', array_column($chunks, 1));

    // ensure that there is a value for each key
    // otherwise combining won't work
    if (count($values) < count($keys)) {
        $values[] = '';
    }

    // combine the two arrays to an associative array
    $attributes = array_combine($keys, $values);
    
    // the first attribute is the type attribute
    // extract and pass its value separately
    $value = array_shift($attributes);
    
    // init MarkdownIt
    $mdit = new MarkdownIt();

    // figures, videos and images might have inline styles, set as:
    // (figure: image.jpg col: 3 width: 9 printcol: 1 printwidth: 12)
    $inlinestyles = "";
    $col = $attributes["col"] ?? "";
    $inlinestyles .= $col ? "--col: $col;" : "";
    $printcol = $attributes["printcol"] ?? "";
    $inlinestyles .= ($printcol ? "--printcol: $printcol;" : "");
    $width = $attributes["width"] ?? "";
    $inlinestyles .= $width ? "--width: $width;" : "";
    $printwidth = $attributes["printwidth"] ?? "";
    $inlinestyles .= $printwidth ? "--printwidth: $printwidth;" : "";

    if($type == "imagenote"){
      $class = $attributes["class"] ?? "";
      $caption = $attributes["caption"] ?? "";
      $id = slugify($value);
      $html = "<span class='imagenote $class' id='$id' data-src='$value'>";
      $html .= "<img src='$value'>";
      if($caption){
        $html .= "<span class='caption'>";
        $caption = $mdit->renderInline( $caption );
        $html .= $caption;
        $html .= "</span>";  
      }
      $html .= "</span>";
      return ["shortcode"=> "imagenote", "html" => $html];
    }

    if($type == "video"){
      $class = $attributes["class"] ?? "";
      $poster = $attributes["poster"] ?? "";
      $caption = $attributes["caption"] ?? "";
      $html = "<figure class='videofigure $class' data-src='$value' style='$inlinestyles'>";
      $video = "<div class='video'" . ($poster != "" ? "style='background-image:url($poster)'" : "") . ">" . video($value) . '</div>';
      $html .= $video;
      if($caption){
        $html .= "<figcaption class='figcaption'>";
        $caption = $mdit->renderInline( $caption );
        $html .= $caption;
        $html .= "</figcaption>";  
      }
      $html .= "</figure>";
      return ["shortcode"=> "video", "html" => $html];
    }

    if($type == "image" || $type == "figure"){
      if($type == "figure") { $figures_index++; }
      $class = $attributes["class"] ?? "";
      $caption = $attributes["caption"] ?? "";

      $id = slugify($value);
      if($type == "figure") { $id .= "-" . $figures_index; }
      $figure = "<figure class='figure $type $class' id='$id' style='$inlinestyles'>";      
      $figure .= "<img src='$value'>";
      $figure .= "<figcaption class='figcaption'>";
      if($type == "figure") { $figure .= "<span class='figure_reference'>[fig. " . $figures_index . "]</span> "; }
      if($caption){        
        $caption = $mdit->renderInline( $caption );
        $figure .= $caption;        
      }
      if($type == "figure") { $figure .= " <a href='#$id-call' class='figure_call_back'>&#x21a9</a>"; }
      $figure .= "</figcaption>";  
      $figure .= "</figure>";

      if($type == "figure") { 
        $html = "<span class='figure_call' id='$id-call'>[<a href='#$id'>fig. $figures_index</a>]</span>";
        return ["shortcode"=> "figure", "html" => $html, "figure" => $figure];
      } else {
        return ["shortcode"=> "image", "html" => $figure];
      }
      
    }
    
    return $ostring;
  }

  

  function specials($md){
    $regex = '!
            (?=[^\]])               # positive lookahead that matches a group after the main expression without including ] in the result
            (?=\([a-z0-9_-]+:)      # positive lookahead that requires starts with ( and lowercase ASCII letters, digits, underscores or hyphens followed with : immediately to the right of the current location
            (\(                     # capturing group 1
                (?:[^()]+|(?1))*+   # repetitions of any chars other than ( and ) or the whole group 1 pattern (recursed)
            \))                     # end of capturing group 1
        !isx';
    
    $figures = array();
    
    $md_with_special_tags = preg_replace_callback($regex, function ($match) use (&$figures) {
      $special = parse_shortcode($match[0]);
      if(is_array($special)) {        
        // if we found any figure shortcode, the returned $figure has to be pushed to figures array 
        if( $special["shortcode"] == "figure" ){
          $figures[]= $special["figure"];
        }
        return $special["html"];
      } else {
        return $match[0];
      }
    }, $md ?? '');

    $response = [
      "md" => $md_with_special_tags,
      "figures" => $figures
    ];

    return $response;
  }


  function video($url){
    if (mb_strpos($url, 'yout') !== false) {
      return youtube($url);
    }
    if (mb_strpos($url, 'vimeo') !== false) {
      return vimeo($url);
    }
  }

  function youtube(string $url) {
    if (preg_match('!youtu!i', $url) !== 1) {
      return null;
    }

    $uri    = parse_url($url);
    $path   = $uri["path"];
    $q  = $uri["query"] ?? null;
    if($q){
      parse_str($q, $query);
    }
    $parts  = explode("/", $path);
    $first = $parts[1];
    $second = $parts[2] ?? null;
    $host   = 'https://' . $uri["host"] . '/embed';
    $src    = null;

    $isYoutubeId = function (?string $id = null): bool {
      if (empty($id) === true) {
          return false;
      }
      return preg_match('!^[a-zA-Z0-9_-]+$!', $id);
    };

    switch ($first) {
      case "watch":
        if ($isYoutubeId($query["v"]) === true) {
          $src = $host . '/' . $query["v"];
        }
        break;
      default:
        // short URLs
        if (mb_strpos($host, 'youtu.be') !== false && $isYoutubeId($first) === true) {
          $src = 'https://www.youtube.com/embed/' . $first;
        // embedded video URLs
        } elseif ($first === 'embed' && $isYoutubeId($second) === true) {
            $src = $host . '/' . $second;
        }
      break;
    }

    if (empty($src) === true) {
      return null;
    }

    // straight iframe: bad
    // $youtube = "<iframe allowtransparency='true' scrolling='no' width='640' height='360' src='$src?rel=0' frameborder='0' allowfullscreen allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture'></iframe>";

    // webcomponent: better
    $youtube_component = "<youtube-embed><iframe scrolling='no' width='640' height='360' allow='autoplay; fullscreen' src='' data-src='$src?autoplay=1&rel=0'></iframe><button aria-label='Play video'></button></youtube-embed>";
  
    return $youtube_component;
    // return $youtube;
        
  }

  function vimeo(string $url) {  
    $uri    = parse_url($url);
    $path   = $uri["path"];
    $q  = $uri["query"] ?? null;
    if($q){
      parse_str($q, $query);
    }
    $parts  = explode("/", $path);
    $first = $parts[1];
    $second = $parts[2] ?? null;
    $host   = 'https://' . $uri["host"] . '/embed';
    $src    = null;

    switch ($uri["host"]) {
      case 'vimeo.com':
      case 'www.vimeo.com':
        $id = $first;
        break;
      case 'player.vimeo.com':
        $id = $second;
        break;
    }

    if (empty($id) === true || preg_match('!^[0-9]*$!', $id) !== 1) {
      return null;
    }

    // build the full video src URL
    $src = 'https://player.vimeo.com/video/' . $id;

    // straight iframe: bad
    // $vimeo = "<iframe src='$src' width='640' height='360' frameborder='0' allow='autoplay; fullscreen; picture-in-picture' allowfullscreen></iframe>";      

    // webcomponent: better
    $vimeo_component = "<vimeo-embed><iframe scrolling='no' width='640' height='360' allow='autoplay; fullscreen' src='' data-src='$src?autoplay=1&rel=0'></iframe><button aria-label='Play video'></button></vimeo-embed>";
  
    return $vimeo_component;
    // return $vimeo;
  }

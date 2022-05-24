<?php
  use Kaoken\MarkdownIt\MarkdownIt;
  function special($string){

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
    $attr = ['class', 'caption'];

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
    

    if($type == "imagenote"){
      $class = $attributes["class"] ?? "";
      $caption = $attributes["caption"] ?? "";
      $html = "<span class='imagenote $class'>";
      $html .= "<img src='$value'>";
      if($caption){
        $html .= "<span class='caption'>";
        $mdit = new MarkdownIt();
        $caption = $mdit->renderInline( $caption );
        $html .= $caption;
        $html .= "</span>";  
      }
      $html .= "</span>";
      return $html;
    }

    if($type == "video"){
      $class = $attributes["class"] ?? "";
      $caption = $attributes["caption"] ?? "";
      $html = "<figure class='videofigure $class'>";
      $video = "<div class='video'>" .video($value) . '</div>';
      $html .= $video;
      if($caption){
        $html .= "<figcaption class='figcaption'>";
        $mdit = new MarkdownIt();
        $caption = $mdit->renderInline( $caption );
        $html .= $caption;
        $html .= "</figcaption>";  
      }
      $html .= "</figure>";
      return $html;
    }

    if($type == "figure"){
      $class = $attributes["class"] ?? "";
      $caption = $attributes["caption"] ?? "";
      $html = "<figure class='figure $class'>";
      $html .= "<img src='$value'>";
      if($caption){
        $html .= "<figcaption class='figcaption'>";
        $mdit = new MarkdownIt();
        $caption = $mdit->renderInline( $caption );
        $html .= $caption;
        $html .= "</figcaption>";  
      }
      $html .= "</figure>";
      return $html;
    }
    
    return "$ostring";
  }


  function specials($md){
    $regex = '!
            (?=[^\]])               # positive lookahead that matches a group after the main expression without including ] in the result
            (?=\([a-z0-9_-]+:)      # positive lookahead that requires starts with ( and lowercase ASCII letters, digits, underscores or hyphens followed with : immediately to the right of the current location
            (\(                     # capturing group 1
                (?:[^()]+|(?1))*+   # repetitions of any chars other than ( and ) or the whole group 1 pattern (recursed)
            \))                     # end of capturing group 1
        !isx';
    return preg_replace_callback($regex, function ($match) {
      try {
          return special($match[0]);
      } catch (Exception $e) {
        throw $e;
        return $match[0];
      }
    }, $md ?? '');
  }


  function video($url){
    if (mb_strpos($url, 'youtu') !== false) {
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

    $youtube = "<iframe allowtransparency='true' scrolling='no' width='640' height='360' src='$src?rel=0' frameborder='0' allowfullscreen allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture'></iframe>";
    return $youtube;
        
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

    $vimeo = "<iframe src='$src' width='640' height='360' frameborder='0' allow='autoplay; fullscreen; picture-in-picture' allowfullscreen></iframe>";      
    return $vimeo;
  }

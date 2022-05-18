<?php
  use Kaoken\MarkdownIt\MarkdownIt;
  function special($string){
    
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
    
    return "<b>$type= $string</b>";
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
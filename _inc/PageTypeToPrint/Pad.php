<?php 

function pad_get_contents( $url ){
  
  // fallback
  $content = "The provided URL ($url) didn’t reply positively. <pre>¯\\\_(ツ)_/¯</pre>";

  // check URL status
  if (is_url_responding($url)) {
    // get URL parts
    $url_parts = parse_url($url);
    // get txt export URL
    $export_url = $url_parts['scheme'] . '://' . $url_parts['host'] . $url_parts['path'] . "/export/txt";
    // check export URL status, then clean content
    if (is_url_responding($export_url)) {
      $content = file_get_contents( $export_url );
      $content = preserveBRs($content);
      $content = htmlentities($content, ENT_QUOTES, 'utf-8', false);
      $content = strip_tags($content);
      $content = stripslashes($content);
      $content = revertBRs($content);
      return $content;
    } 
  } 
  // fallback…
  return $content;
}

function is_url_responding($url){
  //  get headers
  $headers = get_headers($url, 1);
  // if is 200, ok
  return $headers[0] == 'HTTP/1.1 200 OK';
}


function preserveBRs($content){
  $content = preg_replace_callback(
    '|\<(w?br)(\s[^>]*)?(\s?/)?\>|',
    function ($found) {
        if(isset($found[1]) && in_array(
            $found[1], 
            array('wbr','br'))
        ) {
            return '{{' . $found[1] . ' ' . $found[2] . '}}';
        };
    },
    $content  
  );
  return $content;
}

function revertBRs($content){
  $content = preg_replace_callback(
    '|\{\{([^}]*)\}\}|',
    function ($found) {
      return '<' . $found[1] . '>';
    },
    $content  
  );
  return $content;
}
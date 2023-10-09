<?php 

// Unused function, cURL doesn’t succeeds more than file_get_contents when dealing with “HTTP/1.1 429 Too Many Requests”
function curl_get_contents($url) {
  $timeout = 30;
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
  curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla PageTypeToPrint");
  $result=curl_exec($ch);
  curl_close($ch);
  return $result;
}

function pad_get_contents( $url ){
  
  // fallback
  $content = "";

  // get URL parts
  $url_parts = parse_url($url);
  // get txt export URL
  $export_url = $url_parts['scheme'] . '://' . $url_parts['host'] . $url_parts['path'] . "/export/txt";
  // check headers
  ini_set("user_agent","Mozilla PageTypeToPrint");
  $headers = get_headers($export_url, 1);

  usleep(500 * 1000); 

  // check export URL status, then clean content
  if ($headers[0] == 'HTTP/1.1 200 OK') {
    // 1 -  cURL mode
    $content = curl_get_contents( $export_url );

    // 2 - file_get_contents mode
    // $opts = array('http'=>array('header' => "User-Agent:Mozilla PageTypeToPrint/1.0\r\n", 'timeout' => "30")); 
    // // Adding headers to the request
    // $context = stream_context_create($opts);
    // // send the request
    // $content = file_get_contents($export_url, false, $context);

    $content = preserveBRs($content);
    $content = htmlentities($content, ENT_QUOTES, 'utf-8', false);
    $content = strip_tags($content);
    $content = stripslashes($content);
    $content = revertBRs($content);
  } else {
    $content = "The provided URL ($url) didn’t reply positively (the server replied with “" . $headers[0] . "”). <pre>¯\\\_(ツ)_/¯</pre>" ;
  }

  // fallback…
  return $content;
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
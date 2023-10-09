<?php 

function url_get_contents($url, $useragent='cURL', $headers=false, $follow_redirects=true, $debug=false) {

  // initialise the CURL library
  $ch = curl_init();

  // specify the URL to be retrieved
  curl_setopt($ch, CURLOPT_URL,$url);

  // we want to get the contents of the URL and store it in a variable
  curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);

  // specify the useragent: this is a required courtesy to site owners
  curl_setopt($ch, CURLOPT_USERAGENT, $useragent);

  // ignore SSL errors
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

  // return headers as requested
  if ($headers==true){
      curl_setopt($ch, CURLOPT_HEADER,1);
  }

  // only return headers
  if ($headers=='headers only') {
      curl_setopt($ch, CURLOPT_NOBODY ,1);
  }

  // follow redirects - note this is disabled by default in most PHP installs from 4.4.4 up
  if ($follow_redirects==true) {
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
  }

  // if debugging, return an array with CURL's debug info and the URL contents
  if ($debug==true) {
      $result['contents']=curl_exec($ch);
      $result['info']=curl_getinfo($ch);
  }

  // otherwise just return the contents as a variable
  else $result=curl_exec($ch);

  // free resources
  curl_close($ch);

  // send back the data
  return $result;
}

function pad_get_contents( $url ){
  
  // fallback
  $content = "The provided URL ($url) didn’t reply positively. <pre>¯\\\_(ツ)_/¯</pre>";


  // get URL parts
  $url_parts = parse_url($url);
  // get txt export URL
  $export_url = $url_parts['scheme'] . '://' . $url_parts['host'] . $url_parts['path'] . "/export/txt";

  // check headers
  $headers = get_headers($export_url, 1);

  // check export URL status, then clean content
  if ($headers[0] == 'HTTP/1.1 200 OK') {
    // - cURL mode
    // $content = url_get_contents( $export_url );
    // - file_get_contents mode
    $opts = array('http'=>array('header' => "User-Agent:PageTypeToPrint/1.0\r\n")); 
    // Adding headers to the request
    $context = stream_context_create($opts);
    // sen dthe request
    $content = file_get_contents($export_url, false, $context);
    $content = preserveBRs($content);
    $content = htmlentities($content, ENT_QUOTES, 'utf-8', false);
    $content = strip_tags($content);
    $content = stripslashes($content);
    $content = revertBRs($content);
    return $content;
  } else {
    $content .= $headers[0];
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
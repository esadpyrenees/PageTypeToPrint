<?php 
  require_once __DIR__ . '/Tags.php';

  function folder_get_contents( $folder ){
    
    $lookup = dirname(__DIR__) . "/../" . $folder.'/*.{jpg,JPG,jpeg,JPEG,png,PNG,gif,GIF,webp,WEBP,svg,SVG}';
    $files = glob($lookup,GLOB_BRACE);
    sort($files);

    // fallback
    if(empty($files)){
      return "The provided folder ($folder) seems to be empty or unreachable. <pre>¯\\\_(ツ)_/¯</pre>";
    }

    // content
    $content = "";
    foreach($files as $file){
      // get URL and filename
      $url = $folder . "/" . basename($file);
      $slug = slugify(basename($file));
      $path_parts = pathinfo($file);
      $filename = $path_parts['filename'];
      // get width and height
      list($width, $height, $type, $attr) = getimagesize($file);
      // orientation
      $orientation = $width < $height ? "portrait" : "landscape";
      // build figure
      $content .= "<figure class='figure $orientation' id='$slug'>";
      $content .= "  <img $attr src='$url'>";
      $content .= "  <figcaption> $filename</figcaption>";
      $content .= "</figure>";
    } 

    return $content;
  }

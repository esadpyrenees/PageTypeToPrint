<?php

  //  introduces <wbr> tags in anchors texts so that long strings doesn’t break layout

  function breakAnchors($doc){
    function insertWbr($anchortext){
      return "a" . $anchortext;
    };
    return preg_replace_callback('/<a(.+?)>(.+?)<\/a>/i', function($matches){
      // var_dump($matches[1]);
      $html = "<a" . $matches[1] . ">";
      $anchortext = $matches[2];
      $anchortext = preg_replace("/\/\//",  '//<wbr>', $anchortext );
      $anchortext = preg_replace("/,/",  ',<wbr>', $anchortext );
      $anchortext = preg_replace("/(\/?<!\<|\~|\-|\.|\,|\_|\?|\#<!\&|\%)/",  "<wbr>$1", $anchortext );
      $anchortext = preg_replace("/-/",  '<wbr>&#8209;', $anchortext );
      $html .= $anchortext;
      $html .= "</a>";
      return $html;
    }, $doc);
  }
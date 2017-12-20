<?php
function rmScript($html) {
  $dom = new DOMDocument();

  $dom->encoding = "UTF-8";

  $dom->loadHTML(mb_convert_encoding(html_entity_decode("<p>" . $html . "</p>"), "HTML-ENTITIES", "UTF-8"),  LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

  $script = $dom->getElementsByTagName('script');

  $remove = [];
  foreach($script as $item)
  {
    $remove[] = $item;
  }

  foreach ($remove as $item)
  {
    $item->parentNode->removeChild($item);
  }

  $html = trim($dom->saveHTML());
  return substr($html, 3, -4); // return  without p tag
}
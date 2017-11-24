<?php
function rmScript($html) {
  $dom = new DOMDocument();

  $dom->loadHTML(html_entity_decode($html));

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

  return $dom->saveHTML();
}
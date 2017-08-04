<?php

function xmlToCSV($text) {
  $tours = simplexml_load_string($text);
  $min_USD;
  foreach($tours->TOUR as $tour) {
    $discount  = $tour->DEP[0]->attributes()->DISCOUNT ? $tour->DEP[0]->attributes()->DISCOUNT: 1;
    $min_USD = $tour->DEP[0]->attributes()->USD * $discount;
    $min_GBP = $tour->DEP[0]->attributes()->GBP * $discount;
    $min_EUR = $tour->DEP[0]->attributes()->EUR * $discount;
    foreach ($tour->DEP as $dep) {
      $discount  = $dep->attributes()->DISCOUNT ? $dep->attributes()->DISCOUNT: 0;
      $discount = (int) str_replace('%', '', $discount);
      $discount = (100 - $discount) / 100;
      echo $discount . '<br>';
      $min_USD = ($dep->attributes()->USD * $discount) < $min_USD ? $dep->attributes()->USD * $discount : $min_USD;
      $min_GBP = ($dep->attributes()->GBP * $discount) < $min_GBP ? $dep->attributes()->GBP * $discount : $min_GBP;
      $min_EUR = ($dep->attributes()->EUR * $discount) < $min_EUR ? $dep->attributes()->EUR * $discount : $min_EUR;
    }
    echo $tour->Title . '|' . $tour->Code  . '|' . $tour->Duration . '|' . $tour->Inclusions . '|' . $min_USD;
  }
}
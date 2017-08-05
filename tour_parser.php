<?php
$text = '<?xml version="1.0"?>
<TOURS>
    <TOUR>
        <Title><![CDATA[Anzac &amp; Egypt Combo Tour]]></Title>
        <Code>AE-19</Code>
        <Duration>18</Duration>
        <Start>Istanbul</Start>
        <End>Cairo</End>
        <Inclusions>
            <![CDATA[<div style="margin: 1px 0px; padding: 1px 0px; border: 0px; outline: 0px; font-size: 14px; vertical-align: baseline; text-align: justify; line-height: 19px; color: rgb(6, 119, 179);">The tour price&nbsp; cover the following services: <b style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background-color: transparent;">Accommodation</b>; 5, 4&nbsp;and&nbsp;3 star hotels&nbsp;&nbsp;</div>]]>
        </Inclusions>
        <DEP DepartureCode="AN-17" Starts="04/19/2015" GBP="1458" EUR="1724" USD="2350" DISCOUNT="15%" />
        <DEP DepartureCode="AN-18" Starts="04/22/2015" GBP="1558" EUR="1784" USD="2550" DISCOUNT="20%" />
        <DEP DepartureCode="AN-19" Starts="04/25/2015" GBP="1558" EUR="1784" USD="2550" />
    </TOUR>
    <TOUR>
        <Title><![CDATA[Anzac &amp; Egypt Combo Tour]]></Title>
        <Code>AE-19</Code>
        <Duration>18</Duration>
        <Start>Istanbul</Start>
        <End>Cairo</End>
        <Inclusions>
            <![CDATA[<div style="margin: 1px 0px; padding: 1px 0px; border: 0px; outline: 0px; font-size: 14px; vertical-align: baseline; text-align: justify; line-height: 19px; color: rgb(6, 119, 179);">The tour price&nbsp; cover the following services: <b style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background-color: transparent;">Accommodation</b>; 5, 4&nbsp;and&nbsp;3 star hotels&nbsp;&nbsp;</div>]]>
        </Inclusions>
        <DEP DepartureCode="AN-17" Starts="04/19/2015" GBP="1458" EUR="1724" USD="2350" DISCOUNT="15%" />
        <DEP DepartureCode="AN-18" Starts="04/22/2015" GBP="1558" EUR="1784" USD="2550" DISCOUNT="20%" />
        <DEP DepartureCode="AN-19" Starts="04/25/2015" GBP="1558" EUR="1784" USD="1200" />
    </TOUR>

    <TOUR>
        <Title><![CDATA[Anzac &amp; Egypt Combo Tour]]></Title>
        <Code>AE-19</Code>
        <Duration>18</Duration>
        <Start>Istanbul</Start>
        <End>Cairo</End>
        <Inclusions>
            <![CDATA[<div style="margin: 1px 0px; padding: 1px 0px; border: 0px; outline: 0px; font-size: 14px; vertical-align: baseline; text-align: justify; line-height: 19px; color: rgb(6, 119, 179);">The tour price&nbsp; cover the following services: <b style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background-color: transparent;">Accommodation</b>; 5, 4&nbsp;and&nbsp;3 star hotels&nbsp;&nbsp;</div>]]>
        </Inclusions>
        <DEP DepartureCode="AN-17" Starts="04/19/2015" GBP="1458" EUR="1724" USD="1200" DISCOUNT="15%" />
        <DEP DepartureCode="AN-18" Starts="04/22/2015" GBP="1558" EUR="1784" USD="2550" DISCOUNT="20%" />
        <DEP DepartureCode="AN-19" Starts="04/25/2015" GBP="1558" EUR="1784" USD="1200" />
    </TOUR>
</TOURS>';


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
      $min_USD = ($dep->attributes()->USD * $discount) < $min_USD ? $dep->attributes()->USD * $discount : $min_USD;
      $min_GBP = ($dep->attributes()->GBP * $discount) < $min_GBP ? $dep->attributes()->GBP * $discount : $min_GBP;
      $min_EUR = ($dep->attributes()->EUR * $discount) < $min_EUR ? $dep->attributes()->EUR * $discount : $min_EUR;
    }
    echo $tour->Title . '|' . $tour->Code  . '|' . $tour->Duration . '|' . $tour->Inclusions . '|' . $min_USD . '</br>';
  }
}

xmlToCSV($text);

<?php
   function is_anagram($string1, $string2) {
      $modified_string1 = strtolower(str_replace(' ', '', $string1));
      $modified_string2 = strtolower(str_replace(' ', '', $string2));
      $strlen1 = strlen($modified_string1);
      $strlen2 = strlen($modified_string2);
      if ($strlen1 != $strlen2) {
         return false;
      }
      $hash_map = [];
      for ($i = 0;  $i < $strlen1; $i++) {
         $hash_map[$modified_string1[$i]] = 1;
      }
      for ($i = 0; $i < $strlen2; $i++) {
         if (!array_key_exists($modified_string2[$i], $hash_map)) {
            return false;
         }
      }
      return true;

   }

<?php
#thanks to some usercmmnts @ php.net

if (!function_exists("file_put_contents")){
function file_put_contents($n,$d) {
  $f=@fopen($n,"w");
  if (!$f) {
   return false;
  } else {
   fwrite($f,$d);
   fclose($f);
   return true;
  }
} }

?>
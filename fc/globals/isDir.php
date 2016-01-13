<?php
 #thanks to some usercmmnts @ php.net

if (!function_exists("isDir")){
function isDir($dir) {
  $cwd = getcwd();
  $returnValue = false;
  if (@chdir($dir)) {
    chdir($cwd);
    $returnValue = true;
  }
  return $returnValue;
}}

?>
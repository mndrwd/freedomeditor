<?php


#thanks to some usercmmnts @ php.net
#is_substr
#file_put_contents
#rp
#isDir
if (!function_exists("is_substr")){function is_substr($bult, $vindmij){
 $pos = strpos($bult, $vindmij);if ($pos === false) {return false; } else {return true;}}}
?>
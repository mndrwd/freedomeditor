<?php
 

#realpath replacement found on php.net/realpath
#just unfortunately it doesn't work
/*
if (!function_exists("rp")){
function rp($p) {
    $p=explode('/', $p);
    $o=array();
    for ($i=0; $i<sizeof($p); $i++) {
        if (''==$p[$i] || '.'==$p[$i]) continue;
        if ('..'==$p[$i] && $i>0 && '..'!=$o[sizeof($o)-1]) {
            array_pop($o);
            continue;
        }
        array_push($o, $p[$i]);
    }
    return implode('/', $o);
}}
*/
if (!function_exists("rp")){
function rp($p) {
return $p;}}


?>
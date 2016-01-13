<?php

#NOTE: FIRST TRY USE PREG_QUOTE FUNCTION INSTEAD
if (!function_exists("regexpmeta_safe")){
  function regexpmeta_safe($var){
    $arra['\\']='\\\\'; 
    $arra["^"]="\^";
    $arra["["]="\[";
    $arra["."]="\.";
    $arra["$"]="\$";
    $arra["{"]="\{";
    $arra["*"]="\*";
    $arra["("]="\(";
    $arra["+"]="\+";
    $arra[")"]="\)";
    $arra["|"]="\|";
    $arra["?"]="\?";
    $arra["}"]="\}";
    $arra["]"]="\]";
    $arra["<"]="\<"; #html?
    $arra[">"]="\>"; #html?
    #$arra["_"]="\_";
    $arra["/"]="\/";

      return  str_replace(array_keys($arra) ,array_values($arra), $var);
  


}}

?>
<?php
               /*
	 * 	Developped by Bart Bosma
	 *	Released under GPL license
	 */
	
$__wp=$___workpath;
$___workpath=$workpathios[0]."globals/";

$depend["gethatmpl"]=false;

startfunct($depend);
$depend=array();
$___workpath=$__wp;

if (!function_exists("editormimemode")){
  function editormimemode($klikit, $tmpll="mimemode"){
    global $tmplext;
    $string='';
    if (is_array($klikit)){
      $cattpl=gethatmpl($klikit, $tmpll);
  
      $klikit=array_unique(array_values($klikit));
   foreach ($klikit as $aa => $bb){
     $string.=str_replace("{extlinks}", $bb, $cattpl);
   }}return $string;}}

?>